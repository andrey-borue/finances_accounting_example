<?php

namespace App\Service;

use App\Repository\TransactionRepository;

class TransactionService
{
    /** @var TransactionRepository */
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getTotalByUserAndPeriod(int $userId, ?string $start, ?string $end): array
    {
        $qb = $this->transactionRepository->createQueryBuilder('transaction');

        $qb
            ->select([
                'SUM(transaction.income) as income',
                'SUM(transaction.incomeOrigin) as income_origin',
                'SUM(transaction.outcome) as outcome',
                'SUM(transaction.outcomeOrigin) as outcome_origin',
            ]);

        $qb
            ->join('transaction.account', 'account')
            ->andWhere('account.user = :user')
            ->setParameter('user', $userId);

        if ($start) {
            $qb->andWhere('transaction.createdAt >= :start');
        }

        if ($end) {
            $qb->andWhere('transaction.createdAt <= :end');
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

}