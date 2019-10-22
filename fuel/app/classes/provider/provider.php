<?php

namespace Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Model\Book;

class Provider extends AbstractServiceProvider
{
    protected $provides = ['book'];

    public function register()
    {
        $this->getContainer()->add('book', new Book());
    }
}
