<?php

namespace spec\Graph\Node;

use Graph\Node\Node;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NodeSpec extends ObjectBehavior
{

    public function let(){
        $this->beConstructedWith(1);
    }

    function it_connect_to_another_node(){

        $node2 = new Node(1);
        $this->connectToNode(1,$node2);

        $expectedData = array(
            1=>$node2
        );

        $this->getConnections()->shouldBeEqualTo($expectedData);

    }

}
