<?php

class Response {

    public static function jsonResponse(bool $status, string $message, array $data = []): string {
        return json_encode([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ]);
    }
}

?>
