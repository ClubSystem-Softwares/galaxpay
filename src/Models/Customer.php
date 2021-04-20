<?php

namespace CSWeb\Galaxpay\Models;

/**
 * Class Customer
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Models
 */
class Customer extends AbstractModel
{
    protected array $casts = [
        'internalId'    => 'int',
        'integrationId' => 'int',
    ];
}