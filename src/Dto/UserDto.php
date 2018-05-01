<?php declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints;

class UserDto
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $city;
    /** @var string */
    protected $country;
    /**
     * @var string
     * @Constraints\Currency()
     */
    protected $currency;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

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