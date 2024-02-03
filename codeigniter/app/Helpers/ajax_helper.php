<?php
    function createAjaxResponse($response) {
        $response['csrfToken'] = csrf_token();
        $response['csrfHash'] = csrf_hash();
        return json_encode($response);
    }
?>