<?php

namespace Model;

class Book extends \Orm\Model {
    protected static $_connection = 'production';
    protected static $_table_name = 'books';
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
        'cover_img' => array(
            'data_type' => 'decimal',
            'label' => 'Book cover',
            'validation' => array (
                'required',
            ),
            'form' => array (
                'type' => 'text'
            ),
        )
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
        try {
            $book = Book::forge();
            $book->title = $request['title'];
            $book->author = $request['author'];
            $book->price = $request['price'];
            $book->cover_img = $request['cover_img'];
            $book->save();
        } catch (Exception $ex) {
            throw new Exception($ex->getCode());
        }
    }

    public function updateModel($data)
    {
        try {
            $this->set($data);
            $this->save();
        } catch (Exception $ex) {
            throw new Exception($ex->getCode());
        }
    }

    public static function deleteModel($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
        } catch (Exception $ex) {
            throw new Exception($ex->getCode());
        }
    }
    public static function paginate($config)
    {
        return Book::query()
            ->rows_offset($config->offset)
            ->rows_limit($config->per_page)
            ->order_by('id','desc')
            ->get();
    }

    public static function getConfigPaginate()
    {
        return array(
            'pagination_url' => 'http://bookstore.local/book/index',
            'total_items'    => Book::count(),
            'per_page'       => 10,
            'uri_segment'    => 'page',
            // or if you prefer pagination by query string
            //'uri_segment'    => 'page',
        );
    }
}