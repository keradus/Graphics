<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Block;
use Keradus\Graphics\Comparator;

// mniej = lepiej
class BlockSimilarity extends Comparator
{
    use BlockBasedTrait;

    protected function compareColorBlock(Block $_a, Block $_b)
    {
        $colorA = $_a->getAverageColor();
        $colorB = $_b->getAverageColor();

        return $_a->getSize() * (
            abs($colorA->getRed() - $colorB->getRed())      +
            abs($colorA->getGreen() - $colorB->getGreen())  +
            abs($colorA->getBlue() - $colorB->getBlue())    +
            abs($colorA->getAlpha() - $colorB->getAlpha())
        ) / 4;
    }

    protected function compareGreyBlock(Block $_a, Block $_b)
    {
        $colorA = $_a->getAverageColor();
        $colorB = $_b->getAverageColor();

        return $_a->getSize() * abs($colorA->getGrey() - $colorB->getGrey());
    }

    protected function computeResult($_diff)
    {
        $this->isIdentical = !$_diff;
        $this->ratio = $_diff / ($this->imageA->getWidth() * $this->imageA->getHeight() * 255);
    }
}
