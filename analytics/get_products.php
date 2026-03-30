<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../models/Product.php';

$product = new Product();
$result = $product->getAll();

if ($result) {
    http_response_code(200);
    echo json_encode(["records" => $result]);
} else {
    http_response_code(404);
    echo json_encode(["message" => "No products found."]);
}