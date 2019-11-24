Feature:
  In order to get the information about the calendar of a user
  As a user
  I want to get the preview of my calendar

  Scenario: A user asks for his calendar without begin logged in
    Given I am not logged in
    When I add "content-type" header equal to "application/json"
    And I send a GET request to "/api/profile/calendar/days/0/meals/0"
    Then the response status code should be 401

  Scenario: A user asks for a specific meal of a specific day of his calendar
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    And I am logged in with john@doe.com
    When I add "content-type" header equal to "application/json"
    And I send a GET request to "/api/profile/calendar/days/0/meals/0"
    Then the response status code should be 200
    And the JSON node "root.position" should exist
    And the JSON node "root.portion" should exist
    And the JSON node "root.recipe" should exist

  Scenario: A user ask for a specific mela of a specific day with meal position outside of the expected index
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    And I am logged in with john@doe.com
    When I add "content-type" header equal to "application/json"
    And I send a GET request to "/api/profile/calendar/days/0/meals/9"
    Then the response status code should be 404

  Scenario: A user ask for a specific mela of a specific day with day position outside of the expected index
    Given there is a user with email "john@doe.com" and password "s3cr3t"
    And I am logged in with john@doe.com
    When I add "content-type" header equal to "application/json"
    And I send a GET request to "/api/profile/calendar/days/9/meals/1"
    Then the response status code should be 404
