<?php
/**
 * @package
 * 
 * @desc 使用Markdown Parser in PHP
 */
namespace App\Markdown;


class Markdown
{
    protected $parser;

    /**
     * Markdown constructor.
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $text
     * @return string
     */
    public function markdown($text)
    {
        //$html = $this->parser->parse($text);
        $html = $this->parser->makeHtml($text);
        return $html;
    }
}