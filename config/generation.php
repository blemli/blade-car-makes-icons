<?php

use Codeat3\BladeIconGeneration\IconProcessor;

$svgNormalization = static function (string $tempFilepath, array $iconSet) {

    // perform generic optimizations
    $iconProcessor = new IconProcessor($tempFilepath, $iconSet);
    $iconProcessor
        ->optimize(function (DOMElement $element) {
            // Remove all child style elements
            $styles = $element->getElementsByTagName('style');
            foreach ($styles as $style) {
                $style->parentNode->removeChild($style);
            }
        })
        ->postOptimizationAsString(function ($svgLine) {})
        ->save(filenameCallable: function ($filename) {
            return str_replace(' ', '-', $filename);
        });

};

return [
    [
        'source' => __DIR__.'/../node_modules/car-makes-icons/svgs',
        'destination' => __DIR__.'/../resources/svg',
        'is-solid' => true,
        'safe' => true,
        'after' => $svgNormalization,
    ],
];
