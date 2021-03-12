<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/categories.php';

$database = new Database();
$db = $database->getConnection();

$categories = new Categories($db);

$data = json_decode(file_get_contents("php://input"));

$categories->category_id = $data->category_id;
$categories->category_name = $data->category_name;
$categories->category_parent_id = $data->category_parent_id;

if($categories->update()){
    http_response_code(200);
    echo json_encode(array("message" => "Product was updated."));
}
else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update product."));
}
?>
