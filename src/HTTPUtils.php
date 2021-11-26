<?php

namespace ProjectReuse;


class HTTPUtils
{

	static function jsonResponse(array $data)
	{ 
		$json = ArrayUtils::toJson($data);
		
	}



	static function getPost(array &$post) : void
	{ 
		$input = json_decode(file_get_contents("php://input"), true);
		$post = array_merge($input,$post);	
	}


}
