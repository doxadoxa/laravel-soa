<?php
declare(strict_types=1);

namespace Doxadoxa\Soa\Exceptions;

class NotCallableHandleException extends \Exception
{

    protected $message = "Router handler must be callable.";

}
