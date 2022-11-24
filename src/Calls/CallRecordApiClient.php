<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls;

use Gilmon\ApiClients\BaseApiClient;
use GuzzleHttp\Psr7\Utils;

class CallRecordApiClient extends BaseApiClient
{
    /**
     * @param  int  $managerId
     * @param  string  $filename
     * @param  string  $phone
     * @param  \DateTimeImmutable  $date
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload(int $managerId, string $filename, string $phone, \DateTimeImmutable $date): array
    {
        return $this->multipartPost('records', [
            'manager_id' => $managerId,
            'file' => Utils::tryFopen($filename, 'r'),
            'phone' => $phone,
            'date' => $date->format('Y-m-d H:i:s'),
        ]);
    }

    /**
     * @param  string  $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find(string $uuid): array
    {
        return $this->get("records/$uuid");
    }
}
