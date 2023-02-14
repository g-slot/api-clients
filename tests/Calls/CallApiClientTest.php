<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients\Calls;

use Gilmon\ApiClients\Calls\CallApiClient;
use Gilmon\ApiClients\Calls\Requests\CallsImportRequest;
use Gilmon\ApiClients\Calls\Requests\CallsSearchRequest;
use Gilmon\ApiClients\Calls\Requests\ManagerCallsStatisticsRequest;
use Gilmon\Tests\ApiClients\ApiTestCase;
use Gilmon\Tests\ApiClients\Mock\MockHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;

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


        $statisticsRequest = ManagerCallsStatisticsRequest::fromArray([
            'manager_id' => 101,
            'from'       => 'foo',
            'to'         => 'bar',
        ]);

        $callApiClient = new CallApiClient($client);
        $callApiClient->statistics($statisticsRequest);

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);
        $this->assertContentTypeJson($request);

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(http_build_query($statisticsRequest->toArray()), $request->getUri()->getQuery());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame('/api/v1/calls/statistics', $request->getUri()->getPath());
    }

    public function testPostImportCalls()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new CallApiClient($client);

        $importRequest = CallsImportRequest::fromArray([
            'manager_id' => 100,
            'city_id'    => 3,
            'calls'      => [],
        ]);

        $callApiClient->import($importRequest);

        $lastRequest = $mockHandler->getLastRequest();

        $this->assertAcceptJson($lastRequest);
        $this->assertContentTypeJson($lastRequest);

        $this->assertSame('POST', $lastRequest->getMethod());
        $this->assertSame(json_encode($importRequest->toArray()), $lastRequest->getBody()->getContents());
        $this->assertSame($this->baseHost, $lastRequest->getUri()->getHost());
        $this->assertSame('/api/v1/calls', $lastRequest->getUri()->getPath());
    }

    public function testSearch()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new CallApiClient($client);
        $searchRequest = CallsSearchRequest::fromArray([
            'manager_id' => 100,
            'city_id'    => 3,
            'from'       => 'foo',
            'to'         => 'bar',
        ]);
        $callApiClient->search($searchRequest);

        $lastRequest = $mockHandler->getLastRequest();

        $this->assertAcceptJson($lastRequest);
        $this->assertContentTypeJson($lastRequest);

        $this->assertSame(http_build_query($searchRequest->toArray()), $lastRequest->getUri()->getQuery());
        $this->assertSame('GET', $lastRequest->getMethod());
        $this->assertSame($this->baseHost, $lastRequest->getUri()->getHost());
        $this->assertSame('/api/v1/calls', $lastRequest->getUri()->getPath());
    }
}