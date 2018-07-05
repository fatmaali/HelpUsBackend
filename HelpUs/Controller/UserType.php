<?php
require_once 'DBConnection.php';
class UserTypeID {
    
    private $userTypeID;
    private $Name;

    function __construct($id){
        if($id != ""){
            $DBConn=new Connection;
            $sql="select * from user_type where userTypeID=$id";
            $res= $DBConn->Conn->query($sql);

            foreach($res as $rows){
                $this->userTypeID=$rows['userTypeID'];
                $this->Name= $rows['name'];
            }
        }
    }
/*************************************************** Setters ******************************************************/
      public function setUserTypeID($UserTypeID)
      {
        $this->userTypeID=$UserTypeID;
      }
      public function setName($name)
      {
        $this->Name=$name;
      }
/************************************************ End of setters ***************************************************/

    
/**************************************************** Getters ******************************************************/
      public function getUserTypeID()
      {
        return $this->userTypeID;
      }
      public function getName()
      {
        return $this->Name;
      }
/**************************************************** End of Getters ***************************************************/    
}
?>