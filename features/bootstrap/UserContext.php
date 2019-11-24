<?php

declare(strict_types=1);

use App\Application\Factory\UserFactory;
use App\Domain\Value\User\Email;
use App\Infrastructure\Entity\User;
use Behatch\HttpCall\Request;
use Behatch\Json\Json;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class UserContext extends \Behat\MinkExtension\Context\RawMinkContext
{
    /**
     * @var Request\Goutte
     */
    protected $request;

    private $entityManager;

    private $jwtEncoder;

    private $tokenManager;

    private $userFactory;

    public function __construct(
        Request $request,
        EntityManagerInterface $entityManager,
        JWTEncoderInterface $jwtEncoder,
        JWTTokenManagerInterface $tokenManager,
        UserFactory $userFactory
    ) {
        $this->request = $request;
        $this->entityManager = $entityManager;
        $this->jwtEncoder = $jwtEncoder;
        $this->tokenManager = $tokenManager;
        $this->userFactory = $userFactory;
    }

    /**
     * @Given /^there is no user with email "(\S*)"$/
     */
    public function thereIsNoUserWithEmail(string $email): void
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => new Email($email)]);

        if (!$user) {
            return;
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    /**
     * @When /^I send a new user request with data$/
     */
    public function iSendANewUserRequestWithData(\Behat\Gherkin\Node\TableNode $body)
    {
        $data = json_encode($body->getRowsHash());

        $this->request->setHttpHeader('content-type', 'application/json');

        return $this->request->send("POST", $this->locatePath('/api/users'), [], [], $data);
    }

    /**
     * @Given /^the user "(\S+)" should have a calendar with (\d+) days$/
     */
    public function aUserShouldHaveACalendarWithDays(string $email, int $numberOfdays)
    {
        /** @var \App\Domain\Entity\User $user */
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => new Email($email)]);

        $days = $user->getCalendar()->getDays();

        if (count($days) !== $numberOfdays) {
            throw new Exception(sprintf('User has %d days, %d expected', count($days), $numberOfdays));
        }
    }

    /**
     * @Given /^there is a user with email "(\S*)" and password "(\S*)"$/
     */
    public function thereIsAUserWithEmailAndPassword(string $email, string $password): void
    {
        $this->thereIsNoUserWithEmail($email);

        $dto = (new App\Application\DTO\UserDTO())->setEmail($email)->setPassword($password);
        $this->userFactory->createUser($dto);
    }

    /**
     * @When /^I send a login request with data$/
     */
    public function iSendALoginRequestWithData(\Behat\Gherkin\Node\TableNode $args)
    {
        $data = json_encode($args->getRowsHash());

        $this->request->setHttpHeader('content-type', 'application/json');

        return $this->request->send("POST", $this->locatePath('/api/login'), [], [], $data);
    }

    /**
     * @Given /^the response should contain a valid token$/
     */
    public function theResponseShouldContainAValidToken()
    {
        $data = (array) (new Json($this->getMink()->getSession()->getPage()->getContent()))->getContent();

        if (empty($data['token'])) {
            throw new Exception('Response does not contain a token');
        }

        $this->jwtEncoder->decode($data['token']);
    }
}
