<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../models/Product.php';

$product = new Product();

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['product_id']) && !empty($data['product_name']) && isset($data['product_price']) && !empty($data['category_id'])) {
    if ($product->create($data)) {
        http_response_code(201);
        echo json_encode(["message" => "Product was created."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to create product."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Unable to create product. Data is incomplete."]);
}