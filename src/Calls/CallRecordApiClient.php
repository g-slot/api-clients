<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls;

use Gilmon\ApiClients\BaseApiClient;
use Gilmon\ApiClients\Calls\Requests\CallRecordsSearchRequest;

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
    public function upload($request): array {
        return $this->multipartPostRequest('records', $request);
    }

    /**
     * @param  CallRecordsSearchRequest  $request
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(CallRecordsSearchRequest $request): array
    {
        return $this->getRequest("records", $request->all());
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
