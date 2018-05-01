<?php declare(strict_types=1);

namespace App\Service;

use App\Dto\UserDto;
use App\Entity\Account;
use App\Entity\Currency;
use App\Entity\User;
use App\Repository\CurrencyRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    /** @var UserRepository */
    protected $userRepository;
    /** @var CurrencyRepository */
    protected $currencyRepository;
    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(
        UserRepository $userRepository,
        CurrencyRepository $currencyRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->userRepository = $userRepository;
        $this->currencyRepository = $currencyRepository;
        $this->entityManager = $entityManager;
    }

    public function createUser(UserDto $userDto): User
    {
        $user = new User();

        $user
            ->setName($userDto->getName())
            ->setCity($userDto->getCity())
            ->setCountry($userDto->getCountry());

        $currency = $this->currencyRepository->findOneBy(['code' => $userDto->getCurrency()]);

        if (!$currency) {
            $currency = new Currency();
            $currency->setCode($userDto->getCurrency());
            $this->entityManager->persist($currency);
        }

        $account = new Account();
        $account
            ->setCurrency($currency)
            ->setTotal('0')
            ->setUser($user);
        $this->entityManager->persist($account);

        $this->entityManager->persist($user);

        $this->entityManager->flush();

        return $user;
    }
}