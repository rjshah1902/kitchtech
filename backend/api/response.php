<?php

class Response {

    public static function jsonResponse(bool $status, string $message, array $data = []): string {
        echo json_encode([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ]);
        exit;
    }
}

?>
