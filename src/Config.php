<?php

namespace Dalmolin\ERede;

use Exception;
use SoapClient;
use Illuminate\Support\Facades\Log;

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
	 * E-Rede identificacaoFatura
	 */
	protected $identificacaoFatura;

	/**
	 * Environment
	 */
	protected $environment = 'sandbox';

	/**
	 * @var  Guzzle\Http\Client
	 */
	public $client;

	protected $endpoints = [
		'sandbox'    => 'https://scommerce.userede.com.br/Redecard.Komerci.External.WcfKomerci/KomerciWcf.svc?wsdl',
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

	public static function getInstance()
	{
		if (! static::$instance) {
			static::$instance = new static;
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

	public function setIdentificacaoFatura($identificacaoFatura)
	{
		$this->identificacaoFatura = $identificacaoFatura;
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
    	$data = array_merge($data, [
			'Senha'               => $this->token,
			'Filiacao'            => $this->filiacao,
			'IdentificacaoFatura' => $this->identificacaoFatura,
		]);

    	try {
	        return $this->client->{$method}(['request' => $data]);
	    }
	    catch (Exception $e) {
	    	Log::error($e);
	    }
    }

    public function debugLastRequest()
    {
    	echo "====== REQUEST HEADERS =====" . PHP_EOL;
	    var_dump($this->client->__getLastRequestHeaders());
	    echo "========= REQUEST ==========" . PHP_EOL;
	    var_dump($this->client->__getLastRequest());
	    echo "========= RESPONSE =========" . PHP_EOL;
    }
}
