<?php

namespace Dalmolin\ERede\Resources;

use Dalmolin\ERede\Config;
use Exception;

abstract class Resource
{
	/**
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * @var Dalmolin\ERede\Config
	 */
	protected $config;

	public function __construct($data = [])
	{
		$this->fill($data);

		$this->config = Config::getInstance();
	}

	public function isFillable($key)
	{
		return in_array($key, $this->fillable);
	}

	public function setAttribute($key, $value)
	{
		$method = 'set' . $this->_studly($key) . 'Attribute';

		if (method_exists($this, $method)) {
			$this->{$method}($value);
			return $this;
		}

		$this->attributes[$key] = $value;
		return $this;
	}

	public function getAttribute($key)
	{
		if (isset($this->attributes[$key])) {
			return $this->attributes[$key];
		}
	}

	public function __set($key, $value)
	{
		return $this->setAttribute($key, $value);
	}

	public function __get($key)
	{
		return $this->getAttribute($key);
	}

	public function call($method, $data = [])
	{
		return $this->client->call($method, $data);
	}

	public function handleClientException(ClientException $e, $data = [])
	{
		$contents           = json_decode($e->getResponse()->getBody()->getContents());
		$exception          = new RemoteException($e->getMessage());
		$exception->data    = $data;
		$exception->headers = $e->getRequest()->getHeaders();

		$exception->setErrorCode(isset($contents->errors) ? $contents->errors[0]->code : null);
		$exception->setError(isset($contents->errors) ? $contents->errors[0]->description : '');

		throw $exception;
	}

	public function handleException(Exception $e)
	{
		$exception = new RemoteException($e->getMessage());
		$exception->setError('Ocorreu um erro desconhecido, por favor, tente novamente');

		throw $exception;
	}
}
