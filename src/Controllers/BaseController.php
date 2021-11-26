<?php
namespace ProjectReuse\Controllers;


abstract class BaseController
{

	protected string $requestMethod;
	protected array $headers = [ ];


	function __construct(string $requestMethod)
	{ 
		$this->requestMethod = $requestMethod;

		$this->headers =  [ 
			("Access-Control-Allow-Origin: *"),
	        ("Content-Type: application/json; charset=UTF-8"),
			("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"),
			("Access-Control-Max-Age: 3600"),
			("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"),
		];
	}

	protected function setHeader(array $headers)
	{ 
			$this->headers = $headers;
	}

	protected notFoundResponse() : Response
	{ 
		return new Response(null,404);
	}

	abstract processRequest();


	

}
