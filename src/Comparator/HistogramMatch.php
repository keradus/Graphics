<?php

namespace Keradus\Graphics\Comparator;

use Keradus\Graphics\Color;
use Keradus\Graphics\Comparator;

// mniej = lepiej
class HistogramMatch extends Comparator
{
    public $bucketQuantity = 16;

    public function compare()
    {
        $imgs = [
            "A" => $this->imageA,
            "B" => $this->imageB,
        ];
        $width = $this->imageA->getWidth();
        $height = $this->imageA->getHeight();
        $buckets = [
            "A" => [],
            "B" => [],
        ];
        $bucketsKeys = array_keys($buckets);

        for ($x = 0; $x < $width; ++$x) {
            for ($y = 0; $y < $height; ++$y) {
                foreach ($bucketsKeys as $id) {
                    $channelBuckets = $this->computeBucket($imgs[$id]->getColor($x, $y));

                    foreach ($channelBuckets as $channel => $bucket) {
                        if (!isset($buckets[$id][$channel])) {
                            $buckets[$id][$channel] = [];
                        }

                        if (!isset($buckets[$id][$channel][$bucket])) {
                            $buckets[$id][$channel][$bucket] = 0;
                        }

                        ++$buckets[$id][$channel][$bucket];
                    }
                }
            }
        }

        $diff = 0;
        $channels = count($buckets["A"]);

        foreach (array_keys($buckets["A"]) as $bucketChannel) {
            for ($i = 0; $i < $this->bucketQuantity; ++$i) {
                $valueA = isset($buckets["A"][$channel][$i]) ? $buckets["A"][$channel][$i] : 0;
                $valueB = isset($buckets["B"][$channel][$i]) ? $buckets["B"][$channel][$i] : 0;
                $diff += abs($valueA - $valueB);
            }
        }

        $this->computeResult($diff / $channels);
    }

    protected function computeBucket(Color $_color)
    {
        if ($this->useGreyscale) {
            return [
                "grey" => (int) ($_color->getGrey() / $this->bucketQuantity),
            ];
        }

        return [
            "red" => (int) ($_color->getRed() / $this->bucketQuantity),
            "green" => (int) ($_color->getGreen() / $this->bucketQuantity),
            "blue" => (int) ($_color->getBlue() / $this->bucketQuantity),
        ];
    }

    protected function computeResult($_diff)
    {
        $this->isIdentical = 0 === $_diff;
        $this->ratio = $_diff / ($this->imageA->getWidth() * $this->imageA->getHeight());
    }
}
