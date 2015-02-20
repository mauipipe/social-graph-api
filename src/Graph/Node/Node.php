<?php

namespace Graph\Node;

class Node
{

    private $hash;
    private $relations = array();
    private $meta;


    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    public function getHash(){
        return $this->hash;
    }

    public function getMeta(){
        return $this->meta;
    }

    public function setMeta(array $meta){
        $this->meta = $meta;
    }

    public function connectToNode($id,Node $node)
    {
        $this->relations[$id] = $node;
    }

    public function getConnections()
    {
        return $this->relations;
    }
}
