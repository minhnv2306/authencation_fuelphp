<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 03/07/2018
 * Time: 14:27
 */
class Controller_Test extends Controller
{
    public function action_test()
    {
        DB::start_transaction();
        // prepare an insert statement
        $query = DB::insert('book');

        // Set the columns and values
        $query->set(array(
            'title' => 'Javascript HeadFirst',
            'author' => 'Minh NV',
            'price' => 100.01,
        ));
        $query->execute();
        DB::commit_transaction();
        echo 1;
    }

    public function action_getUser()
    {
        $tables = 'users';
        $sql_query = <<< _EOT_
SELECT
	TB.email
FROM
	{$tables} AS TB
_EOT_;
        $ret_all = \DB::query($sql_query)->execute()->as_array();
        var_dump($ret_all);
    }
}