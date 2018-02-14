<?php
use Mapper\Main as Map;

class MainCest
{
    private $userUrl;

    private $tester;
    private $slow = false;

    /**
     * Common instructions to run before all tests
     *
     * @param AcceptanceTester $I the WebDriver
     *
     * @return void
     */
    public function _before(AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    /**
     * Common instructions to run after all tests
     *
     * @param AcceptanceTester $I the WebDriver
     *
     * @return void
     */
    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * Instructions to run if a test fails
     *
     * @param AcceptanceTester $I the WebDriver
     *
     * @return void
     */
    public function _failed(AcceptanceTester $I)
    {
        $I->pauseExecution();
    }

    public function loginPage(AcceptanceTester $I)
    {
        $I->wantTo('Login');

        // Load the page
        $I->amOnPage(Map::URL_LOGIN);

        // Save a screenshot
        $I->makeScreenshot('login_' . time());

        $this->wait();
        $I->click(Map::FIELD_USERNAME);
        $I->pressKey(Map::FIELD_USERNAME, 'B');
        $this->wait();
        $I->pressKey(Map::FIELD_USERNAME, 'a');
        $this->wait();
        $I->pressKey(Map::FIELD_USERNAME, 't');
        $this->wait();
        $I->appendField(Map::FIELD_USERNAME, 'man');

        $this->wait();
        $I->fillField(Map::FIELD_PASSWORD, 'passwd');
        $this->wait();
        $I->click('Sign in');
        $this->wait();

        $I->seeInCurrentUrl(Map::URL_DASHBOARD);
        $I->see('Dashboard', Map::AREA_DASHBOARD);

        // Compare visually
        $I->dontSeeVisualChanges('dashboard', Map::AREA_DASHBOARD, ['tbody'], 5);

        // Save the logged in state
        $I->saveSessionSnapshot('logged_in');
    }

    public function dashboardPage(AcceptanceTester $I)
    {
        // Load the logged in state
        $I->loadSessionSnapshot('logged_in');
        // Load the page
        $I->amOnPage(Map::URL_DASHBOARD);
        $this->wait();

        $I->makeScreenshot('dashboard_' . time());

        $I->wantTo('See user details');
        $I->click(Map::LINK_USER);
        $this->wait();

        $I->waitForElementVisible(Map::AREA_USER, 2);

        $I->see('User Information', Map::AREA_USER);

        // Store the user url for the next step
        $this->userUrl = $I->grabFromCurrentUrl();

        // Compare visually
        $I->dontSeeVisualChanges('user', Map::AREA_USER, [Map::AREA_USERNAME, Map::AREA_DOB]);
        // $I->dontSeeVisualChanges('user', Map::AREA_USER, [Map::AREA_USERNAME], 5);
    }

    public function userPage(AcceptanceTester $I)
    {
        // Load the logged in state
        $I->loadSessionSnapshot('logged_in');
        // Load the page
        $I->amOnPage($this->userUrl);

        $I->makeScreenshot('user_' . time());

        $I->wantTo('Go back home');
        $I->click('Home');
        $I->seeInCurrentUrl(Map::URL_DASHBOARD);

        // Compare visually
        $I->dontSeeVisualChanges('dashboard', Map::AREA_DASHBOARD, ['tbody'], 5);

        $this->wait();
    }

    private function wait($time = 1)
    {
        if ($this->slow) {
            $this->tester->wait($time);
        }
    }
}
