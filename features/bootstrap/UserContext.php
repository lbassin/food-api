<?php

declare(strict_types=1);

use App\Domain\Value\User\Email;
use App\Infrastructure\Entity\User;
use Behatch\HttpCall\Request;

class UserContext extends \Behat\MinkExtension\Context\RawMinkContext
{
    /**
     * @var Request\Goutte
     */
    protected $request;

    private $entityManager;

    public function __construct(Request $request, \Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->request = $request;
        $this->entityManager = $entityManager;
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
}
