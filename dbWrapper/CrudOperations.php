    <?php
    require_once "query.php";
     class CrudOperations  {
    //    
    //  public static function delete($_connection) {
    //   
    //     $sql = "delete from empmaster where empid = 1";
    //
    //$stmt= $_connection->prepare( $sql );
    //echo $stmt->execute()."Deleted1";
    //
    //  }
     
      public static function insert(){
        $table='empmaster';
        $values=array('empid'=>3,'emp_name'=>'rocky','desingnation'=>'singh', 'age'=>21 );
        $query=new Query();
        $is_insert = $query->insert($table,$values);
        if ($is_insert) {
            echo "<br>";
            echo "one row inserted";
            echo "<br>";
        } else {
                echo "insert unsuccessful" ;
            }
        }
     
     
        public static function update(){
        $query=new Query();
        $table='empmaster';
        $data = array('address' => 'ShivajiNagar');
        $where = array('`empid` = ?' => 3, '`age` = ?' => 21);
        $rows_affected = $query->update($table,$data,$where);
            if ($rows_affected) {
                echo "<br>";
                echo "one row updated";
                echo "<br>";
            } else {
                echo "update unsuccessful" ;
            }
    }
         public static function delete(){
        $query=new Query();
        $table='empmaster';
        $where = array('`empid` = ?' => 3, '`age` = ?' => 21);
        $rows_affected = $query->delete($table,$where);
            if ($rows_affected) {
                echo "<br>";
                echo "one row deleted";
                echo "<br>";
            } else {
                echo "update unsuccessful" ;
            }
        }
     
     }
     $select=CrudOperations::insert();
     $update= CrudOperations::update();
     $delete= CrudOperations::delete();

     
    ?>