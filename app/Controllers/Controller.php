<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

abstract class Controller
{
    /**
     * The container instance.
     *
     * @var \Container\ContainerInterface;
     */
    protected $c;

    /**
     * Set up controllers to have access to the container.
     *
     * @param \Container\ContainerInterface;
     */
    public function __construct(ContainerInterface $container)
    {
        $this->c = $container;
    }
}
