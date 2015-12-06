Feature: Upload an animation

  Scenario: upload an animation
    Given I have entered a json filename "fred.json"
    When I press the uplaod button
    Then I should see the success page


