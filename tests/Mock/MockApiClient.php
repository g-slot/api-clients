<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients\Mock;

use Gilmon\ApiClients\BaseApiClient;

class MockApiClient extends BaseApiClient
{
    public function getMethod(string $endpoint, array $data = [])
    {
        return $this->getRequest($endpoint, $data);
    }

    public function patchMethod(string $endpoint, array $data = []): array
    {
        return $this->patchRequest($endpoint, $data);
    }

    public function putMethod(string $endpoint, array $data = []): array
    {
        return $this->putRequest($endpoint, $data);
    }

    public function deleteMethod(string $endpoint): void
    {
        $this->deleteRequest($endpoint);
    }

    public function postMethod(string $endpoint, array $data = []): array
    {
        return $this->postRequest($endpoint, $data);
    }

    public function multipartPostMethod(string $endpoint, array $data = []): array
    {
        return $this->multipartPostRequest($endpoint, $data);
    }
}
