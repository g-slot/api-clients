<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls;

use Gilmon\ApiClients\BaseApiClient;

class CallApiClient extends BaseApiClient
{
    /**
     * @param  int  $managerId
     * @param  int  $cityId
     * @param  array  $calls
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function import(int $managerId, int $cityId, array $calls): array
    {
        return $this->postRequest('calls', [
            'manager_id' => $managerId,
            'city_id'    => $cityId,
            'calls'      => $calls,
        ]);
    }

    /**
     * @param  array  $request
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $request): array
    {
        return $this->getRequest('calls', $request);
    }

    /**
     * @param  int  $managerId
     * @param  \DateTimeImmutable  $from
     * @param  \DateTimeImmutable  $to
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function statistics(int $managerId, \DateTimeImmutable $from, \DateTimeImmutable $to): array
    {
        return $this->getRequest('statistics/calls', [
            'manager_id' => $managerId,
            'from'       => $from->format('Y-m-d H:i:s'),
            'to'         => $to->format('Y-m-d H:i:s'),
        ]);
    }
}