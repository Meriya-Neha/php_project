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


class ResponseHelper{
    public static function Ok(string $message = "ok"):Response{
        return new Response(200, true, $message);
    }

    public static function Created(string $message = "created"):Response{
        return new Response(201, true, $message);
    }

    public static function Updated(string $message = "updated"):Response{
        return new Response(200, true, $message);
    }

    public static function Deleted(string $message = "deleted"):Response{
        return new Response(200, true, $message);
    }

    public static function BadRequest(string $message = "bad request"):Response{
        return new Response(400, false, $message);
    }

    public static function Unauthorized(string $message = "unauthorized"):Response{
        return new Response(401, false, $message);
    }

    public static function NotFound(string $message = "not found"):Response{
        return new Response(404, false, $message);
    }

    public static function InternalServerError(string $message = "internal server error"):Response{
        return new Response(500, false, $message);
    }  
    
    public function GeneralResponse($meta , $data=null){
        http_response_code($meta['code']);
        header('Content-Type: application/json');
        
        $response = [
            'status' => $meta['status'],
            'message' => $meta['message'],
            'data' => $data
        ];
        return json_encode($response);
    }
}
?>