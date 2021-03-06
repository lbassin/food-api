Feature:
  In order to create a new account
  As a visitor
  I want to register to the application

  Scenario: An account is created when the right data are provided
    Given there is no user with email "john@doe.com"
    When I add "content-type" header equal to "application/json"
    And I send a POST request to "/api/users" with body:
    """
      {
        "username": "john@doe.com",
        "password": "s3cr3t"
      }
    """
    Then the response status code should be 201

  Scenario: An account with provided email already exists
    Given there is a user with email "john@doe.com" and password "s3cr3t!"
    When I add "content-type" header equal to "application/json"
    And I send a POST request to "/api/users" with body:
    """
      {
        "username": "john@doe.com",
        "password": "s3cr3t"
      }
    """
    Then the response status code should be 409

  Scenario: Create an account with a password too short
    When I add "content-type" header equal to "application/json"
    And I send a POST request to "/api/users" with body:
    """
      {
        "username": "john+test@doe.com",
        "password": "test"
      }
    """

  Scenario: Mandatory fields are not provided for user creation
    When I add "content-type" header equal to "application/json"
    And I send a POST request to "/api/users" with body:
    """
      {
        "test": 42
      }
    """
    Then the response status code should be 400

  Scenario: An account has his calendar initialized once he has been created
    Given there is no user with email "john@doe.com"
    When I add "content-type" header equal to "application/json"
    And I send a POST request to "/api/users" with body:
    """
      {
        "username": "john@doe.com",
        "password": "s3cr3t"
      }
    """
    Then the response status code should be 201
    And the user "john@doe.com" should have a calendar with 7 days
