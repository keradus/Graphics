<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Color;
use Keradus\Graphics\Comparator;

// ratio = null
class PixelClassic extends Comparator
{
    use PixelBasedTrait;

    protected function compareColorPixels(Color $_a, Color $_b)
    {
        // jesli napotkalismy na rozne pixele - konczymy porownywanie obrazow
        $this->wasCompared = (
            $_a->getRed() !== $_b->getRed()     ||
            $_a->getGreen() !== $_b->getGreen() ||
            $_a->getBlue() !== $_b->getBlue()   ||
            $_a->getAlpha() !== $_b->getAlpha()
        );
    }

    protected function compareGreyPixels(Color $_a, Color $_b)
    {
        // jesli napotkalismy na rozne pixele - konczymy porownywanie obrazow
        $this->wasCompared = ($_a->getGrey() !== $_b->getGrey());
    }

    protected function computeResult($_diff)
    {
        // obrazy sa identyczne jesli nie nastapilo przerwanie porownywania
        $this->isIdentical = !$this->wasCompared;

        // w tym algorytmie nie wyznaczamy wspolczynnika podobienstwa
        unset($_diff);
    }
}
