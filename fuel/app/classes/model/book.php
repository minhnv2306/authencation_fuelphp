<?php
class Model_Book extends Orm\Model {
    protected static $_connection = 'production';
    protected static $_table_name = 'book';
    protected static $_primary_key = array('id');

    protected static $_properties = array (
        'id',
        'title' => array (
            'data_type' => 'varchar',
            'label' => 'Book title',
            'validation' => array (
                'required',
                'min_length' => array(3),
                'max_length' => array(80)
            ),

            'form' => array (
                'type' => 'text'
            ),
        ),
        'author' => array (
            'data_type' => 'varchar',
            'label' => 'Book author',
            'validation' => array (
                'required',
            ),
            'form' => array (
                'type' => 'text'
            ),
        ),
        'price' => array (
            'data_type' => 'decimal',
            'label' => 'Book price',
            'validation' => array (
                'required',
            ),
            'form' => array (
                'type' => 'text'
            ),
        ),
    );
    protected static $_observers = array('Orm\\Observer_Validation' => array (
        'events' => array('before_save')
    ));
}