<?php

namespace CSWeb\Galaxpay\DTO;

/**
 * Class Bill
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Models
 */
class Bill extends AbstractDTO
{
    protected array $casts = [
        'internalId'            => 'int',
        'value'                 => 'float',
        'customerInternalId'    => 'int',
        'customerIntegrationId' => 'int',
        'transactions'          => 'collection',
    ];
}