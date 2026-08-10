<?php

class Response {
    public int $statusCode;
    public bool $success;
    public string $message;


    public function __construct(int $statusCode, bool $success, string $message) {
        $this->statusCode = $statusCode;
        $this->success = $success;
        $this->message = $message;
    }
}


class ResponseHelper
{
    public static function GeneralResponse(int $code, bool $status, string $message): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode([
            'status'  => $status,
            'message' => $message,
        ]);
    }

    public static function created(string $message, mixed $data = null): void
    {
        self::GeneralResponse(201, true, $message);
    }

    public static function ok(string $message,mixed $data):void
    {
        self::GeneralResponse(200, true, $message);
    }

    public static function InvalidRequest(string $message): void
    {
        self::GeneralResponse(400, false, $message);
    }

    public static function notFound(string $message): void
    {
        self::GeneralResponse(404, false, $message);
    }

    public static function unauthorized(string $message): void
    {
        self::GeneralResponse(401, false, $message);
    }

    public static function serverError(string $message): void
    {
        self::GeneralResponse(500, false, $message);
    }
}

?>