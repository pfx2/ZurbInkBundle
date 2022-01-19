<?php

/*
 * This file is part of the zurb-ink-bundle package.
 *
 * (c) Marco Polichetti <gremo1982@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gremo\ZurbInkBundle\Twig\Parser;

use Gremo\ZurbInkBundle\Twig\Node\InkyNode;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;
use Twig_Token;

class InkyTokenParser extends AbstractTokenParser
{
    /**
     * {@inheritdoc}
     */
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], true);
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);

        return new InkyNode($body, $lineno, $this->getTag());
    }

    /**
     * @param Twig_Token $token
     * @return bool
     */
    public function decideBlockEnd(Token $token)
    {
        return $token->test('endinky');
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return 'inky';
    }
}
