<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Block;
use Keradus\Graphics\Comparator;

// mniej = lepiej
class BlockIdentity extends Comparator
{
    use BlockBasedTrait;

    protected function compareColorBlock(Block $_a, Block $_b)
    {
        $colorA = $_a->getAverageColor();
        $colorB = $_b->getAverageColor();

        return $_a->getSize() * (
            (int) ($colorA->getRed() !== $colorB->getRed())      +
            (int) ($colorA->getGreen() !== $colorB->getGreen())  +
            (int) ($colorA->getBlue() !== $colorB->getBlue())    +
            (int) ($colorA->getAlpha() !== $colorB->getAlpha())
        ) / 4;
    }

    protected function compareGreyBlock(Block $_a, Block $_b)
    {
        $colorA = $_a->getAverageColor();
        $colorB = $_b->getAverageColor();

        return $_a->getSize() * (int) ($colorA->getGrey() !== $colorB->getGrey());
    }

    protected function computeResult($_diff)
    {
        $this->isIdentical = !$_diff;
        $this->ratio = $_diff / ($this->imageA->getWidth() * $this->imageA->getHeight());
    }
}
