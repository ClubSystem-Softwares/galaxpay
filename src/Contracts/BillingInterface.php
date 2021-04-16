<?php

namespace CSWeb\Galaxpay\Contracts;

use stdClass;

/**
 * Interface BillingInterface
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @package CSWeb\Galaxpay\Contracts
 */
interface BillingInterface
{
    public function getIntegrationId(): string;

    public function haveIntegrationId(): bool;

    public function getCustomerIntegrationId(): string;

    public function getValue(): float;

    public function getPayDay(): string;

    public function getInfo();

    public function getTypeBill(): string;

    public function getQuantity();

    public function getInstallments(): int;

    public function getPaymentType(): string;

    public function getPeriodicity(): ?string;

    public function getCard(): stdClass;

    public function setPlanInternalId(string $planId = null);

    public function getPlanInternalId(): ?string;

    public function havePlanInternalId(): bool;

    public function getEndpointMethod(): string;

    public function compraComBoleto(): bool;

    public function compraComCartao(): bool;
}