<?php
namespace Album;

// Add these import statements:
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

// ModuleManager буду вызывать getAutoloaderConfig () и GetConfig () автоматически для нас.
class Module
{

    // Наш getAutoloaderConfig () возвращает массив, который является совместимым с ZF2 AutoloaderFactory.
	
    public function getAutoloaderConfig()
    {
		//  Мы настроить его так, чтобы мы добавили файл  class map ClassmapAutoloader,
		// а также добавить пространство имен этого модуля к StandardAutoloader.
		//  Стандарт автозагрузчика требует пространства имен и путь, по которому
		// можно найти файлы для этого пространства имен. Это PSR-0 совместимых классов
		// и так отображаются прямо на файлы в соответствии с PSR-0 правилам.        
		
		return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
	
    // Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Album\Model\AlbumTable' =>  function($sm) {
                    $tableGateway = $sm->get('AlbumTableGateway');
                    $table = new AlbumTable($tableGateway);
                    return $table;
                },
                'AlbumTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
