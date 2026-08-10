<?php

    class BaseException extends Exception {
        public $statusCode=0;

        public function __construct(string $message, int $statusCode) {
            parent::__construct($message);
            $this->statusCode = $statusCode;
        }
    }
    class NotFoundException extends BaseException {
        public function __construct($message = "Resource not found") {
            parent::__construct($message, 404);
        }
    }

    class InvalidRequestException extends BaseException {
        public function __construct($message = "Invalid input") {
            parent::__construct($message, 400);
        }
    }

    class UnauthorizedException extends BaseException {
        public function __construct($message = "Unauthorized") {
            parent::__construct($message, 401);
        }
    }

    class InternalServerErrorException extends BaseException {
        public function __construct($message = "Internal server error") {
            parent::__construct($message, 500);
        }
    }


?>