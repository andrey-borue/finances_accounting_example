<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use App\Service\UserService;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\RestBundle\Controller\Annotations as FOS;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;

class UserController extends FOSRestController
{
    /** @var UserService */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @FOS\Post("/user")
     *
     * @ParamConverter(name="userDto", converter="fos_rest.request_body")
     *
     * @FOS\View(statusCode=201)
     */
    public function createAction(UserDto $userDto, ConstraintViolationList $validationErrors): User
    {
        if ($validationErrors->count()) {
            // Of course, here it is necessary to make better error handling.
            // Need create Exception listener
            throw new BadRequestHttpException((string)$validationErrors);
        }

        return $this->userService->createUser($userDto);
    }
}
