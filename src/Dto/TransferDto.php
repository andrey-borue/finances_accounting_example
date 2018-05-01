<?php declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints;

class TransferDto
{
    /** @var string */
    protected $amount;

    /**
     * @var string
     * @Constraints\Currency()
     */
    protected $currency;

    /**
     * Account Id
     * @var int
     */
    protected $from;

    /**
     * Account Id
     * @var int
     */
    protected $to;

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getFrom(): ?int
    {
        return $this->from;
    }

    public function setFrom(?int $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): ?int
    {
        return $this->to;
    }

    public function setTo(?int $to): self
    {
        $this->to = $to;

        return $this;
    }
}