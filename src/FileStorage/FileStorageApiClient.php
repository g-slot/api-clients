<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\FileStorage;

use Gilmon\ApiClients\BaseApiClient;
use GuzzleHttp\Psr7\Utils;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileStorageApiClient extends BaseApiClient
{
    /**
     * @param  string|UploadedFile  $file
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload(string|UploadedFile $file, string $module = 'common'): array
    {
        return $this->multipartPostRequest('files', [
            'file' => is_String($file) ? Utils::tryFopen($file, 'r') : $file,
            'module' => $module
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

    /**
     * @param  string  $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function download(string $uuid): array
    {
        return $this->getRequest("files/$uuid/download");
    }

    /**
     * @param  string  $uuid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function view(string $uuid): array
    {
        return $this->getRequest("files/$uuid/view");
    }
}
