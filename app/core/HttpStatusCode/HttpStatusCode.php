<?php

declare(strict_types=1);

namespace Albums\core\HttpStatusCode;

class HttpStatusCode
{
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status

    const INFO = HttpStatusCodeInformational::class;
    const SUCCESS = HttpStatusCodeSuccessful::class;
    const REDIRECT = HttpStatusCodeRedirection::class;
    const CLIENT = HttpStatusCodeClientError::class;
    const SERVER = HttpStatusCodeServerError::class;
}