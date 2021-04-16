<?php

namespace CSWeb\Galaxpay\Transactions;

/**
 * Class Sale
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Transactions
 */
class Sale extends AbstractTransactions
{
    protected string $typeBill = self::TYPE_BILL_SALE;
}