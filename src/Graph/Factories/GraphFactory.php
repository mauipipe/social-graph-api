<?php

namespace Graph\Factories;

use Graph\Graph;
use Graph\Interfaces\FactoryInterface;
use Graph\Interfaces\GraphInterface;
use Graph\Node\Node;

class GraphFactory implements FactoryInterface
{

    private $items;
    private $graph;

    /**
     * @param GraphInterface $graph
     * @param array $items
     */
    public function __construct(GraphInterface $graph, array $items)
    {
        $this->items = $items;
        $this->graph = $graph;
    }

    /**
     * @return GraphInterface
     */
    public function create()
    {

        foreach ($this->items as $item) {
            $id = $item->id;
            if (false === $this->graph->isNode($id)) {
                $currentNode = $this->createNode($id, $item);
                $this->graph->addNode($currentNode);
            }
        }

        foreach($this->items as $item){
            $id = $item->id;
            $friends  = $item->friends;
            $currentNode = $this->graph->getNode($id);

            foreach($friends as $friendId){
                $friendNode = $this->graph->getNode($friendId);
                $currentNode->connectToNode($friendId,$friendNode);
            }

            $this->graph->updateNode($id,$currentNode);
        }

        return $this->graph;
    }

    /**
     * @param $id
     * @param $item
     * @return Node
     */
    private function createNode($id, $item)
    {

        $node = new Node($id);
        $meta = (array) $item;
        unset($meta['friends']);

        $node->setMeta($meta);

        return $node;
    }

}
