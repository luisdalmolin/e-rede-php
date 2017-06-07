<?php

namespace Dalmolin\ERede\Exceptions;

use InvalidArgumentException;

class ERedeException extends InvalidArgumentException
{

	protected $codigoRetorno;

	public function setCodigoRetorno($codigoRetorno)
	{
		$this->codigoRetorno = $codigoRetorno;
	}
}
