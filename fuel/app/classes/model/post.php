<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 19/07/2018
 * Time: 15:18
 */
namespace Model;

// Sử dụng namespace thì extends \Model để phân biệt nhé
class Post extends \Orm\Model
{
    protected static $_connection = 'production';
    protected static $_table_name = 'posts';
    protected static $_primary_key = array('id');

    protected static $_properties = array (
        'id',
        'title',
        'content',
    );
}