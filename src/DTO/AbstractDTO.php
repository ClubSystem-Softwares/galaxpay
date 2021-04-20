<?php

namespace CSWeb\Galaxpay\DTO;

use Illuminate\Support\Fluent;

/**
 * AbstractDTO
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Models
 */
class AbstractDTO extends Fluent
{
    use Concerns\CastsAttributes;

    public function get($key, $default = null)
    {
        $value = parent::get($key, $default);

        return $this->castAttribute($key, $value);
    }

    public function toArray(): array
    {
        $data = [];

        foreach ($this->attributes as $attribute => $value) {
            $data[$attribute] = $this->get($attribute, $value);
        }

        return $data;
    }
}