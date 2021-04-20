<?php

namespace CSWeb\Galaxpay\Models;

/**
 * Class Plan
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Models
 */
class Plan extends AbstractModel
{
    protected array $casts = [
        'internalId'   => 'string',
        'initialPrice' => 'float',
    ];
}