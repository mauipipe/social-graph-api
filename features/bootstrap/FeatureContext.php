<?php

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{

    private $data;
    private $personData = array();
    private $result;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^my data are stored in "([^"]*)"$/
     */
    public function myDataAreStoredIn($fileName)
    {
        $data = json_decode(file_get_contents(__DIR__ . '/../fixtures/' . $fileName));
        $this->data = $data;
    }

    /**
     * @Given /^my name is "([^"]*)" with id (\d+)$/
     */
    public function myNameIsWithId($name, $id)
    {
        $this->personData['id'] =(int) $id;
        $this->personData['name'] = $name;
    }

    /**
     * @When /^I want to find "([^"]*)" relation$/
     */
    public function iWantToFindRelation($relation)
    {
        $graph = new \Graph\Graph();
        $methodName = "find".str_replace(" ","",ucfirst($relation));
        $graphFactory = new \Graph\Factories\GraphFactory($graph,$this->data);
        $populatedGraph = $graphFactory->create();
        $personRepository = new \Graph\Repository\PersonRepository($populatedGraph);

        $this->result = $personRepository->$methodName($this->personData['id']);
    }

    /**
     * @Then /^I will have this result:$/
     */
    public function iWillHaveThisResult(PyStringNode $string)
    {

        if(json_encode($this->result) !== $string->getRaw()){
            throw new \Exception('Results are not the same');
        }
    }


}
