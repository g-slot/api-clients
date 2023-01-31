<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls;

use DateTimeImmutable;
use Gilmon\ApiClients\BaseApiClient;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CallRecordApiClient extends BaseApiClient
{
    /**
     * @param  int  $managerId
     * @param  string  $file
     * @param  string  $phone
     * @param  \DateTimeImmutable  $date
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload(
        int $managerId,
        int $cityId,
        UploadedFile $file,
        string $phone,
        DateTimeImmutable $date
    ): array {
        return $this->multipartPostRequest('records', [
            'manager_id' => $managerId,
            'city_id'    => $cityId,
            'file'       => $file,
            'phone'      => $phone,
            'date'       => $date->format('Y-m-d H:i:s'),
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
        return $this->getRequest("records/$uuid");
    }
}
