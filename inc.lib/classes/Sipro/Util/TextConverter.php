<?php
namespace Sipro\Util;

class TextConverter
{
    const ENCODING_TO = 'UTF-8';
    const ENCODING_FROM = 'ISO-8859-2';

    private $mapChrChr = [
        0x8A => 0xA9,
        0x8C => 0xA6,
        0x8D => 0xAB,
        0x8E => 0xAE,
        0x8F => 0xAC,
        0x9C => 0xB6,
        0x9D => 0xBB,
        0xA1 => 0xB7,
        0xA5 => 0xA1,
        0xBC => 0xA5,
        0x9F => 0xBC,
        0xB9 => 0xB1,
        0x9A => 0xB9,
        0xBE => 0xB5,
        0x9E => 0xBE
    ];

    private $mapChrString = [
        0x80 => '&euro;',
        0x82 => '&sbquo;',
        0x84 => '&bdquo;',
        0x85 => '&hellip;',
        0x86 => '&dagger;',
        0x87 => '&Dagger;',
        0x89 => '&permil;',
        0x8B => '&lsaquo;',
        0x91 => '&lsquo;',
        0x92 => '&rsquo;',
        0x93 => '&ldquo;',
        0x94 => '&rdquo;',
        0x95 => '&bull;',
        0x96 => '&ndash;',
        0x97 => '&mdash;',
        0x99 => '&trade;',
        0x9B => '&rsquo;',
        0xA6 => '&brvbar;',
        0xA9 => '&copy;',
        0xAB => '&laquo;',
        0xAE => '&reg;',
        0xB1 => '&plusmn;',
        0xB5 => '&micro;',
        0xB6 => '&para;',
        0xB7 => '&middot;',
        0xBB => '&raquo;'
    ];

    /**
     * @param $text
     * @return string
     */
    public function execute($text)
    {
        $map = $this->prepareMap();

        return html_entity_decode(
            mb_convert_encoding(strtr($text, $map), self::ENCODING_TO, self::ENCODING_FROM),
            ENT_QUOTES,
            self::ENCODING_TO
        );
    }

    /**
     * @return array
     */
    private function prepareMap()
    {
        $maps[] = $this->arrayMapAssoc(function ($k, $v) {
            return [chr($k), chr($v)];
        }, $this->mapChrChr);

        $maps[] = $this->arrayMapAssoc(function ($k, $v) {
            return [chr($k), $v];
        }, $this->mapChrString);

        return array_merge([], ...$maps);
    }

    /**
     * @param callable $function
     * @param array $array
     * @return array
     */
    private function arrayMapAssoc($function, $array)
    {
        return array_column(
            array_map(
                $function,
                array_keys($array),
                $array
            ),
            1,
            0
        );
    }
}