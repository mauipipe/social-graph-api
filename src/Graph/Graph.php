<?php

namespace Graph;

use Graph\Interfaces\GraphInterface;
use Graph\Node\Node;

class Graph implements GraphInterface
{

    private $nodes = array();



    public function addNode(Node $node)
    {
        $hash = $node->getHash();
        $this->nodes[$hash] = $node;
    }

    public function getNodes()
    {
        return $this->nodes;
    }

    public function updateNode($hash, Node $node)
    {
        $this->nodes[$hash] = $node;
    }

    

    public function getNeighbours($hash)
    {
        return $this->nodes[$hash]->getConnections();

    }

    public function isNode($hash)
    {
        return array_key_exists($hash,$this->nodes);
    }
}
