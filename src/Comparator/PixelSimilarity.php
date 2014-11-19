<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Color;
use Keradus\Graphics\Comparator;

// mniej = lepiej
class PixelSimilarity extends Comparator
{
    use PixelBasedTrait;

    protected function compareColorPixels(Color $_a, Color $_b)
    {
        return (
            abs($_a->getRed() - $_b->getRed())      +
            abs($_a->getGreen() - $_b->getGreen())  +
            abs($_a->getBlue() - $_b->getBlue())    +
            abs($_a->getAlpha() - $_b->getAlpha())
        ) / 4;
    }

    protected function compareGreyPixels(Color $_a, Color $_b)
    {
        return abs($_a->getGrey() - $_b->getGrey());
    }

    protected function computeResult($_diff)
    {
        $this->isIdentical = !$_diff;
        $this->ratio = $_diff / ($this->imageA->getWidth() * $this->imageA->getHeight() * 255);
    }
}
