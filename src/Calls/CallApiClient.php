<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls;

use Gilmon\ApiClients\BaseApiClient;
use Gilmon\ApiClients\Calls\Requests\CallsImportRequest;
use Gilmon\ApiClients\Calls\Requests\CallsSearchRequest;
use Gilmon\ApiClients\Calls\Requests\CallsStatisticsRequest;

class CallApiClient extends BaseApiClient
{
    /**
     * @param  \Gilmon\ApiClients\Calls\Requests\CallsImportRequest  $request
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function import(CallsImportRequest $request): array
    {
        return $this->postRequest('calls', $request->all());
    }

    /**
     * @param  \Gilmon\ApiClients\Calls\Requests\CallsSearchRequest  $request
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(CallsSearchRequest $request): array
    {
        return $this->getRequest('calls', $request->all());
    }

    /**
     * @param  \Gilmon\ApiClients\Calls\Requests\CallsStatisticsRequest  $request
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function statistics(CallsStatisticsRequest $request): array
    {
        return $this->getRequest('calls/statistics', $request->all());
    }

    /**
     * @param  \Gilmon\ApiClients\Calls\Requests\CallsStatisticsRequest  $request
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function extendedStatistics(CallsStatisticsRequest $request): array
    {
        return $this->getRequest('calls/statistics/extended', $request->all());
    }
}
