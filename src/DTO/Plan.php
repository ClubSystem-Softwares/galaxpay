<?php

namespace CSWeb\Galaxpay\DTO;

/**
 * Class Plan
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Models
 */
class Plan extends AbstractDTO
{
    protected array $casts = [
        'internalId'   => 'string',
        'initialPrice' => 'float',
    ];
}