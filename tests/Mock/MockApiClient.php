<?php
declare(strict_types=1);


namespace Gilmon\Tests\ApiClients\Mock;

use Gilmon\ApiClients\BaseApiClient;

class MockApiClient extends BaseApiClient
{
    public function getMethod(string $endpoint, array $data = [])
    {
        return $this->get($endpoint, $data);
    }

    public function patchMethod(string $endpoint, array $data = []): array
    {
        return $this->patch($endpoint, $data);
    }

    public function putMethod(string $endpoint, array $data = []): array
    {
        return $this->put($endpoint, $data);
    }

    public function deleteMethod(string $endpoint): void
    {
        $this->delete($endpoint);
    }

    public function postMethod(string $endpoint, array $data = []): array
    {
        return $this->post($endpoint, $data);
    }

    public function multipartPostMethod(string $endpoint, array $data = []): array
    {
        return $this->multipartPost($endpoint, $data);
    }
}
