<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 11/07/2018
 * Time: 15:49
 */
namespace  Model;
class Test extends \Model
{
    // Method for unit test
    public function sluggify($string, $separator = '-', $maxLength = 96)
    {
        $title = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        $title = preg_replace('%[^-/+|\w ]%', '', $title);
        $title = strtolower(trim(substr($title, 0, $maxLength), '-'));
        $title = preg_replace('/[\/_|+ -]+/', $separator, $title);

        return $title;
    }
}
