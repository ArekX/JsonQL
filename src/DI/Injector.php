<?php
/**
 * @author Aleksandar Panic
 * @link https://restfn.readthedocs.io/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @since 1.0.0
 **/

namespace ArekX\RestFn\DI;


class Injector
{
    public function __construct(array $config = [])
    {
    }

    public function make($class, ...$args)
    {
        return new $class(...$args);
    }
}