<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-24 15:42:36
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-11-25 07:42:59
 */

namespace SISP\Exceptions;

use Exception;

class SISPException extends Exception
{

    /**
     * @param  string  $message
     * @param  int  $code
     * @param  \Exception|null  $previous
     *
     * @return void
     */
    public function __construct($message = 'Error en el servidor', $code = 666, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
