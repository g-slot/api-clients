<?php
declare(strict_types=1);


namespace Gilmon\ApiClients;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BaseApiClient
{
    public function __construct(protected readonly ClientInterface $client)
    {
    }

    /**
     * @param  string  $endpoint
     * @param  array  $query
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getRequest(string $endpoint, array $query = []): array
    {
        return $this->request('GET', $endpoint, ['query' => $query]);
    }

    /**
     * @param  string  $method
     * @param  string  $endpoint
     * @param  array  $options
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $endpoint, array $options = []): array
    {
        $options['headers'] = $this->applyHeaders($options['headers'] ?? []);
        $response = $this->client->request($method, $endpoint, $options);
        return $this->parseResult($response->getBody());
    }

    /**
     * @param  array  $headers
     *
     * @return array|string[]
     */
    protected function applyHeaders(array $headers): array
    {
        return $headers + [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ];
    }

    /**
     * @param  \Psr\Http\Message\StreamInterface  $body
     *
     * @return array
     */
    protected function parseResult(StreamInterface $body): array
    {
        return json_decode($body->getContents(), true) ?? [];
    }

    /**
     * @param  string  $endpoint
     * @param  array  $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function patchRequest(string $endpoint, array $data = []): array
    {
        return $this->request('PATCH', $endpoint, ['json' => $data]);
    }

    /**
     * @param  string  $endpoint
     * @param  array  $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function putRequest(string $endpoint, array $data = []): array
    {
        return $this->request('PUT', $endpoint, ['json' => $data]);
    }

    /**
     * @param  string  $endpoint
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function deleteRequest(string $endpoint): void
    {
        $this->request('DELETE', $endpoint);
    }

    /**
     * @param  string  $endpoint
     * @param  array  $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function postRequest(string $endpoint, array $data = []): array
    {
        return $this->request('POST', $endpoint, ['json' => $data]);
    }

    /**
     * @param  string  $endpoint
     * @param  array  $data
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function multipartPostRequest(string $endpoint, array $data = []): array
    {
        return $this->request('POST', $endpoint, [
            'multipart' => $this->prepareMultiPartRequest($data),
        ]);
    }

    /**
     * @param  array  $data
     *
     * @return array
     */
    private function prepareMultiPartRequest(array $data): array
    {
        return array_map(function ($key) use ($data) {
            $field = $data[$key];
            if ($field instanceof UploadedFile) {
                return [
                    'name'     => $key,
                    'contents' => $field->getContent(),
                    'filename' => $field->getClientOriginalName(),
                ];
            }

            return [
                'name'     => $key,
                'contents' => $field,
            ];
        }, array_keys($data));
    }
}
