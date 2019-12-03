<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\VarDumper\Tests\Dumper;

use PHPUnit\Framework\TestCase;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class HtmlDumperTest extends TestCase
{
    public function testGet()
    {
        if (ini_get('xdebug.file_link_format') || get_cfg_var('xdebug.file_link_format')) {
            $this->markTestSkipped('A custom file_link_format is defined.');
        }

        require __DIR__.'/../Fixtures/dumb-var.php';

        $dumper = new HtmlDumper('php://output');
        $dumper->setDumpHeader('<foo></foo>');
        $dumper->setDumpBoundaries('<bar>', '</bar>');
        $cloner = new VarCloner();
        $cloner->addCasters([
            ':stream' => function ($res, $a) {
                unset($a['uri'], $a['wrapper_data']);

                return $a;
            },
        ]);
        $data = $cloner->cloneVar($var);

        ob_start();
        $dumper->dump($data);
        $out = ob_get_clean();
        $out = preg_replace('/[ \t]+$/m', '', $out);
        $var['file'] = htmlspecialchars($var['file'], ENT_QUOTES, 'UTF-8');
        $intMax = PHP_INT_MAX;
        preg_match('/sf-dump-\d+/', $out, $dumpId);
        $dumpId = $dumpId[0];
        $res = (int) $var['res'];

        $this->assertStringMatchesFormat(
            <<<EOTXT
<foo></foo><bar><span class=sf-dump-note>array:24</span> [<samp>
  "<span class=sf-dump-key>number</span>" => <span class=sf-dump-num>1</span>
  <span class=sf-dump-key>0</span> => <a class=sf-dump-ref href=#{$dumpId}-ref01 title="2 occurrences">&amp;1</a> <span class=sf-dump-const>null</span>
  "<span class=sf-dump-key>const</span>" => <span class=sf-dump-num>1.1</span>
  <span class=sf-dump-key>1</span> => <span class=sf-dump-const>true</span>
  <span class=sf-dump-key>2</span> => <span class=sf-dump-const>false</span>
  <span class=sf-dump-key>3</span> => <span class=sf-dump-num>NAN</span>
  <span class=sf-dump-key>4</span> => <span class=sf-dump-num>INF</span>
  <span class=sf-dump-key>5</span> => <span class=sf-dump-num>-INF</span>
  <span class=sf-dump-key>6</span> => <span class=sf-dump-num>{$intMax}</span>
  "<span class=sf-dump-key>str</span>" => "<span class=sf-dump-str title="5 characters">d&%s;j&%s;<span class="sf-dump-default sf-dump-ns">\\n</span></span>"
  <span class=sf-dump-key>7</span> => b"""
    <span class=sf-dump-str title="11 binary or non-UTF-8 characters">&eacute;<span class="sf-dump-default">\\x00</span>test<span class="sf-dump-default">\\t</span><span class="sf-dump-default sf-dump-ns">\\n</span></span>
    <span class=sf-dump-str title="11 binary or non-UTF-8 characters">ing</span>
    """
  "<span class=sf-dump-key>[]</span>" => []
  "<span class=sf-dump-key>res</span>" => <span class=sf-dump-note>stream resource</span> <a class=sf-dump-ref>@{$res}</a><samp>
%A  <span class=sf-dump-meta>wrapper_type</span>: "<span class=sf-dump-str title="9 characters">plainfile</span>"
    <span class=sf-dump-meta>stream_type</span>: "<span class=sf-dump-str title="5 characters">STDIO</span>"
    <span class=sf-dump-meta>mode</span>: "<span class=sf-dump-str>r</span>"
    <span class=sf-dump-meta>unread_bytes</span>: <span class=sf-dump-num>0</span>
    <span class=sf-dump-meta>seekable</span>: <span class=sf-dump-const>true</span>
%A  <span class=sf-dump-meta>options</span>: []
  </samp>}
  "<span class=sf-dump-key>obj</span>" => <abbr title="Symfony\Component\VarDumper\Tests\Fixture\DumbFoo" class=sf-dump-note>DumbFoo</abbr> {<a class=sf-dump-ref href=#{$dumpId}-ref2%d title="2 occurrences">#%d</a><samp id={$dumpId}-ref2%d>
    +<span class=sf-dump-public title="Public property">foo</span>: "<span class=sf-dump-str title="3 characters">foo</span>"
    +"<span class=sf-dump-public title="Runtime added dynamic property