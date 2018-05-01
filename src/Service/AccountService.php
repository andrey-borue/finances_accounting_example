<?php

namespace App\Service;

use App\Dto\TransferDto;
use App\Entity\Account;
use App\Entity\Transaction;
use App\Repository\AccountRepository;
use App\Repository\CurrencyRateRepository;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;

class AccountService
{
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var AccountRepository */
    protected $accountRepository;
    /** @var CurrencyRepository */
    protected $currencyRepository;
    /** @var CurrencyRateRepository */
    protected $currencyRateRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        AccountRepository $accountRepository,
        CurrencyRepository $currencyRepository,
        CurrencyRateRepository $currencyRateRepository
    ) {
        $this->entityManager = $entityManager;
        $this->accountRepository = $accountRepository;
        $this->currencyRepository = $currencyRepository;
        $this->currencyRateRepository = $currencyRateRepository;
    }


    public function creditAccount(Account $account, string $amount)
    {
        $transaction = new Transaction();
        $transaction
            ->setIncome($amount)
            ->setAccount($account);

        $account->setTotal(bcadd($account->getTotal(), $amount, 2));

        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return $account;
    }

    public function transfer(TransferDto $dto): void
    {
        $accountFrom = $this->accountRepository->find($dto->getFrom());
        $accountTo = $this->accountRepository->find($dto->getTo());
        // ...Check it and throw an exception

        $currency = $this->currencyRepository->findOneBy(['code' => $dto->getCurrency()]);
        $rate = $this->currencyRateRepository->findOneBy(['currency' => $currency, 'date' => new \DateTime()]);
        // ...Check if rate exists and throw an exception

        /** @noinspection NullPointerExceptionInspection */
        $amountInUsd = bcdiv($dto->getAmount(), $rate->getRate(), 2);

        /** @noinspection NullPointerExceptionInspection */
        $rateFrom = $this->currencyRateRepository->findOneBy(['currency' => $accountFrom->getCurrency(), 'date' => new \DateTime()]);
        /** @noinspection NullPointerExceptionInspection */
        $rateTo = $this->currencyRateRepository->findOneBy(['currency' => $accountTo->getCurrency(), 'date' => new \DateTime()]);
        // ...Check it and throw an exception

        $incomeAmount = bcmul($amountInUsd, $rateTo->getRate(), 2);
        $outcomeAmount = bcdiv($amountInUsd, $rateFrom->getRate(), 2);

        $transactionTo = new Transaction();
        $transactionTo
            ->setAccount($accountTo)
            ->setExternalAccount($accountFrom)
            ->setIncomeOrigin($amountInUsd)
            ->setIncome($incomeAmount);
        $accountTo->setTotal(bcadd($accountFrom->getTotal(), $incomeAmount, 2));


        $transactionFrom = new Transaction();
        $transactionFrom
            ->setAccount($accountFrom)
            ->setExternalAccount($accountTo)
            ->setOutcomeOrigin($amountInUsd)
            ->setOutcome($outcomeAmount);
        $accountFrom->setTotal(bcsub($accountFrom->getTotal(), $outcomeAmount, 2));

        $this->entityManager->persist($transactionFrom);
        $this->entityManager->persist($transactionTo);

        $this->entityManager->flush();
    }

}