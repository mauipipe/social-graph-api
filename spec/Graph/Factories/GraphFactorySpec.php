<?php

namespace spec\Graph\Factories;

use Graph\Graph;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GraphFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Graph\Factories\GraphFactory');
        $this->beAnInstanceOf('Graph\Interfaces\FactoryInterface');
    }

    function let(Graph $graph)
    {
        $item = (Object)array('test');
        $dataObj =  array($item);
        $this->beConstructedWith($graph, $dataObj);

    }




}
