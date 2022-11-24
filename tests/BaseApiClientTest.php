<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients;

use Gilmon\Tests\ApiClients\Mock\MockApiClient;
use Gilmon\Tests\ApiClients\Mock\MockHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class BaseApiClientTest extends ApiTestCase
{
    private string $baseHost = 'calls.service';
    private string $baseUri = 'http://calls.service/api/v1/';

    public function testGetMethod()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new MockApiClient($client);
        $callApiClient->getMethod('test/foo', ['foo' => 'bar']);

        $request = $mockHandler->getLastRequest();

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/test/foo', $request->getUri()->getPath());
        $this->assertSame('foo=bar', $request->getUri()->getQuery());
    }

    public function testPostMethod()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new MockApiClient($client);
        $callApiClient->postMethod('test/foo', ['foo' => 'bar']);

        $request = $mockHandler->getLastRequest();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/test/foo', $request->getUri()->getPath());
        $this->assertSame(json_encode(['foo' => 'bar']), $request->getBody()->getContents());
    }

    public function testPutMethod()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new MockApiClient($client);
        $callApiClient->putMethod('test/foo', ['foo' => 'bar']);

        $request = $mockHandler->getLastRequest();

        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/test/foo', $request->getUri()->getPath());
        $this->assertSame(json_encode(['foo' => 'bar']), $request->getBody()->getContents());
    }

    public function testDeleteMethod()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new MockApiClient($client);
        $callApiClient->deleteMethod('test/foo');

        $request = $mockHandler->getLastRequest();

        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/test/foo', $request->getUri()->getPath());
    }

 public function testPatchMethod()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new MockApiClient($client);
        $callApiClient->patchMethod('test/foo', ['foo' => 'bar']);

        $request = $mockHandler->getLastRequest();

        $this->assertSame('PATCH', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/test/foo', $request->getUri()->getPath());
        $this->assertSame(json_encode(['foo' => 'bar']), $request->getBody()->getContents());
    }
}
