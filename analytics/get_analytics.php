<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../models/Product.php';
require_once '../models/Sale.php';

$product = new Product();
$sale = new Sale();

$totalProducts = $product->getTotalProducts();
$salesPerProduct = $sale->getSalesPerProduct();
$revenuePerCategory = $sale->getRevenuePerCategory();

$analytics = [
    "total_number_of_products" => $totalProducts ? $totalProducts['total_products'] : 0,
    "sales_per_product" => $salesPerProduct ? $salesPerProduct : [],
    "revenue_per_category" => $revenuePerCategory ? $revenuePerCategory : []
];

http_response_code(200);
echo json_encode($analytics);