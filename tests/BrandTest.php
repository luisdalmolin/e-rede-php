<?php

use Dalmolin\ERede\Brand;

class BrandTest extends TestCase
{
	/** @test */
	function it_should_recognize_mastercard()
	{
		$this->assertEquals('mastercard', (new Brand('5111 1111 1111 1111'))->brand());
		$this->assertEquals('mastercard', (new Brand('5511 1111 1111 1111'))->brand());
	}

	/** @test */
	function it_should_recognize_visa()
	{
		$this->assertEquals('visa', (new Brand('4111 1111 1111 1111'))->brand());
	}

	/** @test */
	function it_should_recognize_am()
	{
		$this->assertEquals('american_express', (new Brand('3411 1111 1111 1111'))->brand());
		$this->assertEquals('american_express', (new Brand('3711 1111 1111 1111'))->brand());
	}

	/** @test */
	function it_should_recognize_diners()
	{
		$this->assertEquals('diners', (new Brand('3051 1111 1111 1111'))->brand());
		$this->assertEquals('diners', (new Brand('3001 1111 1111 1111'))->brand());
		$this->assertEquals('diners', (new Brand('3801 1111 1111 1111'))->brand());
		$this->assertEquals('diners', (new Brand('3601 1111 1111 1111'))->brand());
	}

	/** @test */
	function it_should_recognize_jcb()
	{
		$this->assertEquals('jcb', (new Brand('2131 1111 1111 1111'))->brand());
		$this->assertEquals('jcb', (new Brand('1800 1111 1111 1111'))->brand());
		$this->assertEquals('jcb', (new Brand('3500 1111 1111 1111'))->brand());
	}

	/** @test */
	function it_should_recognize_hipercard()
	{
		$this->assertEquals('hipercard', (new Brand('6062 8262 0073 9654'))->brand());
	}
}
