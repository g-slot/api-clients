<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients;

use Psr\Http\Message\RequestInterface;

class ApiTestCase extends \PHPUnit\Framework\TestCase
{
    protected function assertAcceptJson(RequestInterface $request)
    {
        $this->assertTrue(in_array('application/json', $request->getHeader('Accept')));
    }

    protected function assertContentTypeJson(RequestInterface $request)
    {
        $this->assertTrue(in_array('application/json', $request->getHeader('Content-Type')));
    }
}