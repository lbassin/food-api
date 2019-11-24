<?php

declare(strict_types=1);

use Behat\MinkExtension\Context\RawMinkContext;
use Behatch\HttpCall\Request;

class ProfileContext extends RawMinkContext
{
    /**
     * @var Request\Goutte
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @When /^I send a request to get my profile$/
     */
    public function iSendARequestToGetMyProfile()
    {
        $this->request->setHttpHeader('content-type', 'application/json');

        return $this->request->send("GET", $this->locatePath('/api/profile'), [], []);
    }
}