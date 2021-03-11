<?php
class Categories{

    // database connection and table name
    private $conn;
    private $table_name = "categories";
    private $table_name2 = "categories_tree";

    // object properties

    public $category_id;
    public $sel_category_id;
    public $category_name;
    public $category_parent_id;
    //public $category_id;
    //public $category_name;
    //public $created;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read($cat){

        // select all query
        $query = "SELECT
                    c.id as category_id, c.name as category_name, ct.cat_par_id as category_parent_id
                FROM
                    " . $this->table_name . " c
                    LEFT JOIN
                        categories_tree ct
                            ON ct.cat_id = c.id
                    WHERE ct.cat_par_id= :cat
                ORDER BY
                    ct.cat_par_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cat", $cat);
        // execute query
        $stmt->execute();

        return $stmt;
    }

    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:category_name";
       $stmt1 = $this->conn->prepare($query);


        $query2 = "SELECT c.id as cid FROM
                            " . $this->table_name . " c
                        WHERE
                            name=:category_name";

        $stmt2 = $this->conn->prepare($query2);



        $query3 = "INSERT INTO
                    " . $this->table_name2 . "
                SET
                    cat_id=:sel_category_id,
                    cat_par_id=:category_parent_id
                ";

        $stmt3 = $this->conn->prepare($query3);


        // sanitize
        $this->category_name=htmlspecialchars(strip_tags($this->category_name));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->category_parent_id=htmlspecialchars(strip_tags($this->category_parent_id));
        $this->sel_category_id=htmlspecialchars(strip_tags($this->sel_category_id));


        // bind values

        $stmt1->bindParam(":category_name", $this->category_name);
        $stmt2->bindParam(":category_name", $this->category_name);
        $stmt3->bindParam(":sel_category_id", $this->sel_category_id);
        $stmt3->bindParam(":category_parent_id", $this->category_parent_id);

        if($stmt2->execute() ){

        // get retrieved row
          $row = $stmt2->fetch(PDO::FETCH_ASSOC);

          // set values to object properties
          $this->sel_category_id = $row['cid'];


          // execute query
          if($stmt1->execute() && $stmt3->execute()){
              return true;
          }
        }
        return false;

    }
    function readOne(){

    // query to read single record
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.id = ?
            LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->name = $row['name'];
    $this->price = $row['price'];
    $this->description = $row['description'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];
}
function update(){

    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :category_name
            WHERE
                id = :category_id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->category_name=htmlspecialchars(strip_tags($this->category_name));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));

    // bind new values
    $stmt->bindParam(':category_name', $this->category_name);
    $stmt->bindParam(':category_id', $this->category_id);

    // execute the query
    if($stmt->execute()){
        return true;
    }

    return false;
}
function delete(){

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind id of record to delete
    $stmt->bindParam(1, $this->id);

    // execute query
    if($stmt->execute()){
        return true;
    }

    return false;
}
function search($keywords){

    // select all query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
            ORDER BY
                p.created DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);

    // execute query
    $stmt->execute();

    return $stmt;
}
public function readPaging($from_record_num, $records_per_page){

    // select query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY p.created DESC
            LIMIT ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
}
// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
}
}
?>
