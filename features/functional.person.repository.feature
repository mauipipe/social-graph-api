Feature:
  In order to check friends relations
  As an API user
  I should check relations direct friend / friend of friends / suggested friends

  Scenario: direct friend relation
    Given my data are stored in "test_data.json"
    And my name is "David" with id 1
    When I want to find "friends" relation
    Then I will have this result:
    """
   {"2":{"id":2,"firstName":"Paul","surname":"Crowe","age":28,"gender":"male"}}
    """

  Scenario: direct friend of friends relation
    Given my data are stored in "test_data.json"
    And my name is "David" with id 1
    When I want to find "friendOfFriend" relation
    Then I will have this result:
    """
    {"3":{"id":3,"firstName":"Annie","surname":"Crowe","age":28,"gender":"male"},"4":{"id":4,"firstName":"Sybil","surname":"Crowe","age":28,"gender":"male"}}
    """

    @wip
  Scenario: suggested friends
    Given my data are stored in "test_data.json"
    And my name is "Paul" with id 2
    When I want to find "suggestedFriends" relation
    Then I will have this result:
    """
   {"5":{"id":5,"firstName":"Mark","surname":"Crowe","age":28,"gender":"male"},"6":{"id":6,"firstName":"Jesus","surname":"Crowe","age":28,"gender":"male"}}
    """