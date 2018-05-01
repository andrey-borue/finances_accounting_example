<?php

namespace App\Controller;

use App\Dto\AccountCreditDto;
use App\Dto\AccountDto;
use App\Dto\TransferDto;
use App\Entity\Account;
use App\Service\AccountService;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\Controller\Annotations as FOS;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;

class AccountController extends FOSRestController
{
    /** @var AccountService */
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * @FOS\Post("/account/{account}")
     *
     * @ParamConverter(name="dto", converter="fos_rest.request_body")
     *
     * @FOS\View(statusCode=201)
     */
    public function creditAction(AccountCreditDto $dto, ConstraintViolationList $validationErrors, Account $account): AccountDto
    {
        if ($validationErrors->count()) {
            throw new BadRequestHttpException((string)$validationErrors);
        }

        $this->accountService->creditAccount($account, $dto->getAmount());

        $accountDto = new AccountDto();
        $accountDto
            ->setId($account->getId())
            ->setTotal($account->getTotal());

        return $accountDto;
    }

    /**
     * @FOS\Post("/transfer")
     *
     * @ParamConverter(name="dto", converter="fos_rest.request_body")
     *
     * @FOS\View(statusCode=201)
     */
    public function transferAction(TransferDto $dto, ConstraintViolationList $validationErrors)
    {
        if ($validationErrors->count()) {
            throw new BadRequestHttpException((string)$validationErrors);
        }

        $this->accountService->transfer($dto);
    }
}
