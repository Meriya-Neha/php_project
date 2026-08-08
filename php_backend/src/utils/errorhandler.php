<?php

class ErrorHandler
{
    public static function handle(Throwable $err): void
    {
        error_log('ERROR: ' . $err->getMessage());

        if ($err instanceof InvalidRequestException) {
            ResponseHelper::send(ResponseHelper::invalidRequest($err->getMessage()));
            return;
        }

        if ($err instanceof NotFoundException) {
            ResponseHelper::send(ResponseHelper::notFound($err->getMessage()));
            return;
        }

        if ($err instanceof UnAuthorizeException) {
            ResponseHelper::send(ResponseHelper::unauthorized($err->getMessage()));
            return;
        }

        ResponseHelper::send(ResponseHelper::internalServerError());
    }
}