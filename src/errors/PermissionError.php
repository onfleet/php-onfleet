<?php

namespace Onfleet\errors;

class PermissionError extends \Exception
{
	private $_name = 'PermissionError';

	public function __construct(string $message = "", string $cause = "", int $code = 0, $request)
	{
		parent::__construct("[{$this->_name}] {$message} {$cause}.", $code);
	}
}
