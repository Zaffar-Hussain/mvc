<?php

/**
 * Table data gateway.
 * 
 *  OK I'm using old MySQL driver, so kill me ...
 *  This will do for simple apps but for serious apps you should use PDO.
 */
class ContactsGateway {
    
    public function selectAll($order,$con) {

        if ( !isset($order) ) {
            $order = "name";
        }

        $limit = 5; 
        if (isset($_GET["page"])) 
        {  
            $pn  = $_GET["page"];  
        }  
        else 
        {  
          $pn=1;  
        }
        $start_from = ($pn-1) * $limit;

        $dbOrder =  mysqli_real_escape_string($con,$order);
        $dbres = mysqli_query($con,"SELECT * FROM contacts ORDER BY $dbOrder ASC LIMIT $start_from,$limit ");
        
        $contacts = array();
        while ( ($obj = mysqli_fetch_object($dbres)) != NULL ) {
            $contacts[] = $obj;
        }
        
        return $contacts;
    }

    public function findnoofcontacts($order,$con) {

        $dbOrder =  mysqli_real_escape_string($con,$order);
        $dbres = mysqli_query($con,"SELECT COUNT(*) FROM contacts"); 
        $total_records = 0;    
        while ( ($obj = mysqli_fetch_row($dbres)) != NULL ) {
            $total_records = $obj[0];
        }   
        
        $limit=5;
        $total_pages = ceil($total_records / $limit);

        return $total_pages;
    }
    
    public function selectById($id,$con) {
        $dbId = mysqli_real_escape_string($con,$id);
        
        $dbres = mysqli_query($con,"SELECT * FROM contacts WHERE id=$dbId");
        
        return mysqli_fetch_object($dbres);
		
    }

    public function insert( $name, $phone, $email, $address ,$con) {
        
        $dbName = ($name != NULL)?"'".mysqli_real_escape_string($con,$name)."'":'NULL';
        $dbPhone = ($phone != NULL)?"'".mysqli_real_escape_string($con,$phone)."'":'NULL';
        $dbEmail = ($email != NULL)?"'".mysqli_real_escape_string($con,$email)."'":'NULL';
        $dbAddress = ($address != NULL)?"'".mysqli_real_escape_string($con,$address)."'":'NULL';
        
        mysqli_query($con,"INSERT INTO contacts (name, phone, email, address) VALUES ($dbName, $dbPhone, $dbEmail, $dbAddress)");
        return mysqli_insert_id($con);
    }
    
    
    public function modify( $id, $name, $phone, $email, $address ,$con) {
        
        $dbName = ($name != NULL)?"'".mysqli_real_escape_string($con,$name)."'":'NULL';
        $dbPhone = ($phone != NULL)?"'".mysqli_real_escape_string($con,$phone)."'":'NULL';
        $dbEmail = ($email != NULL)?"'".mysqli_real_escape_string($con,$email)."'":'NULL';
        $dbAddress = ($address != NULL)?"'".mysqli_real_escape_string($con,$address)."'":'NULL';
        
        mysqli_query($con,"UPDATE contacts SET name=$dbName, phone=$dbPhone, email=$dbEmail, address=$dbAddress WHERE id=$id" );
        return mysqli_insert_id($con);
    }
    
    public function delete($id,$con) {
        $dbId = mysqli_real_escape_string($con,$id);
        mysqli_query($con,"DELETE FROM contacts WHERE id=$dbId");
    }
    
}

?>
