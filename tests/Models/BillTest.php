<?php

namespace Tests\Models;

use CSWeb\Galaxpay\Models\Bill;
use PHPUnit\Framework\TestCase;

class BillTest extends TestCase
{
    public function testIfAttributeCastingIsWorking()
    {
        $data = [
            "internalId"            => "2",
            "integrationId"         => "",
            "periodicity"           => "monthly",
            "quantity"              => "5",
            "dateFirst"             => "2020-05-15",
            "status"                => "active",
            "statusDescription"     => "Ativa",
            "additionalInfo"        => null,
            "link"                  => "https://app.galaxpay.com.br/testegalaxpay/cobranca/2/cartao",
            "value"                 => "50.00",
            "brand"                 => "Visa",
            "cardTruncate"          => "4024********4517",
            "customerInternalId"    => "1",
            "customerIntegrationId" => "",
            "customerName"          => "Galax Pay Teste",
            "operator"              => "bin",
            "operatorName"          => "BIN",
        ];

        $bill = new Bill($data);

        $this->assertIsInt($bill->internalId);
        $this->assertIsFloat($bill->value);
        $this->assertIsInt($bill->customerInternalId);
        $this->assertIsInt($bill->customerIntegrationId);
    }
}