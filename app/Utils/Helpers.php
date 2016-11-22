<?php 

namespace SISP\Utils;

use Webpatser\Uuid\Uuid;

/**
* 
*/
class Helpers
{
	public static function uuid(string $hash = 'SISP-EL TUNAL C.A.') 
  {
    //  Process data
    if ($hash !== 'SISP-EL TUNAL C.A.'){
      $hash = 'SISP-'.$hash.'-EL TUNAL C.A.'; 
    }
    $uuid = Uuid::generate(5, $hash, Uuid::generate());

    //  Result
    return $uuid->string;
  }

}