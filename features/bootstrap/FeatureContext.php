<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }



    /**
     * @When /^I press the uplaod button$/
     */
    public function iPressTheUplaodButton()
    {
    }

    /**
     * @Then /^I should see the success page$/
     */
    public function iShouldSeeTheSuccessPage()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Given /^I have entered a json filename "([^"]*)"$/
     */
    public function iHaveEnteredAJsonFilename1($arg1)
    {
    }
}
