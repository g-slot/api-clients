<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Shared\Requests\Traits;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;

trait UsePagination
{
    #[MapFrom('per_page'), MapTo('per_page')]
    public mixed $perPage;

    #[MapFrom('page'), MapTo('page')]
    public mixed $page;
}