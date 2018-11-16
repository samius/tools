<?php
declare(strict_types=1);

namespace Samius;

use Samius\Url;

use Doctrine\ORM\EntityManager;
use Samius\DateTime;

class UrlTest extends \Codeception\Test\Unit
{
    public function testAddQueryParamToUrl()
    {
        $this->assertEquals(
            'https://example.org/test?param=value',
            \Samius\Url::addQueryParamToUrl('https://example.org/test', 'param', 'value')
        );

        $this->assertEquals(
            'example.org/test?param=value',
            \Samius\Url::addQueryParamToUrl('example.org/test', 'param', 'value')
        );

        $this->assertEquals(
            'https://example.org/test?a=b&param=value',
            \Samius\Url::addQueryParamToUrl('https://example.org/test?a=b', 'param', 'value')
        );
        $this->assertEquals(
            'https://example.org/test?param=value',
            \Samius\Url::addQueryParamToUrl('https://example.org/test?param=valueToOverwrite', 'param', 'value')
        );
        $this->assertEquals(
            'https://user:pass@example.org/test:8080?a=b&param=value#anchor',
            \Samius\Url::addQueryParamToUrl('https://user:pass@example.org:8080/test?a=b&param=valueToOverwrite#anchor', 'param', 'value')
        );
    }

    public function testRemoveQueryParamFromUrl()
    {
        $this->assertEquals(
            'https://example.org/test',
            \Samius\Url::removeQueryParamFromUrl('https://example.org/test', 'param')
        );

        $this->assertEquals(
            'example.org/test',
            \Samius\Url::removeQueryParamFromUrl('example.org/test?param=value', 'param')
        );

        $this->assertEquals(
            'https://example.org/test?a=b',
            \Samius\Url::removeQueryParamFromUrl('https://example.org/test?a=b', 'param')
        );
        $this->assertEquals(
            'https://example.org/test',
            \Samius\Url::removeQueryParamFromUrl('https://example.org/test?param=value', 'param')
        );
        $this->assertEquals(
            'https://user:pass@example.org/test:8080?a=b#anchor',
            \Samius\Url::removeQueryParamFromUrl('https://user:pass@example.org:8080/test?a=b&param=value#anchor', 'param')
        );
    }
}