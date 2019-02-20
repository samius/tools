<?php
declare(strict_types=1);

namespace Samius;


class Url
{
    /**
     * Adds query param to URL.
     * If url already contains query params, just add it. Otherwise create querystring and append it to URL.
     * If query param is already set, overwrites it with new value
     * Does not need http_build_query function installed
     * @param string $url
     * @param $param
     * @param $value
     * @return string
     */
    public static function addQueryParamToUrl(string $url, string $param, string $value): string
    {
        $urlParts = parse_url($url);

        $query = [];
        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $query);
        }

        $query[$param] = $value;
        $urlParts['query'] = http_build_query($query);

        return self::buildUrlFromParts($urlParts);
    }

    /**
     * @param string $url
     * @param string $param
     * @return string
     */
    public static function removeQueryParamFromUrl(string $url, string $param): string
    {
        $urlParts = parse_url($url);
        $query = [];
        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $query);
        }
        if (isset($query[$param])) {
            unset($query[$param]);
        }
        $urlParts['query'] = http_build_query($query);

        return self::buildUrlFromParts($urlParts);
    }


    /**
     * @param array $urlParts
     * @return string
     */
    private static function buildUrlFromParts(array $urlParts): string
    {
        $ret = '';
        if (isset($urlParts['scheme'])) {
            $ret .= $urlParts['scheme'] . '://';
        }

        if (isset($urlParts['user']) && $urlParts['user'] && isset($urlParts['pass']) && $urlParts['pass']) {
            $ret .= $urlParts['user'] . ':' . $urlParts['pass'] . '@';
        }
        $ret .= $urlParts['host'] ?? '';
        $ret .= $urlParts['path'] ?? '';

        if (isset($urlParts['port']) && $urlParts['port']) {
            $ret .= ':' . $urlParts['port'];
        }

        if (isset($urlParts['query']) && $urlParts['query']) {
            $ret .= '?' . $urlParts['query'];
        }

        if (isset($urlParts['fragment']) && $urlParts['fragment']) {
            $ret .= '#' . $urlParts['fragment'];
        }
        return $ret;

    }
}
