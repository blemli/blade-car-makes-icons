<?php

declare(strict_types=1);

namespace Tests;

use BladeUI\Icons\BladeIconsServiceProvider;
use JohanBoshoff\CarMakesIcons\BladeCarMakesIconsServiceProvider;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CompilesIconsTest extends TestCase
{
    #[Test]
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('carmakes-mitsubishi')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 80.4 80.4" xml:space="preserve" fill="currentColor"><g><polygon points="39.7,7.2 27,27.6 52.5,72.1 79.3,72 65.7,50 14.3,50 1.1,72.3 26.1,72.3 52.9,27.2 "/></g></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    #[Test]
    public function it_can_add_classes_to_icons()
    {
        $result = svg('carmakes-mitsubishi', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 80.4 80.4" xml:space="preserve" fill="currentColor"><g><polygon points="39.7,7.2 27,27.6 52.5,72.1 79.3,72 65.7,50 14.3,50 1.1,72.3 26.1,72.3 52.9,27.2 "/></g></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    #[Test]
    public function it_can_add_styles_to_icons()
    {
        $result = svg('carmakes-mitsubishi', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 80.4 80.4" xml:space="preserve" fill="currentColor"><g><polygon points="39.7,7.2 27,27.6 52.5,72.1 79.3,72 65.7,50 14.3,50 1.1,72.3 26.1,72.3 52.9,27.2 "/></g></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeCarMakesIconsServiceProvider::class,
        ];
    }
}
