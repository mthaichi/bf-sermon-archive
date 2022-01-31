<?php

namespace VKBase;

class BlockManager extends BaseObject {

    private $blocks;

    public function __construct() {
    }

    public function add_block( Block $block ) {
        $this->blocks[] = $block;
    }

}