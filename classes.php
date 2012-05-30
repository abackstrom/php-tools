<?php

abstract class AbstractAction
{
	protected $value;

	protected $container;

	protected $formatter;

	public function __construct( $value )
	{
		$this->value = $value;
	}

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

	abstract public function decode();

	public function __toString()
	{
		$value = $this->decode();
		$formatted = $this->formatter->format( $value );
		return $this->container->wrap( $formatted );
	}
}

class ActionQuotedPrintableDecode extends AbstractAction
{
	public function __construct( $value )
	{
		parent::__construct( $value );
		$this->setContainer( new TextareaContainer );
		$this->setFormatter( new EchoFormatter );
	}

	public function decode()
	{
		return quoted_printable_decode( $this->value );
	}
}

class ActionUrldecode extends AbstractAction
{
	public function __construct( $value )
	{
		parent::__construct( $value );
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
	public function __construct( $value )
	{
		parent::__construct( $value );
		$this->setContainer( new TextareaContainer );
		$this->setFormatter( new EchoFormatter );
	}

	public function decode()
	{
		return urlencode( $this->value );
	}
}

class ActionUnserialize extends AbstractAction
{
	public function __construct( $value )
	{
		parent::__construct( $value );
		$this->setContainer( new DivContainer );
		$this->setFormatter( new DbugFormatter );
	}

	public function decode()
	{
		return unserialize( $this->value );
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

class DbugFormatter implements FormatterInterface
{
	public function format( $value )
	{
		ob_start();
		new dBug( $value );
		return ob_get_clean();
	}
}

class VardumpFormatter implements FormatterInterface
{
	public function format( $value )
	{
		ob_start();
		var_dump( $value );
		return ob_get_clean();
	}
}

class EchoFormatter implements FormatterInterface
{
	public function format( $value )
	{
		return $value;
	}
}
