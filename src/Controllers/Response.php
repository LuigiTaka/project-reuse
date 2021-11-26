<?php

namespace ProjectReuse\Controllers;

class Response
{
	protected $body;
	protected $statusCode;

	function __construct($body,$statusCode)
	{ 
		$this->body = $body;
		$this->setStatusCode($statusCode);
	}	

	public function getBody()
	{ 
		return $this->body;
	}

	public function getStatusCode() : string
	{ 
		return $this->statusCode;
	}

	private function setStatusCode(int $code)
	{ 
		$status = null;
		switch($code){ 
			case 200:
				$status = 'HTTP/1.1 200 Success';
				break;
			case 201:
				$status = 'HTTP/1.1 201 Created';
				break;
			case 205:
				$status = 'HTTP/1.1 205 Reset Content';
				break;
			case 206:
				$status = 'HTTP/1.1 206 Partial Content';
				break;
			case 400:
				$status = 'HTTP/1.1 400 Bad Request';
				break;
			case 401:
				$status = 'HTTP/1.1 401 Unauthorized';
				break;
			case 403:
				$status = 'HTTP/1.1 403 Forbidden';
				break;
			case 404:
				$status = 'HTTP/1.1 404 Not Found';
				break;
			CASE 414:
				$status = 'HTTP/1.1 414 URI Too Long';
				break;
			case 422:
				$status = 'HTTP/1.1 422 Unprocessable Entity';
				break;
			case 418:
			default:
				$status = 'HTTP/1.1 418 I\'m a teapot';
				break;
		}
		$this->statusCode = $status;
	}

	private function processBody()
	{ 
		return $body;
	}

}
