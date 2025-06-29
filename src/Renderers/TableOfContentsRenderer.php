<?php

namespace Fuelviews\SabHeroArticle\Renderers;

use InvalidArgumentException;
use League\CommonMark\Extension\TableOfContents\Node\TableOfContents;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class TableOfContentsRenderer implements NodeRendererInterface
{
    public function render($node, ChildNodeRendererInterface $childRenderer): string
    {
        if (! ($node instanceof TableOfContents)) {
            throw new InvalidArgumentException('Incompatible node type: '.get_class($node));
        }

        $title = new HtmlElement(
            'div',
            ['class' => 'flex w-full text-xl font-semibold mb-4'],
            'Table of Contents'
        );

        // Render TOC content and modify <a> tags
        $tocHtml = $childRenderer->renderNodes($node->children());

        // Modify all <a> tags by injecting a custom class
        $tocHtml = preg_replace('/<a /', '<a class="underline underline-offset-[0.35rem] hover:opacity-75 hover:underline transition-colors" ', $tocHtml);

        $toc = new HtmlElement(
            'ol',
            ['class' => 'pl-6 list-decimal columns-1 md:columns-2 gap-6 not-prose'],
            $tocHtml
        );

        $tocContainer = new HtmlElement(
            'div',
            ['class' => 'rounded-2xl bg-gray-100 p-4 mb-12 toc'],
            [$title, $toc]
        );

        return (string) $tocContainer;
    }
}
