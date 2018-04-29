<?php

namespace App\Twig;

use App\Service\TransactionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TransactionExtension extends AbstractExtension
{

    /** @var Request */
    private $request;
    /** @var TransactionService */
    private $transactionService;

    public function __construct(
        RequestStack $requestStack,
        TransactionService $transactionService
    ) {
        $this->request =  $requestStack->getCurrentRequest();
        $this->transactionService = $transactionService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getTransactionTotalData', [$this, 'getTransactionTotalData']),
        ];
    }

    public function getTransactionTotalData(): array
    {
        $filter = $this->request->get('filter');

        $userId = $filter['account__user__id']['value'] ?? null;
        $start = $filter['createdAt']['value']['start'] ?? null;
        $end = $filter['createdAt']['value']['end'] ?? null;

        if (!$userId) {
            return [];
        }

        return $this->transactionService->getTotalByUserAndPeriod((int)$userId, $start, $end);
    }
}
