<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


function readCat($cat){
  include_once '../config/database.php';
  include_once '../objects/categories.php';

  $database = new Database();
  $db = $database->getConnection();

  $categories = new Categories($db);

  $stmt = $categories->read();
  $num = $stmt->rowCount();

  if($num>0){

      $products_arr=array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);

          $product_item=array(
              "id" => $category_id,
              "parent" => $category_parent_id,
              "text" => $category_name,
          );
          array_push($products_arr, $product_item);
      }
      http_response_code(200);
      return $products_arr;
  }
  else{
      http_response_code(404);
    return array("message" => "No products found.");

  }
}
$cat = 0;
echo json_encode(readCat($cat));
?>
