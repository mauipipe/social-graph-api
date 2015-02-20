<?php

namespace spec\Graph;

use Graph\Node\Node;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GraphSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Graph\Graph');
        $this->shouldBeAnInstanceOf('Graph\Interfaces\GraphInterface');
    }

    function it_add_an_retrieve_a_node(Node $node)
    {

        $node->getHash()->shouldBeCalled()->willReturn(1);
        $this->addNode($node);

        $expectedData = array(1 => $node);
        $this->getNodes()->shouldReturn($expectedData);

    }

    function it_should_update_an_existing_node()
    {

        $hash = 1;
        $node = new Node($hash);
        $this->addNode($node);

        $expectedResult = array(1 => $node);
        $this->getNodes()->shouldBeEqualTo($expectedResult);

        $updatedNode = new Node($hash);
        $updatedNode->setMeta(array('test'));

        $this->updateNode($hash, $updatedNode);

        $expectedResult = array(1 => $updatedNode);
        $this->getNodes()->shouldBeEqualTo($expectedResult);

    }

    function it_retrieve_the_consumed_node_neighbour(Node $node)
    {

        $hash = 1;
        $connectedNode = new Node($hash);
        $expectedData = array($hash => $connectedNode);
        $node->getHash()->shouldBeCalled()->willReturn($hash);
        $node->getConnections()->shouldBeCalled()->willReturn($expectedData);
        $this->addNode($node);
        $this->getNeighbours($hash)->shouldBeEqualTo($expectedData);

    }

    function it_check_if_a_node_is_present_in_the_graph_using_is_identifier(){

        $hash = 1;
        $node = new Node($hash);
        $this->addNode($node);

        $this->shouldBeNode($hash);
    }
}
