<?php

namespace App\Controller;

use App\Dto\AddRateDto;
use App\Service\CurrencyService;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\Controller\Annotations as FOS;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;

class CurrencyController extends FOSRestController
{
    /** @var CurrencyService */
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @FOS\Post("/currency/rate")
     *
     * @ParamConverter(name="dto", converter="fos_rest.request_body")
     *
     * @FOS\View(statusCode=201)
     */
    public function addAction(AddRateDto $dto, ConstraintViolationList $validationErrors): void
    {
        if ($validationErrors->count()) {
            throw new BadRequestHttpException((string)$validationErrors);
        }

        $this->currencyService->addRate($dto);
    }
}
