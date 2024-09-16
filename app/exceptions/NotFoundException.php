<?php

declare(strict_types=1);

namespace Albums\exceptions;

use \Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \Exception implements NotFoundExceptionInterface
{
}