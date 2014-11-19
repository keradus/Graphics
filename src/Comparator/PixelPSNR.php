<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Color;
use Keradus\Graphics\Comparator;

// mniej = lepiej,
// czyste PSNR to wiecej = lepiej (a max to 0), ale ustawiamy tu INVERT_SIMILARITY_RATIO
class PixelPSNR extends Comparator
{
    use PixelBasedTrait;

    const INVERT_SIMILARITY_RATIO = true;

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
        if (!$_diff) {
            $this->isIdentical = true;

            return;
        }

        $this->ratio = 10 * log10(pow(255, 2) * $this->imageA->getWidth() * $this->imageA->getHeight() / $_diff);
    }
}
