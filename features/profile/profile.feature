Feature:
  In order to get user information
  As a user
  I want to get the details of my account

  Scenario: A user ask for his profile information with valid credentials
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    And I am logged in with john@doe.com
    When I send a request to get my profile
    Then the response status code should be 200

  Scenario: A user ask for his profile information without begin logged in
    Given I am not logged in
    When I send a request to get my profile
    Then the response status code should be 401
