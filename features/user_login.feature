Feature:
  In order to login to the application
  As a visitor
  I want to get a user token

  Scenario: A user send a login request with valid credentials
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    When I send a login request with data
      | username | john@doe.com |
      | password | s3cr3t       |
    Then the response status code should be 200
    And the response should contain a valid token

  Scenario: A user send a login request with wrong credentials
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    When I send a login request with data
      | username | john@doe.com   |
      | password | wrong_password |
    Then the response status code should be 401

  Scenario: A user send a login request with mandatory fields missing
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    When I send a login request with data
      | test | 42 |
    Then the response status code should be 500

