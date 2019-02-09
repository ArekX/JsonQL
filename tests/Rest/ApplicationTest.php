<?php
/**
 * @author Aleksandar Panic
 * @link https://jsonql.readthedocs.io/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @since 1.0.0
 **/

namespace tests\Rest;

use ArekX\JsonQL\MainApplication;
use ArekX\JsonQL\Rest\Application;
use ArekX\JsonQL\Rest\Handlers\InvalidHandlerException;
use ArekX\JsonQL\Interfaces\RequestInterface;
use tests\Mock\MockHandler;
use tests\Mock\MockRequest;

class ApplicationTest extends TestCase
{
    public function testInitializedWithHandlers()
    {
        /** @var Application $app */
        $app = $this->di->make(MainApplication::class);
        $this->assertEquals($app->handlers, [MockHandler::class]);
    }

    public function testHandlersAreNotRunWhenNotInRequest()
    {
        /** @var MockRequest $request */
        $request = $this->di->make(RequestInterface::class);
        $request->body = [];

        $this->app->run();

        $handler = $this->di->make(MockHandler::class);

        $this->assertFalse($handler->isRun);
    }

    public function testHandlersAreRunFromRequest()
    {
        /** @var MockRequest $request */
        $request = $this->di->make(RequestInterface::class);

        $this->assertSame($request, $this->di->make(RequestInterface::class));
        $request->body = [MockHandler::requestType() => ['data' => 'value']];

        $this->app->run();

        $handler = $this->di->make(MockHandler::class);

        $this->assertTrue($handler->isRun);
        $this->assertEquals($handler->data, ['data' => 'value']);
    }

    public function testExceptionIsThrownOnUnknownRequestType()
    {
        /** @var MockRequest $request */
        $request = $this->di->make(RequestInterface::class);
        $request->body = ['unknown' => ['data' => 'value']];

        $this->expectException(InvalidHandlerException::class);
        $this->app->run();
    }
}