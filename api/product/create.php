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


if(
    !empty($data->category_name) &&
    !empty($data->category_parent_id)
){

    $categories->category_name = $data->category_name;
    $categories->category_parent_id = $data->category_parent_id;

    if($categories->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Product was created."));
    }
    else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }
}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>
