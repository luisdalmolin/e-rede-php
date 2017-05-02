<?php

namespace Dalmolin\ERede;

use SoapClient;

class Config
{
	/**
	 * @var  static
	 */
	public static $instance;

	/**
	 * E-Rede token
	 */
	protected $token;

	/**
	 * E-Rede filiação
	 */
	protected $filiacao;

	/**
	 * Environment
	 */
	protected $environment = 'sandbox';

	/**
	 * @var  Guzzle\Http\Client
	 */
	public $client;

	protected $endpoints = [
		'sandbox'    => 'https://scommerce.userede.com.br/Redecard.Komerci.External.WcfKomerci/KomerciWcf.svc',
		'production' => 'https://ecommerce.userede.com.br/Redecard.Adquirencia.Wcf/KomerciWcf.svc',
	];

	public function configure()
	{
		$this->client = new SoapClient($this->endpoints[$this->environment], [
			'trace'        => 1,
			'exceptions'   => 1,
			'style'        => SOAP_DOCUMENT,
			'use'          => SOAP_LITERAL,
			'soap_version' => SOAP_1_1,
			'encoding'     => 'UTF-8'
		]);
	}

	public function execute()
	{

	}

	public static function getInstance()
	{
		if (! static::$instance) {
			static::$instance = new static;
			static::$instance->configure();
		}

		return static::$instance;
	}

	public function setToken($token)
	{
		$this->token = $token;
		return $this;
	}

	public function setFiliacao($filiacao)
	{
		$this->filiacao = $filiacao;
		return $this;
	}

	public function setEnvironment($environment)
	{
		$this->environment = $environment;
		return $this;
	}

	public function getEnvironment()
	{
		return $this->environment;
	}

	public function configured()
	{
		return $this->client;
	}

	public function call($method, $data)
    {
        return $this->client->{$method}(array_merge($data, [
			'SENHA'    => $this->token,
			'FILIACAO' => $this->filiacao,
		]));
    }
}
