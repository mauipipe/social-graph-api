<?php

namespace Graph\Repository;

use Graph\Graph;

class PersonRepository
{

    private $graph;

    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }

    public function findFriends($id)
    {
        $results = [];
        foreach ($this->graph->getNeighbours($id) as $id => $neighbour) {
            $results[$id] = $neighbour->getMeta();
        }
        return $results;
    }

    public function findFriendOfFriend($id)
    {
        $results = [];
        foreach ($this->graph->getNeighbours($id) as $neighbour) {
            foreach ($neighbour->getConnections() as $key => $relation) {
                if ($key !== $id) {
                    $results[$key] = $relation->getMeta();
                }
            }
        }
        return $results;
    }

    public function findSuggestedFriends($id)
    {
        $results = [];
        $friends = $this->findFriends($id);

        if (sizeof($friends) < 2) {
            return $results;
        }

        $friendsIds = array_keys($friends);
        $friendsIds[] = $id;
        $whiteListIds = $this->getFriendsIdsWhitelist($friendsIds);

        foreach ($whiteListIds as $friendId) {
            $node = $this->graph->getNode($friendId);
            $relations = $node->getConnections();
            $relationsIds = array_keys($relations);
            $intersection = array_intersect($relationsIds, $friendsIds);
            if (sizeof($intersection) >= 2) {
                $results[$friendId] = $node->getMeta();
            }


        }

        return $results;
    }

    /**
     * @param $friendsIds
     * @return array
     */
    private function getFriendsIdsWhitelist(array $friendsIds)
    {
        $people = $this->graph->getNodes();
        $peopleIds = array_keys($people);
        $invertedFriendsIds = array_flip($friendsIds);
        $diff = [];
        foreach ($peopleIds as $peopleId) {
            if (isset($invertedFriendsIds[$peopleId]) === false) {
                $diff[] = $peopleId;
            }
        }
        return $diff;
    }
}
