<?php

require_once 'model/ContactsGateway.php';
require_once 'model/ValidationException.php';


class ContactsService {
    
    private $contactsGateway    = NULL;
    private $con = NULL;
    private function openDb() 
    {
        $this->con=mysqli_connect("localhost", "root", "","mvc-crud");
        if (mysqli_connect_errno()) 
        {
            throw new Exception("Connection to the database server failed!");
        }
       
        
    }
    
    private function closeDb() {
        mysqli_close($this->con);
    }
  
    public function __construct() {
        $this->contactsGateway = new ContactsGateway();
    }
    
    public function getAllContacts($order) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectAll($order,$this->con);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }

    public function getnoofContacts($order) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->findnoofcontacts($order,$this->con);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function getContact($id) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectById($id,$this->con);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->contactsGateway->find($id);
    }
    
    private function validateContactParams( $name, $phone, $email, $address ) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function createNewContact( $name, $phone, $email, $address ) {
        try {
            $this->openDb();
            $this->validateContactParams($name, $phone, $email, $address);
            $res = $this->contactsGateway->insert($name, $phone, $email, $address,$this->con);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }

    public function editContact( $id, $name, $phone, $email, $address ) {
        try {
            $this->openDb();
            $this->validateContactParams($name, $phone, $email, $address);
            $res = $this->contactsGateway->modify($id, $name, $phone, $email, $address,$this->con);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function deleteContact( $id ) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->delete($id,$this->con);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    
}

?>
