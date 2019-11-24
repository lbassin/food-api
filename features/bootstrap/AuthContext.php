<?php

declare(strict_types=1);

use App\Domain\Value\User\Email;
use App\Infrastructure\Entity\User;
use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthContext extends \Behat\MinkExtension\Context\RawMinkContext
{
    /** @var \Behatch\Context\RestContext */
    private $restContext;

    private $entityManager;

    private $tokenManager;

    private $token;

    public function __construct(EntityManagerInterface $entityManager, JWTTokenManagerInterface $tokenManager)
    {
        $this->entityManager = $entityManager;
        $this->tokenManager = $tokenManager;
    }

    /** @BeforeScenario */
    public function before(BeforeScenarioScope $scope)
    {
        /** @var InitializedContextEnvironment $environment */
        $environment = $scope->getEnvironment();
        $this->restContext = $environment->getContext('Behatch\Context\RestContext');
    }

    /**
     * @Given /^I am logged in with (\S*)$/
     */
    public function iAmLoggedInWith(string $email)
    {
        $this->token = null;

        /** @var User $user */
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => new Email($email)]);

        $this->token = $this->tokenManager->create($user);

        $this->restContext->iAddHeaderEqualTo('Authorization', 'Bearer '.$this->token);
    }

    /**
     * @Given /^I am not logged in$/
     */
    public function iAmNotLoggedIn()
    {
        $this->token = null;

        $this->restContext->iAddHeaderEqualTo('Authorization', '');
    }
}
