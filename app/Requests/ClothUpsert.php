<?php

namespace App\Requests;

class ClothUpsert
{
    public static function upsertValidation()
    {
        $title = $_REQUEST["title"];
        $description = $_REQUEST["description"];
        $size = $_REQUEST["size"];
        $price = $_REQUEST["price"];
        $quantity = $_REQUEST["quantity"];
        $currency = $_REQUEST["currency"];
        $type = $_REQUEST["type"];

        $err = array();

        if (empty($title)) {
            array_push($err, "Title is required");
        }

        if(strlen($title)>45) {
            array_push($err, "Title has a maximum of 45 characters");
        }

        if (empty($description)) {
            array_push($err, "Description is required");
        }

        if(strlen($description)>255) {
            array_push($err, "Description has a maximum 255 characters");
        }

        if (empty($size)) {
            array_push($err, "Size is required");
        }

        if (!is_numeric($price) || $price <= 0) {
            array_push($err, "Price must be a positive number");
        }

        if (!is_numeric($quantity) || $quantity < 0) {
            array_push($err, "Quantity must be a positive number");
        }

        if (empty($currency)) {
            array_push($err, "Currency is required");
        }

        $validTypes = ["jeans", "shirt", "pants", "underwear", "t-shirt"];
        if (!in_array($type, $validTypes)) {
            array_push($err, "Invalid type. Allowed types are: jeans, shirt, pants, underwear, t-shirt");
        }

        if(count($err) != 0) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($err);
            die;
        }
    }
}