<?php 
    function createResponse($success, $message = '', $data = []) {
        return ['success' => $success, 'message' => $message, 'data' => $data];
    }
?>