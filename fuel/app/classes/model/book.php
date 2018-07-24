<?php

namespace Model;

class Book extends \Orm\Model {
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

    public static function findOrFail($id)
    {
        if(!($book = Book::find($id))) {
            throw new \HttpNotFoundException();
        }
        return $book;
    }
    public static function createModel($request)
    {
        $book = Book::forge();
        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->price = $request['price'];
        $book->save();
    }

    public function updateModel($data)
    {
        $this->set($data);
        $this->save();
    }

    public static function paginate($config)
    {
        return Book::query()
            ->rows_offset($config->offset)
            ->rows_limit($config->per_page)
            ->order_by('id','desc')
            ->get();
    }
}