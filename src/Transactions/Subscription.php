<?php

namespace CSWeb\Galaxpay\Transactions;

/**
 * Class Subscription
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Transactions
 */
class Subscription extends AbstractTransactions
{
    protected string $typeBill = self::TYPE_BILL_SUBSCRIPTION;

    protected $quantity = 'indeterminated';

    public function getQuantity()
    {
        if ($this->periodicity == 'yearly' && $this->compraComBoleto()) {
            return 5;
        }

        return $this->quantity;
    }
}