<?php
/**
 *Class ${NAME}
 *
 * @author David Contavalli <mauipipe@gmail.com>
 * @copyright Contavalli  - All Rights Reserved -
 *  You may execute and modify the contents of this file, but only within the scope of this project.
 *  Any other use shall be considered forbidden, unless otherwise specified.
 */
$loader = require __DIR__ . '/../vendor/autoload.php';


if(sizeof($argv) < 1){
    throw new Exception('argument missing assure that you put first the type of relation then the id');
}

list($command,$relation,$id) = $argv;

switch($relation){
    case "friends":
        $methodName = "findFriends";
        break;
    case "friend-of-friend":
        $methodName = "findFriendOfFriend";
        break;
    case "suggested-friend":
        $methodName = "findSuggestedFriends";
        break;
    default:
        throw new Exception(sprintf("Invalid relation %s choose between friends, friend-of-friend or suggested-friend",$relation));
        break;
}

$data = json_decode(file_get_contents(__DIR__ . '/../data/data.json'));
$graph = new \Graph\Graph();
$graphFactory = new \Graph\Factories\GraphFactory($graph,$data);
$populatedGraph = $graphFactory->create();
$personRepository = new \Graph\Repository\PersonRepository($populatedGraph);

$people = $personRepository->$methodName($id);

$output = "";
foreach($people as $person){
    unset($person['id']);
    $output .= "-" . implode(" ",$person)."\n";

}

echo $output;

