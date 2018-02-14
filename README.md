# [User Acceptance Testing with Codeception](https://github.com/)

Demonstrate how to start working with codeception

## Agenda

1. Overview
2. Getting started
3. First Tests
4. Running Interactively
5. Investigating test results
6. Next steps

---

# Topics

Types of testing. What is UAT?

## Codeception

Allows to write user acceptance tests in something semi-readable and automates the reporting and result collection.

## VisualCeption

Build as an add-on to Codeception, it allows to compare screenshots for similarity. With its help, it's possible to detect changes to the layout, missing functionality and even browser inconsitencies.

## XDebug

Used to collect code coverage data, based on the executed UAT scripts.

---

# Installing / Getting started

To create a new test setup, use the following steps:

* Install codeception
```shell
composer require --dev codeception/codeception codeception/c3 codeception/visualception codeception/notifier
```
* Initialise codeception space
```shell
vendor/bin/codecept bootstrap
```
* Install selenium
```shell
wget -O tests/selenium.jar https://goo.gl/hvDPsK
```

---
* Edit tests/acceptance.suite.yml to set url of your application. Change PhpBrowser to WebDriver to enable browser testing. Set browser: chrome to enable chrome driver
* Create your first acceptance tests using
```shell
vendor/bin/codecept g:cest acceptance Main
```
* Write test in tests/acceptance/MainCest.php
* Run selenium
```shell
java -jar \
    tests/selenium.jar \
    -role node \
    -enablePassThrough false \
    -servlet org.openqa.grid.web.servlet.LifecycleServlet \
    -registerCycle 0 \
    -port 4444 > tests/_output/selenium.log 2>&1 &
```
* Run tests
```shell
vendor/bin/codecept run
```

---

# Configuration

## [codecept.yml](codecept.yml)

Codeception's main configuration file. It's used to manage what add-ons are enabled

## [tests/acceptance.suite.yml](tests/acceptance.suite.yml)

Manages acceptance testing specific settings:
- URL to test
- Browser and capabilities
- Environments, etc

---

# Hands On Demo

Show what you can test and how. Demonstrate a basic setup and some tips and best practice notes.

## Mappers

Configure css (preferred) identifiers in a separate mapper file

## Save session state
```PHP
$I->saveSessionSnapshot();
$I->loadSessionSnapshot();
```

---

## Run Interactively

It's very useful to be able to try selectors interactively. This can be achieved by running Codeception in interactive mode
```shell
codecept console acceptance
```

After that you can run commands and see their results in the opened browser, for example
```php
$I->amOnUrl('http://demo')
$I->fillField('#username', 'demo')
...
```

## Run through browser in docker
```shell
curl -sS "http://localhost:4444/extra/LifecycleServlet?action=shutdown"
docker run -d --rm -p 4444:4444 -v /dev/shm:/dev/shm --add-host="demo:172.17.0.1" --name selenium-chrome selenium/standalone-chrome
```

---

# Test Results

Test results will be shown on the console.
If you run codeception with the --html flag
- The results will also be available as an HTML report: `tests/_output/report.html`
- Screenshots of each step will be available as HTML: `tests/_output/records.html`

## Code Coverage

Run with --coverage-html flag and then investigate `tests/_output/coverage/index.html` file

---

# Next Steps

- Learn more about the capabilities of [WebDriver](https://codeception.com/docs/modules/WebDriver)
- Parallel runs (via robo-paracept)
- Extract common steps to helpers
- Split tests to groups
- Setup separate environments
- Setup database data population
- Write PHPUnit and Integration tests

---

# Questions?!

- GitHub repository: https://github.com/ipeevski/codeception-demo

- Email: ipeevski@gmail.com

- LinkedIn: https://linkedin.com/in/ipeevski

- Company: [Personify Care](https://www.personifycare.com/) - We are hiring!