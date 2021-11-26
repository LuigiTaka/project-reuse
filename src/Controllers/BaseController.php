<?php


abstract class BaseController
{

	protected string $requestMethod;

	function __construct(string $requestMethod)
	{ 
		$this->requestMethod = $requestMethod;
	}

	abstract processRequest();


	

}
