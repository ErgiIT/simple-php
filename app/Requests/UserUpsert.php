<?php

namespace App\Requests;

class UserUpsert
{
    public static function upsertValidation()
    {
        $name = $_REQUEST["name"];
        $email = $_REQUEST["email"];
        $phone = $_REQUEST["phone"];
        $weight = $_REQUEST["weight"];
        $err = array();

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            array_push($err, "Only letters and white space allowed");
        }

        if(strlen($name)>255 || strlen($name)<2) {
            array_push($err, "Name must be between 2 and 255 characters");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($err, "Invalid format and please re-enter valid email");
        }

        if (!preg_match('/^\+[0-9]{1,5}\s[0-9]{9}$/', $phone)) {
            array_push($err, "Invalid phone number format. Please use the format: +[country code] [phone number]");
        }

        if($weight<0) {
            array_push($err, "Invalid weight");
        }

        if(count($err) != 0) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($err);
            die;
        }
    }
}