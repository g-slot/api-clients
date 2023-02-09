<?php
declare(strict_types=1);


namespace Gilmon\ApiClients\Shared\Requests\Casters;

use Spatie\DataTransferObject\Caster;

class PhoneCaster implements Caster
{
    public function cast(mixed $value): mixed
    {
        $castedValue = preg_replace('/\D/', '', trim($value));

        if (empty($castedValue)) {
            return null;
        }

        if (strlen($castedValue) === 10) {
            return '7'.$castedValue;
        }

        if (strlen($castedValue) === 11 && $castedValue[0] === '8') {
            return '7'.substr($castedValue, 1);
        }

        return $castedValue;
    }
}
