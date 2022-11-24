<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients\Storage;

use Gilmon\ApiClients\Storage\StorageApiClient;
use Gilmon\Tests\ApiClients\Mock\MockHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Response;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StorageApiClientTest extends \Gilmon\Tests\ApiClients\ApiTestCase
{
    private string $baseHost = 'calls.service';
    private string $baseUri = 'http://calls.service/api/v1/';

    public function testUploadFileByPath()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new StorageApiClient($client);
        $callApiClient->upload(__DIR__ . '/../Data/record.mp3');

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);

        $this->assertInstanceOf(MultipartStream::class, $request->getBody());
        $contents = $request->getBody()->getContents();
        $this->assertTrue(str_contains($contents, 'Content-Disposition: form-data; name="file"; filename="record.mp3"') !== false);
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame("/api/v1/files", $request->getUri()->getPath());
    }

    public function testUploadFileClass()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $callApiClient = new StorageApiClient($client);
        $callApiClient->upload(
            new UploadedFile(__DIR__ . '/../Data/record.mp3', 'original_record_name.mp3')
        );

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);

        $this->assertInstanceOf(MultipartStream::class, $request->getBody());
        $contents = $request->getBody()->getContents();
        $this->assertTrue(str_contains($contents, 'Content-Disposition: form-data; name="file"; filename="original_record_name.mp3"') !== false);
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame("/api/v1/files", $request->getUri()->getPath());
    }


    public function testFindFile()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $uuid = Uuid::uuid4()->toString();

        $callApiClient = new StorageApiClient($client);
        $callApiClient->get($uuid);

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);
        $this->assertContentTypeJson($request);

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame("/api/v1/files/$uuid", $request->getUri()->getPath());
    }

    public function testDeleteFile()
    {
        $mockHandler = new MockHandler([new Response()]);
        $client = new Client([
            'base_uri' => $this->baseUri,
            'handler'  => $mockHandler,
        ]);

        $uuid = Uuid::uuid4()->toString();

        $callApiClient = new StorageApiClient($client);
        $callApiClient->delete($uuid);

        $request = $mockHandler->getLastRequest();

        $this->assertAcceptJson($request);
        $this->assertContentTypeJson($request);

        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame($this->baseHost, $request->getUri()->getHost());
        $this->assertSame("/api/v1/files/$uuid", $request->getUri()->getPath());
    }
}
