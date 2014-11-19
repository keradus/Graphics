<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Color;
use Keradus\Graphics\Comparator;

// mniej = lepiej
class PixelMSE extends Comparator
{
    use PixelBasedTrait;

    protected function compareColorPixels(Color $_a, Color $_b)
    {
        return (
            pow($_a->getRed() - $_b->getRed(), 2)       +
            pow($_a->getGreen() - $_b->getGreen(), 2)   +
            pow($_a->getBlue() - $_b->getBlue(), 2)     +
            pow($_a->getAlpha() - $_b->getAlpha(), 2)
        ) / 4;
    }

    protected function compareGreyPixels(Color $_a, Color $_b)
    {
        return pow($_a->getGrey() - $_b->getGrey(), 2);
    }

    protected function computeResult($_diff)
    {
        $this->isIdentical = !$_diff;
        $this->ratio = $_diff / ($this->imageA->getWidth() * $this->imageA->getHeight());
    }
}
