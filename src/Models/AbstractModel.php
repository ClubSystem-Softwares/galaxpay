<?php

namespace CSWeb\Galaxpay\Models;

use Illuminate\Support\Fluent;

/**
 * Class AbstractModel
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Models
 */
class AbstractModel extends Fluent
{
    use Concerns\CastsAttributes;

    public function get($key, $default = null)
    {
        $value = parent::get($key, $default);

        return $this->castAttribute($key, $value);
    }
}