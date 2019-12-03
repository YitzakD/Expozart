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
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class CliDumperTest extends TestCase
{
    use VarDumperTestTrait;

    public function testGet()
    {
        require __DIR__.'/../Fixtures/dumb-var.php';

        $dumper = new CliDumper('php://output');
        $dumper->setColors(false);
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
        $intMax = PHP_INT_MAX;
        $res = (int) $var['res'];

        $this->assertStringMatchesFormat(
            <<<EOTXT
array:24 [
  "number" => 1
  0 => &1 null
  "const" => 1.1
  1 => true
  2 => false
  3 => NAN
  4 => INF
  5 => -INF
  6 => {$intMax}
  "str" => "déjà\\n"
  7 => b"""
    é\\x00test\\t\\n
    ing
    """
  "[]" => []
  "res" => stream resource {@{$res}
%A  wrapper_type: "plainfile"
    stream_type: "STDIO"
    mode: "r"
    unread_bytes: 0
    seekable: true
%A  options: []
  }
  "obj" => Symfony\Component\VarDumper\Tests\Fixture\DumbFoo {#%d
    +foo: "foo"
    +"bar": "bar"
  }
  "closure" => Closure(\$a, PDO &\$b = null) {#%d
    class: "Symfony\Component\VarDumper\Tests\Dumper\CliDumperTest"
    this: Symfony\Component\VarDumper\Tests\Dumper\CliDumperTest {#%d …}
    file: "%s%eTests%eFixtures%edumb-var.php"
    line: "{$var['line']} to {$var['line']}"
  }
  "line" => {$var['line']}
  "nobj" => array:1 [
    0 => &3 {#%d}
  ]
  "recurs" => &4 array:1 [
    0 => &4 array:1 [&4]
  ]
  8 => &1 null
  "sobj" => Symfony\Component\VarDumper\Tests\Fixture\DumbFoo {#%d}
  "snobj" => &3 {#%d}
  "snobj2" => {#%d}
  "file" => "{$var['file']}"
  b"bin-key-é" => ""
]

EOTXT
            ,
            $out
        );
    }

    /**
     * @dataProvider provideDumpWithCommaFlagTests
     */
    public function testDumpWithCommaFlag($expected, $flags)
    {
        $dumper = new CliDumper(null, null, $flags);
        $dumper->setColors(false);
        $cloner = new VarCloner();

        $var = [
            'array' => ['a', 'b'],
            'string' => 'hello',
            'multiline string' => "this\nis\na\multiline\nstring",
        ];

        $dump = $dumper->dump($cloner->cloneVar($var), true);

        $this->assertSame($expected, $dump);
    }

    public function testDumpWithCommaFlagsAndExceptionCodeExcerpt()
    {
        $dumper = new CliDumper(null, null, CliDumper::DUMP_TRAILING_COMMA);
        $dumper->setColors(false);
        $cloner = new VarCloner();

        $ex = new \RuntimeException('foo');

        $dump = $dumper->dump($cloner->cloneVar($ex)->withRefHandles(false), true);

        $this->assertStringMatchesFormat(<<<'EOTXT'
RuntimeException {
  #message: "foo"
  #code: 0
  #file: "%ACliDumperTest.php"
  #line: %d
  trace: {
    %ACliDumperTest.php:%d {
      › 
      › $ex = new \RuntimeException('foo');
      › 
    }
    %A
  }
}

EOTXT
            , $dump);
    }

    public function provideDumpWithCommaFlagTests()
    {
        $expected = <<<'EOTXT'
array:3 [
  "array" => array:2 [
    0 => "a",
    1 => "b"
  ],
  "string" => "hello",
  "multiline string" => """
    this\n
    is\n
    a\multiline\n
    string
    """
]

EOTXT;

        yield [$expected, CliDumper::DUMP_COMMA_SEPARATOR];

        $expected = <<<'EOTXT'
array:3 [
  "array" => array:2 [
    0 => "