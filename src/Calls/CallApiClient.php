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
     */
    public function import(int $managerId, int $cityId, array $calls): array
    {
        return $this->post('calls', [
            'manager_id' => $managerId,
            'city_id'    => $cityId,
            'calls'      => $calls,
        ]);
    }

    /**
     * @param  array  $request
     *
     * @return mixed
     */
    public function search(array $request): array
    {
        return $this->get('calls', $request);
    }

    /**
     * @param  int  $managerId
     * @param  \DateTimeImmutable  $from
     * @param  \DateTimeImmutable  $to
     *
     * @return mixed
     */
    public function statistics(int $managerId, \DateTimeImmutable $from, \DateTimeImmutable $to): array
    {
        return $this->get('statistics/calls', [
            'manager_id' => $managerId,
            'from'       => $from->format('Y-m-d H:i:s'),
            'to'         => $to->format('Y-m-d H:i:s'),
        ]);
    }
}