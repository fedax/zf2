<?php
namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('album');
		
        $this->setAttribute('method', 'post');	// <form action="/album/add" method="post" name="album" id="album">
		
        $this->add(array(		// <input type="hidden" name="id" value="">
            'name' => 'id',
            'type' => 'Hidden',
        ));
		
        $this->add(array(		// <label><span>Title</span><input type="text" name="title" value=""></label>
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
        ));
		
        $this->add(array(		// <label><span>Artist</span><input type="text" name="artist" value=""></label>
            'name' => 'artist',
            'type' => 'Text',
            'options' => array(
                'label' => 'Artist',
            ),
        ));
		
        $this->add(array(		// <input type="submit" name="submit" id="submitbutton" value="Add">
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}