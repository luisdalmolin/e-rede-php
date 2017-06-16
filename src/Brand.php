<?php

namespace Dalmolin\ERede;

class Brand
{
	/**
	 * @var string
	 */
	protected $number;

	/**
	 * @var array
	 */
	protected $brands = [
		'hipercard'        => '/^(606282\d{10}(\d{3})?)|(3841\d{15})$/',
		'visa'             => '/^4[0-9]{6,}$/',
		'mastercard'       => '/^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$/',
		'american_express' => '/^3[47][0-9]{5,}$/',
		'diners'           => '/^3(?:0[0-5]|[68][0-9])[0-9]{4,}$/',
		'jcb'              => '/^(?:2131|1800|35[0-9]{3})[0-9]{3,}$/',
	];

	public function __construct($number)
	{
		$this->number = str_replace(' ', '', $number);
	}

	public function brand()
	{
		foreach ($this->brands as $brand => $expression) {
			preg_match($expression, $this->number, $matches, PREG_OFFSET_CAPTURE);

			if (count($matches) > 0) {
				return $brand;
			}
		}
	}
}
