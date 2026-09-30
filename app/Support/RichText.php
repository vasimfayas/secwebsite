<?php

namespace App\Support;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

/**
 * Cleans rich text coming from the admin editor so only safe formatting
 * (paragraphs, headings, bold/italic/underline, lists, indents, alignment, links)
 * reaches the public site.
 */
class RichText
{
    private const BLOCKS = ['p', 'h2', 'h3', 'h4', 'blockquote', 'ul', 'ol', 'li'];

    private const INLINE = ['br', 'strong', 'b', 'em', 'i', 'u', 's', 'span', 'sub', 'sup'];

    private static ?HtmlSanitizer $sanitizer = null;

    public static function isHtml(?string $value): bool
    {
        return $value !== null && preg_match('/<\s*(p|br|ul|ol|li|strong|b|em|i|u|h[1-6]|span|div|blockquote)\b/i', $value) === 1;
    }

    /**
     * Safe HTML for display. Plain-text (legacy) values keep their line breaks.
     */
    public static function toHtml(?string $value): string
    {
        if ($value === null || trim($value) === '') {
            return '';
        }

        if (! static::isHtml($value)) {
            return nl2br(e($value), false);
        }

        return static::sanitize($value);
    }

    public static function sanitize(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        $clean = static::sanitizer()->sanitize($html);

        // Only keep harmless layout styles (alignment + indentation) on style attributes.
        return preg_replace_callback('/\sstyle="([^"]*)"/i', function ($m) {
            $kept = [];
            foreach (explode(';', html_entity_decode($m[1], ENT_QUOTES)) as $rule) {
                if (! str_contains($rule, ':')) {
                    continue;
                }
                [$prop, $val] = array_map('trim', explode(':', $rule, 2));
                $prop = strtolower($prop);

                if ($prop === 'text-align' && in_array(strtolower($val), ['left', 'right', 'center', 'justify'], true)) {
                    $kept[] = "text-align: {$val}";
                } elseif (in_array($prop, ['padding-left', 'margin-left'], true) && preg_match('/^\d{1,3}(\.\d+)?(px|em|rem)$/', $val)) {
                    $kept[] = "padding-left: {$val}";
                } elseif ($prop === 'list-style-type' && preg_match('/^(disc|circle|square|decimal|lower-alpha|upper-alpha|lower-roman|upper-roman)$/', $val)) {
                    $kept[] = "list-style-type: {$val}";
                }
            }

            return $kept ? ' style="' . e(implode('; ', $kept)) . '"' : '';
        }, $clean);
    }

    /**
     * Plain text for excerpts, cards and meta tags.
     */
    public static function toText(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        $text = preg_replace('/<\s*(br|\/p|\/li|\/h[1-6]|\/blockquote)\s*\/?>/i', "$0 ", $value);
        $text = html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5);

        return trim(preg_replace('/\s+/u', ' ', $text));
    }

    private static function sanitizer(): HtmlSanitizer
    {
        if (static::$sanitizer) {
            return static::$sanitizer;
        }

        $config = (new HtmlSanitizerConfig())
            ->allowLinkSchemes(['http', 'https', 'mailto', 'tel'])
            ->allowRelativeLinks()
            ->allowElement('a', ['href', 'title', 'target'])
            ->forceAttribute('a', 'rel', 'noopener noreferrer');

        foreach (array_merge(static::BLOCKS, static::INLINE) as $element) {
            $config = $config->allowElement($element, ['style']);
        }

        // Unknown wrappers (div, font, Word's o:p …) are unwrapped, keeping their text.
        foreach (['div', 'font', 'section', 'article', 'h1', 'h5', 'h6', 'table', 'tbody', 'thead', 'tr', 'td', 'th'] as $element) {
            $config = $config->blockElement($element);
        }
        foreach (['script', 'style', 'iframe', 'object', 'embed', 'form', 'input', 'button', 'textarea', 'select', 'svg', 'math'] as $element) {
            $config = $config->dropElement($element);
        }

        return static::$sanitizer = new HtmlSanitizer($config->withMaxInputLength(200000));
    }
}
