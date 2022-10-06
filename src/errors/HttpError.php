<?php

namespace Onfleet\errors;

class HttpError extends \Exception
{
	private $_name = 'HttpError';

	public function __construct(string $message = "", $cause = "", int $code = 0, $request)
	{
		if(is_array($cause)) $cause = implode(", ",$cause);
		parent::__construct("[{$this->_name}] {$message} {$cause}.", $code);
	}
}
