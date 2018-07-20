<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 20/07/2018
 * Time: 08:50
 */
class Controller_Event extends \Controller
{
    public function before()
    {
        // Register an event
        Event::register('my_event', '\Event\Register::my_event');
    }
    public function action_register()
    {
        // Call an event
        Event::trigger('my_event');
    }
    public function action_job()
    {
        // push a new job onto the default queue of the default connection.
        // 'Myjob' is a class name you have defined.
        \Jobqueue\Queue::push('Myjob', array('message' => 'Hello World!'));

        echo 1;
    }
}