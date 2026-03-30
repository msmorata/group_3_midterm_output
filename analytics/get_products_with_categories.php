<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../models/Product.php';

$product = new Product();
$result = $product->getProductsWithCategories();

if ($result) {
    http_response_code(200);
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(["message" => "No records found."]);
}