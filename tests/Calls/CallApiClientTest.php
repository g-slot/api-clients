<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients\Calls;

use Gilmon\ApiClients\Calls\CallApiClient;
use Gilmon\Tests\ApiClients\ApiTestCase;
use Gilmon\Tests\ApiClients\Mock\MockHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class CallApiClientTest extends ApiTestCase
{

    private string $baseHost = 'calls.service';
    private string $baseUri = 'http://calls.service/api/v1/';

    public function testGetCallStatistics()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new CallApiClient($client);
        $callApiClient->statistics(100, new \DateTimeImmutable, new \DateTimeImmutable);

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);
        $this->assertContentTypeJson($request);

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/statistics/calls', $request->getUri()->getPath());
    }

    public function testPostImportCalls()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new CallApiClient($client);
        $callApiClient->import(100, 3, []);

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);
        $this->assertContentTypeJson($request);

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/calls', $request->getUri()->getPath());
    }

    public function testSearch()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new CallApiClient($client);
        $callApiClient->search(['test' => 'foo']);

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);
        $this->assertContentTypeJson($request);

        $this->assertSame('test=foo', $request->getUri()->getQuery());
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/calls', $request->getUri()->getPath());
    }
}