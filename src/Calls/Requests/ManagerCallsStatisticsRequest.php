<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls\Requests;

use Gilmon\ApiClients\UseCreateFromArray;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

final class ManagerCallsStatisticsRequest extends DataTransferObject
{
    use UseCreateFromArray;

    #[MapFrom('manager_id'), MapTo('manager_id')]
    public int $managerId;

    #[MapFrom('from'), MapTo('from')]
    public string $from;

    #[MapFrom('to'), MapTo('to')]
    public string $to;
}
