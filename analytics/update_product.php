<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");

require_once '../models/Product.php';

$product = new Product();
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['product_id'])) {
    $id = $data['product_id'];
    
    if ($product->update($id, $data)) {
        http_response_code(200);
        echo json_encode(["message" => "Product was updated."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to update product."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Unable to update product. Missing product_id."]);
}