<?php
namespace TracaReuse;

class StringUtils{

    static function unaccent($string, array $whitelist = [])
    {
        if (!empty($whitelist)) {
            $mask = [];
            $hash = 123;
            foreach ($whitelist as $char) {
                $mask[$hash] = $char;
                $string = str_replace($char, $hash, $string);
                $hash++;
            }
        }

        $result = preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);~i',
            '$1',
            htmlentities($string, ENT_QUOTES, 'UTF-8'));

        if (!empty($mask)) {
            foreach ($mask as $hash => $char) {
                $result = str_replace($hash, $char, $result);
            }
        }

        return $result;
    }

    static function normalize($string)
    {
        return preg_replace('/[^\w]/','',self::unaccent(mb_strtolower($string)));
    }

}
