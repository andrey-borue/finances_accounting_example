<?php declare(strict_types=1);

namespace App\Dto;

class AccountCreditDto
{
    /** @var string */
    protected $amount;

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}