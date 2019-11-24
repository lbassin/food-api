Feature:
  In order to get the information about the calendar of a user
  As a user
  I want to get the preview of my calendar

  Scenario: A user ask for his calendar without begin logged in
    Given I am not logged in
    When I add "content-type" header equal to "application/json"
    And I send a GET request to "/api/profile/calendar"
    Then the response status code should be 401

  Scenario: A user ask for his calendar with valid token
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    And I am logged in with john@doe.com
    When I add "content-type" header equal to "application/json"
    And I send a GET request to "/api/profile/calendar"
    Then the response status code should be 200
    And the JSON node "days" should have 7 elements
    And the JSON node "days[0].position" should be equal to 0
    And the JSON node "days[6].position" should be equal to 6
    And the JSON node "days[0].meals" should have 2 elements
    And the JSON node "days[0].meals[0].portion" should exist
    And the JSON node "days[0].meals[0].recipe" should exist
    And the JSON node "days[0].meals[1].position" should be equal to 1
