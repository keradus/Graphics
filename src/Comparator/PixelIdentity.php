<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Color;
use Keradus\Graphics\Comparator;

// mniej = lepiej
class PixelIdentity extends Comparator
{
    use PixelBasedTrait;

    protected function compareColorPixels(Color $_a, Color $_b)
    {
        return (
            (int) ($_a->getRed() !== $_b->getRed())      +
            (int) ($_a->getGreen() !== $_b->getGreen())  +
            (int) ($_a->getBlue() !== $_b->getBlue())    +
            (int) ($_a->getAlpha() !== $_b->getAlpha())
        ) / 4;
    }

    protected function compareGreyPixels(Color $_a, Color $_b)
    {
        return (int) ($_a->getGrey() !== $_b->getGrey());
    }

    protected function computeResult($_diff)
    {
        $this->isIdentical = !$_diff;
        $this->ratio = $_diff / ($this->imageA->getWidth() * $this->imageA->getHeight());
    }
}
