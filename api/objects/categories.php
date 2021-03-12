<?php
class Categories{

  private $conn;
  private $table_name = "categories";
  private $table_name2 = "categories_tree";

  public $category_id;
  public $sel_category_id;
  public $category_name;
  public $category_parent_id;

  public function __construct($db){
    $this->conn = $db;
  }

  function read(){

    $query = "SELECT
    c.id as category_id, c.name as category_name, ct.cat_par_id as category_parent_id
    FROM
    " . $this->table_name . " c
    LEFT JOIN
    categories_tree ct
    ON ct.cat_id = c.id
    ORDER BY
    ct.cat_par_id";

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
  }

  function create(){

    $query = "INSERT INTO " . $this->table_name . " SET name=:category_name";
    $stmt1 = $this->conn->prepare($query);
    $query2 = "SELECT c.id as cid FROM " . $this->table_name . " c WHERE name=:category_name";
    $stmt2 = $this->conn->prepare($query2);
    $query3 = "INSERT INTO " . $this->table_name2 . " SET cat_id=:sel_category_id,cat_par_id=:category_parent_id ";
    $stmt3 = $this->conn->prepare($query3);

    $this->category_name=htmlspecialchars(strip_tags($this->category_name));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->category_parent_id=htmlspecialchars(strip_tags($this->category_parent_id));
    $this->sel_category_id=htmlspecialchars(strip_tags($this->sel_category_id));

    $stmt1->bindParam(":category_name", $this->category_name);
    $stmt2->bindParam(":category_name", $this->category_name);
    $stmt3->bindParam(":sel_category_id", $this->sel_category_id);
    $stmt3->bindParam(":category_parent_id", $this->category_parent_id);

    if($stmt1->execute() && $stmt2->execute() ){
      $row = $stmt2->fetch(PDO::FETCH_ASSOC);
      $this->sel_category_id = $row['cid'];
      if($stmt3->execute()){
        return true;
      }
    }
    return false;

  }

  function update(){

      $query = "UPDATE
      " . $this->table_name . "
      SET
      name = :category_name
      WHERE
      id = :category_id";

      $query2 = "UPDATE
      " . $this->table_name2 . "
      SET
      cat_par_id = :category_parent_id
      WHERE
      cat_id = :category_id
      ";


    $stmt1 = $this->conn->prepare($query);
    $stmt2 = $this->conn->prepare($query2);
    $this->category_name=htmlspecialchars(strip_tags($this->category_name));


    $this->category_id=htmlspecialchars(strip_tags($this->category_id));


    $this->category_parent_id=htmlspecialchars(strip_tags($this->category_parent_id));
    $stmt1->bindParam(':category_name', $this->category_name);
    $stmt1->bindParam(':category_id', $this->category_id);
    $stmt2->bindParam(':category_parent_id', $this->category_parent_id);
    $stmt2->bindParam(':category_id', $this->category_id);
    if($stmt1->execute() && $stmt2->execute()){
      return true;
    }

    return false;
  }
}
?>
