<?php

use \Ospinto\Dbug;
use \SensioLabs\AnsiConverter\AnsiToHtmlConverter;

abstract class AbstractAction
{
    protected $value;

    protected $container;

    protected $formatter;

    public function __construct( $value )
    {
        $this->value = $value;
        $this->setUp();
    }

    abstract public function decode();
    abstract public function setUp();

    public function setContainer( ContainerInterface $container )
    {
        $this->container = $container;
    }

    public function setFormatter( FormatterInterface $formatter )
    {
        $this->formatter = $formatter;
    }

    public function esc_raw()
    {
        return htmlentities( $this->value );
    }

    public function __toString()
    {
        $value = $this->decode();
        $formatted = $this->formatter->format( $value );
        return $this->container->wrap( $formatted );
    }
}

class ActionQuotedPrintableDecode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return quoted_printable_decode( $this->value );
    }
}

class ActionQuotedPrintableEncode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return quoted_printable_encode( $this->value );
    }
}

class ActionBase64Encode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return base64_encode( $this->value );
    }
}

class ActionBase64Decode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return base64_decode( $this->value );
    }
}

class ActionUrldecode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return urldecode( $this->value );
    }
}

class ActionUrlencode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return urlencode( $this->value );
    }
}

class ActionSerialize extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return serialize( json_decode( $this->value ) );
    }
}

class ActionUnserialize extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new DivContainer );
        $this->setFormatter( new DbugFormatter );
    }

    public function decode()
    {
        return unserialize( $this->value );
    }
}

class ActionJsonDecode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new DivContainer );
        $this->setFormatter( new VarexportFormatter );
    }

    public function decode()
    {
        return json_decode( $this->value, true );
    }
}

class ActionJsonEncode extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        return json_encode( $this->value );
    }
}

class ActionDateC extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new DivContainer );
        $this->setFormatter( new DbugFormatter );
    }

    public function decode()
    {
        $results = array();

        array_map(function($value) use (&$results) {
            $results[$value] = date('c', $value);
        }, explode("\n", $this->value));

        return $results;
    }
}

class ActionStrtotime extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new DivContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        $tz = date_default_timezone_get();
        date_default_timezone_set('UTC');

        $time = strtotime($this->value);
        $str_utc = date('c', $time);

        date_default_timezone_set('America/New_York');
        $str_ny = date('c', $time);

        date_default_timezone_set($tz);

        return "$time<br>$str_utc<br>$str_ny";
    }
}

class ActionAnsi2Html extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new TextareaContainer );
        $this->setFormatter( new EchoFormatter );
    }

    public function decode()
    {
        $converter = new AnsiToHtmlConverter();
        return htmlentities(nl2br($converter->convert($this->value)));
    }
}

class ActionParseStr extends AbstractAction
{
    public function setUp()
    {
        $this->setContainer( new DivContainer );
        $this->setFormatter( new DbugFormatter );
    }

    public function decode()
    {
        parse_str($this->value, $results);

        return $results;
    }
}

interface ContainerInterface
{
    public function wrap( $contents );
}

class DivContainer implements ContainerInterface
{
    public function wrap( $contents )
    {
        return '<div class="col">' . $contents . '</div>';
    }
}

class TextareaContainer extends DivContainer
{
    public function wrap( $contents )
    {
        return parent::wrap( '<textarea>' . $contents . '</textarea>' );
    }
}

interface FormatterInterface
{
    public function format( $value );
}

abstract class BufferedFormatter implements FormatterInterface {
    const ESCAPE = false;

    public function format( $value ) {
        ob_start();
        $this->bufferedFormat( $value );
        $output = ob_get_clean();

        if (static::ESCAPE) {
            $output = '<pre>' . htmlentities($output) . '</pre>';
        }

        return $output;
    }

    abstract public function bufferedFormat( $value );
}

class DbugFormatter extends BufferedFormatter
{
    public function bufferedFormat( $value )
    {
        new dBug( $value );
    }
}

class VardumpFormatter extends BufferedFormatter
{
    const ESCAPE = true;

    public function bufferedFormat( $value )
    {
        var_dump( $value );
    }
}

class EchoFormatter implements FormatterInterface
{
    public function format( $value )
    {
        return $value;
    }
}

class VarexportFormatter extends BufferedFormatter
{
    const ESCAPE = true;

    public function bufferedFormat( $value )
    {
        var_export( $value );
    }
}
