<?php declare(strict_types=1);

namespace App\Service;

use App\Dto\AddRateDto;
use App\Entity\CurrencyRate;
use App\Repository\CurrencyRateRepository;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;

class CurrencyService
{
    /** @var CurrencyRepository */
    protected $currencyRepository;
    /** @var CurrencyRateRepository */
    protected $rateRepository;
    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(
        CurrencyRepository $currencyRepository,
        CurrencyRateRepository $rateRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->currencyRepository = $currencyRepository;
        $this->rateRepository = $rateRepository;
        $this->entityManager = $entityManager;
    }


    public function addRate(AddRateDto $dto): void
    {
        $currency = $this->currencyRepository->findOneBy(['code' => $dto->getCurrency()]);

        // Check if this rate already exists...
        $rate = new CurrencyRate();
        $rate
            ->setCurrency($currency)
            ->setRate($dto->getRate())
            ->setDate($dto->getDate());

        $this->entityManager->persist($rate);
        $this->entityManager->flush();
    }

}