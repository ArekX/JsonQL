<?php
/**
 * by Aleksandar Panic
 * LICENSE: Apache 2.0
 *
 **/

namespace tests;

use ArekX\JsonQL\Config\Config;
use ArekX\JsonQL\Helpers\DI;
use ArekX\JsonQL\MainApplication;
use DI\Container;
use tests\Mock\MockConfig;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Config */
    protected $config;

    /** @var MainApplication */
    protected $app;

    /** @var Container */
    protected $di;

    public function setUp()
    {
        $this->config = $this->createConfig();
        $this->di = $this->config->getDI();

        DI::bootstrap($this->config);

        $this->app = $this->di->get(MainApplication::class);
    }

    protected function createConfig()
    {
        return new MockConfig();
    }
}