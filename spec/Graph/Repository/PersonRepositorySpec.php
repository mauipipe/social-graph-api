<?php

namespace spec\Graph\Repository;

use Graph\Graph;
use Graph\Node\Node;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PersonRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Graph\Repository\PersonRepository');
    }

    function __let(Graph $graph){
        $this->beConstructedWith($graph);
    }

    function it_get_the_direct_friend_based_on_a_consumed_id(Graph $graph,Node $node, Node $node2){

        $meta = array('first_name'=>'Phil');
        $node2->getMeta()->shouldReturn($meta);

        $id = 1;
        $node->getConnections()->shouldBeCalled()->willReturn($node2);
        $graph->getNeighbours($id)->shouldBeCalled()->willReturn(array(2=>$node));
        $this->shouldBeConstructedWith($graph);

        $expectedResults = array(
            2=> $meta
        );

        $this->findFriends(1)->shouldBeEqualTo($expectedResults);

    }
}
