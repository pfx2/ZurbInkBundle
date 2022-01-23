<?php

/*
 * This file is part of the zurb-ink-bundle package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\ZurbInkBundle\Util;

use Pinky;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class HtmlUtils
{
    private $cssToInlineStyles;

    public function __construct(CssToInlineStyles $cssToInlineStyles)
    {
        $this->cssToInlineStyles = $cssToInlineStyles;
    }

    /**
     * @param string $html
     * @param array|string $css
     * @return string
     */
    public function inlineCss(string $html, $css): string
    {
        if (is_array($css)) {
            $css = implode(PHP_EOL, $css);
        }

        return $this->cssToInlineStyles->convert($html, $css);
    }

    /**
     * @param string $content
     * @return string
     */
    public function parseInky(string $content): string
    {
        return Pinky\transformString($content)->saveHTML();
    }
}
