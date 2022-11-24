<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Storage;

use Gilmon\ApiClients\BaseApiClient;
use GuzzleHttp\Psr7\Utils;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StorageApiClient extends BaseApiClient
{
    /**
     * @param  string|UploadedFile  $file
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload(string|UploadedFile $file): array
    {
        return $this->multipartPostRequest('files', [
            'file' => is_String($file) ? Utils::tryFopen($file, 'r') : $file
        ]);
    }

    /**
     * @param  string  $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $uuid): array
    {
        return $this->getRequest("files/$uuid");
    }

    /**
     * @param  string  $uuid
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $uuid): void
    {
        $this->deleteRequest("files/$uuid");
    }
}