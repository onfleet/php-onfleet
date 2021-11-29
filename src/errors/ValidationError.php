<?php

namespace Onfleet\errors;

class ValidationError extends \Exception
{
	private $_name = 'ValidationError';
	protected $message = 'Unknown exception';

	public function __construct($message = null)
	{
		if (!$message) {
			throw new $this('Unknown ' . get_class($this));
		}
		parent::__construct("{$this->_name}: $message");
	}
}
