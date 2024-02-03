<?php

function sendVerificationMail($user, $token) {
    $subject = "Verify your user";
    $message = view('auth/emailVerification', ['token' => $token]);
    $email = \Config\Services::email();
    $email->setTo($user['email']);
    $email->setFrom('info@shop.com', 'Shop');
    $email->setMessage($message);
    $email->setSubject($subject);
    return $email->send();  
}

function sendRecoverPasswordMail($user, $token) {
    $subject = "Reset your password";
    $message = view('auth/emailResetPassword', ['token' => $token]);
    $email = \Config\Services::email();
    $email->setTo($user['email']);
    $email->setFrom('webshopuh@gmail.com', 'Shop');
    $email->setMessage($message);
    $email->setSubject($subject);
    return $email->send();  
}