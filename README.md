[ User Acceptance Testing with Codeception](https://github.com/)
===
> Demonstrate how to start working with codeceptioni

Installing / Getting started
===

To create a new test setup, use the following steps:

* Install codeception
```shell
#!bash
composer require --dev codeception/codeception
composer require --dev codeception/c3
composer require --dev codeception/visualception
```
* Install selenium
```shell
#!bash
wget https://goo.gl/hvDPsK -o tests/selenium.jar
```

* Initialise codeception space
```shell
#!bash
vendor/bin/codecept bootstrap
```
* Edit tests/acceptance.suite.yml to set url of your application. Change PhpBrowser to WebDriver to enable browser testing
* Create your first acceptance tests using vendor/bin/codecept g:cest acceptance Login
* Write test in tests/acceptance/LoginCest.php
* Run selenium
```shell
#!bash
java -jar \
    tests/selenium.jar \
    -role node \
    -enablePassThrough false \
    -servlet org.openqa.grid.web.servlet.LifecycleServlet \
    -registerCycle 0 \
    -port 4444 > tests/_output/selenium.log 2>&1 &
```
* Run tests using: vendor/bin/codecept run

Developing
===

Build With
---
PHP Framework: Codecept

PHP Libraries: VisualCept, PHPUnit

Prerequisites
---
All prerequisites managed by composer.
```shell
composer install
```

Configuration
---
Configuration is managed through configuration files in [tests/acceptance.suite.yml](/tests/acceptance.suite.yml)

Run Interactively
---
It's very useful to be able to try selectors interactively. This can be achieved by running Codeception in interactive mode
```shell
codecept console acceptance
```

After that you can run commands and see their results in the opened browser, for example
$I->amOnUrl('http://demo')
$I->fillField('#username', 'demo')

Test Results
---
Test results will be shown on the console.
If you run codeception with the --html flag, they'll also be available as an HTML report: `tests/_output/report.html`

Code Coverage
---
Run with --coverage-html flag and then investigate `tests/_output/coverage/index.html` file

Next Steps
===
- Learn more about the capabilities of [WebDriver](https://codeception.com/docs/modules/WebDriver)
- Parallel runs (via robo-paracept)
- Split tests to groups
- Setup separate environments
- Setup database data population

Licensing
===
FreeBSD License
