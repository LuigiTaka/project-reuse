<?php
namespace ProjectReuse\Controllers;

use ProjectReuse\{ArrayUtils,HTTPUtils};

abstract class BaseController
{

	protected $requestMethod = '';
	protected $headers = [ ];


	function __construct(string $requestMethod)
	{ 
		$this->requestMethod = $requestMethod;

		$this->headers = $this->getDefaultHeaders() ;
	}

	protected function getDefaultHeaders()
	{ 
		return [ 
			("Access-Control-Allow-Origin: *"),
	        ("Content-Type: application/json; charset=UTF-8"),
			("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"),
			("Access-Control-Max-Age: 3600"),
			("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"),
		];
	}
	
	protected function flushHeaders()
	{ 
		foreach($this->headers as $index => $header)	{ 
			header($header);
		}
	}

	protected function setHeader(array $headers)
	{ 
			$this->headers = $headers;
	}

	protected function notFoundResponse() : Response
	{ 
		return new Response(null,404);
	}

	protected function jsonResponse(array $data,?int $code =  null)
	{ 
		$json = ArrayUtils::toJson($data);
		return new Response($json,$code);
	}

	abstract function processRequest();


	

}
