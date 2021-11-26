<?php

namespace ProjectReuse;

class ArrayUtils
{

	static function toJson(array $data)
	{ 

		return json_encode( $data , JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	}


}
