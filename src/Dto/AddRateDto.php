<?php declare(strict_types=1);

namespace App\Dto;

class AddRateDto
{
    /** @var string */
    protected $date;
    /** @var string */
    protected $rate;
    /** @var string */
    protected $currency;

    public function getDate(): ?\DateTime
    {
        return new \DateTime($this->date);
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): self
    {
        $this->rate = $rate;

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
}