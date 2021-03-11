<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


function readCat($cat){
  include_once '../config/database.php';
  include_once '../objects/categories.php';

  $database = new Database();
  $db = $database->getConnection();

  $product = new Categories($db);

  $stmt = $product->read($cat);
  $num = $stmt->rowCount();

  if($num>0){

      $products_arr=array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);

          $product_item=array(
              "category_id" => $category_id,
              "category_name" => $category_name,
              "category_parent_id" => $category_parent_id,
              "cat_child" => readCat($category_id),
          );
          //  array_push($products_arr, $product_item);readCat($cat)
          array_push($products_arr, $product_item);
      }
      http_response_code(200);
      return $products_arr;
      //echo json_encode($products_arr);
  }
  else{
      http_response_code(404);
      //echo json_encode(
      //    array("message" => "No products found.")
    //  );
    return array("message" => "No products found.");

  }
}
$cat = 0;
echo json_encode(readCat($cat));
?>
