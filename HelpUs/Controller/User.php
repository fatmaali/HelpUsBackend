<?php
require_once 'DBConnection.php';
require_once 'QueryBuilder.php';
class User {
    
    private $userID;
    private $Username;
    private $Email;
    private $Password;
    private $Fullname;
    private $Gender;
    private $dob;
    private $pic;
    private $userTypeID;

    function __construct($id){
        if($id != ""){
            $DBConn=new Connection;
            $sql="select * from user where ID=$id";
            $res= $DBConn->Conn->query($sql);

            foreach($res as $rows){
                $this->userID=$rows['ID'];
                $this->Username= $rows['username'];
                $this->Email= $rows['email'];
                $this->Password= $rows['password'];
                $this->Fullname= $rows['fullname'];
                $this->Gender= $rows['gender'];
                $this->dob= $rows['dob'];
                $this->pic= $rows['profile_pic'];
                $this->userTypeID= $rows['usertype_id'];
            }
        }
    }
/*************************************************** Setters ******************************************************/
      public function setID($ID)
      {
        $this->userID=$ID;
      }
      public function setUsername($userName)
      {
        $this->Username=$userName;
      }
      public function setEmail($email)
      {
        $this->Email=$email;
      }
      public function setPassword($Pass)
      {
        $this->Password=$Pass;
      }
      public function setFullname($fullName)
      {
        $this->Fullname=$fullName;
      }
      public function setGender($gender)
      {
        $this->Gender=$gender;
      }
      public function setDOB($DOB)
      {
        $this->dob=$DOB;
      }
      public function setPic($PIC)
      {
        $this->pic=$PIC;
      }
      public function setUserTypeID($userTypeid)
      {
        $this->userTypeID=$userTypeid;
      }
/************************************************ End of setters ***************************************************/

    
/**************************************************** Getters ******************************************************/
      public function getID()
      {
        return $this->userID;
      }
      public function getUsername()
      {
        return $this->Username;
      }
      public function getEmail()
      {
        return $this->Email;
      }
      public function getPassword()
      {
        return $this->Password;
      }
      public function getFullname()
      {
        return $this->Fullname;
      }
      public function getGender()
      {
        return $this->Gender;
      }
      public function getDOB()
      {
        return $this->dob;
      }
      public function getPIC()
      {
        return $this->pic;
      }
      public function getUserTypeID()
      {
        return $this->userTypeID;
      }
/**************************************************** End of Getters ***************************************************/
    
    
/******************************************************** Register *****************************************************/  
    static function Register($UserObject)
    {       
        $QueryObj=new QueryBuilder;
        $Email=$UserObject->getEmail();
        $Username=$UserObject->getUsername();
        $check=QueryBuilder::isExist($Email,$Username);
        
        if ($check != TRUE) {
            $QueryObj->AddUser($UserObject);
            if ($UserObject->getUserTypeID() == "2") {
                $Obj = new User(NULL);
                $Obj->setID($UserObject->getID());
            } else {
                return TRUE;
            }    
        } else {
            return FALSE;
        }
    }       
/***************************************************** End of register *************************************************/
    
    
/********************************************************** Login ******************************************************/
    static function Login($UserObject)
    {  
        $QueryObj= new QueryBuilder;
        $Email=$UserObject->getEmail();
        $Pass=$UserObject->getPassword();
        $res=$QueryObj->selectByEmailOrUsername($Email,$Pass);
       
            return $res;
    
	}   
/******************************************************* End of login **************************************************/
}
?>