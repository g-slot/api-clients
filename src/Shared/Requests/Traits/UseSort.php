<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Shared\Requests\Traits;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;

trait UseSort
{
    #[MapFrom('sort'), MapTo('sort')]
    public mixed $sort;
}