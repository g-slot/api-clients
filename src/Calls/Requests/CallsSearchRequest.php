<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Calls\Requests;

use Gilmon\ApiClients\Shared\Requests\Casters\PhoneCaster;
use Gilmon\ApiClients\Shared\Requests\Traits\UsePagination;
use Gilmon\ApiClients\Shared\Requests\Traits\UseSort;
use Gilmon\ApiClients\UseCreateFromArray;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;


final class CallsSearchRequest extends DataTransferObject
{
    use UseCreateFromArray;
    use UseSort;
    use UsePagination;

    #[MapFrom('manager_id'), MapTo('manager_id')]
    public mixed $managerId = null;

    #[MapFrom('city_id'), MapTo('city_id')]
    public mixed $cityId = null;

    #[MapFrom('from'), MapTo('from')]
    public string $from;

    #[MapFrom('to'), MapTo('to')]
    public string $to;

    #[MapFrom('phone'), MapTo('phone'), CastWith(PhoneCaster::class)]
    public ?string $phone;
}
