<?php
class Myjob
{
    // [IMPORTANT] Requires 'fire' method as a entry point.
    public function fire($job, $data)
    {
        sleep(10);
        $post = new \Model\Post();
        $post->title = 'Hehe';
        $post->content = 'Content';
        $post->save();
    }
}