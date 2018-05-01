<?php declare(strict_types=1);

namespace App\Dto;

class AccountDto
{
    /** @var int */
    private $id;
    /** @var string */
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        return $this;
    }
}