<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients\Calls;

use Gilmon\ApiClients\Calls\CallRecordApiClient;
use Gilmon\Tests\ApiClients\ApiTestCase;
use Gilmon\Tests\ApiClients\Mock\MockHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Response;
use Ramsey\Uuid\Uuid;

class CallRecordApiClientTest extends ApiTestCase
{

    private string $baseHost = 'calls.service';
    private string $baseUri = 'http://calls.service/api/v1/';

    public function testFindCallRecord()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $uuid = Uuid::uuid4()->toString();

        $callApiClient = new CallRecordApiClient($client);
        $callApiClient->find($uuid);

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);
        $this->assertContentTypeJson($request);

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame("/api/v1/records/$uuid", $request->getUri()->getPath());
    }

    public function testUploadCallRecords()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new CallRecordApiClient($client);
        $callApiClient->upload(
            101,
            __DIR__ . '/../Data/record.mp3',
            '79005004488',
            new \DateTimeImmutable()
        );

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);

        $this->assertInstanceOf(MultipartStream::class, $request->getBody());
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame("/api/v1/records", $request->getUri()->getPath());
    }
}