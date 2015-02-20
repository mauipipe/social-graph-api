<?php
/**
 *Class GraphInterface
 *
 * @author David Contavalli <mauipipe@gmail.com>
 * @copyright Contavalli  - All Rights Reserved -
 *  You may execute and modify the contents of this file, but only within the scope of this project.
 *  Any other use shall be considered forbidden, unless otherwise specified.
 */

namespace Graph\Interfaces;

use Graph\Node\Node;

interface GraphInterface {

    public function addNode(Node $node);

    public function getNeighbours($hash);
}