<?php

namespace CSWeb\Galaxpay\Transactions;

use Carbon\Carbon;
use CSWeb\Galaxpay\Contracts\BillingInterface;
use stdClass;

class AbstractTransactions implements BillingInterface
{
    protected string $customerIntegrationId;

    protected string $integrationId;

    protected ?Carbon $payDay = null;

    protected float $value;

    protected string $info = '';

    protected string $typeBill;

    protected int $quantity = 1;

    protected int $installments = 1;

    /**
     * @var mixed
     */
    protected $paymentType;

    protected ?string $periodicity = null;

    protected ?string $planInternalId = null;

    protected stdClass $card;

    public function getCustomerIntegrationId(): string
    {
        return $this->customerIntegrationId;
    }

    public function setCustomerIntegrationId($customer): AbstractTransactions
    {
        $this->customerIntegrationId = (string)$customer;

        return $this;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function setInfo(string $info): AbstractTransactions
    {
        $this->info = $info;

        return $this;
    }

    public function getIntegrationId(): string
    {
        return $this->integrationId;
    }

    public function setIntegrationId(string $integrationId): AbstractTransactions
    {
        $this->integrationId = (string)$integrationId;

        return $this;
    }

    public function haveIntegrationId(): bool
    {
        return !is_null($this->integrationId);
    }

    public function getPayDay(): string
    {
        if (!$this->payDay) {
            $today = Carbon::today();

            return $this->compraComBoleto()
                ? $today->addDays(3)->format('Y-m-d')
                : $today->format('Y-m-d');
        }

        return $this->payDay->format('Y-m-d');
    }

    public function setPayDay(Carbon $payday): AbstractTransactions
    {
        $this->payDay = $payday;

        return $this;
    }

    public function compraComBoleto(): bool
    {
        return $this->getPaymentType() === 'boleto';
    }

    public function getPaymentType(): string
    {
        if ($this->paymentType === 'boleto') {
            return $this->paymentType;
        }

        return ($this->paymentType == 'cartao') ? 'newCard' : 'existingCard';
    }

    public function setPaymentType($paymentType): AbstractTransactions
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): AbstractTransactions
    {
        $this->value = $value;

        return $this;
    }

    public function getTypeBill(): string
    {
        return $this->typeBill;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): AbstractTransactions
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getInstallments(): int
    {
        return $this->installments;
    }

    public function setInstallments(int $installments): AbstractTransactions
    {
        $this->installments = $installments;

        return $this;
    }

    public function getPeriodicity(): ?string
    {
        return $this->periodicity;
    }

    public function setPeriodicity(string $periodicity): AbstractTransactions
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    public function getCard(): stdClass
    {
        return $this->card;
    }

    public function setCard(string $paymentType, array $cardData): AbstractTransactions
    {
        $this->setPaymentType($paymentType);
        $paymentType = $this->getPaymentType();

        $card = new stdClass();

        if ($paymentType != 'boleto') {
            if ($paymentType == 'newCard') {
                $expirationDate = Carbon::createFromFormat('m/y', $cardData['expiration']);

                $card->number      = $cardData['number'];
                $card->holder      = $cardData['holder'];
                $card->expiryMonth = $expirationDate->format('m');
                $card->expiryYear  = $expirationDate->format('Y');
                $card->cvv         = $cardData['cvv'];
                $card->brand       = $cardData['brand'];
            } else {
                $card->integrationId = $this->paymentType;
            }
        }

        $this->card = $card;

        return $this;
    }

    public function getEndpointMethod(): string
    {
        return ($this->compraComBoleto()) ? 'createPaymentBillBoleto' : 'createPaymentBill';
    }

    public function compraComCartao(): bool
    {
        $type = $this->getPaymentType();

        return ($type === 'newCard' || $type === 'existingCard');
    }

    public function getPlanInternalId(): ?string
    {
        return $this->planInternalId;
    }

    public function setPlanInternalId(string $planId = null): AbstractTransactions
    {
        if (!is_null($planId)) {
            $this->planInternalId = (string)$planId;
        }

        return $this;
    }

    public function havePlanInternalId(): bool
    {
        return !is_null($this->planInternalId);
    }
}