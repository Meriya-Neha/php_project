<?php

class ErrorHandler
{
    public static function handle(Throwable $err): void
    {
        error_log('ERROR: ' . $err->getMessage());

        if ($err instanceof InvalidRequestException) {
            ResponseHelper::InvalidRequest($err->getMessage());
            return;
        }

        if ($err instanceof NotFoundException) {
            ResponseHelper::notFound($err->getMessage());
            return;
        }

        if ($err instanceof UnauthorizedException) {
            ResponseHelper::unauthorized($err->getMessage());
            return;
        }

        ResponseHelper::serverError('Internal Server Error');
    }
}