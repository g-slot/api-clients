<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls\Requests;

use Gilmon\ApiClients\UseCreateFromArray;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;


final class CallsSearchRequest extends DataTransferObject
{
    use UseCreateFromArray;

    #[MapFrom('manager_id'), MapTo('manager_id')]
    public int $managerId;

    #[MapFrom('city_id'), MapTo('city_id')]
    public int $cityId;

    #[MapFrom('from'), MapTo('from')]
    public string $from;

    #[MapFrom('to'), MapTo('to')]
    public string $to;
}
