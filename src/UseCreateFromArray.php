<?php
declare(strict_types=1);


namespace Gilmon\ApiClients;

trait UseCreateFromArray
{
    /**
     * @param  array  $values
     *
     * @return self
     */
    public static function fromArray(array $values): self
    {
        return new self($values);
    }
}
