<?php
require_once 'DBConnection.php';
class Report {
    
    private $ReportID;
    private $UserID;
    private $PostID;
    private $WhenDate;
    private $WhereFind;
    private $DesOfChild;
    private $Contact;

    function __construct($id){
        if($id != ""){
            $DBConn=new Connection;
            $sql="select * from report where ID=$id";
            $res= $DBConn->Conn->query($sql);

            foreach($res as $rows){
                $this->ReportID=$rows['ID'];
                $this->UserID=$rows['userID'];
                $this->PostID=$rows['postID'];
                $this->WhenDate= $rows['when_date'];
                $this->WhereFind= $rows['where_find'];
                $this->DesOfChild= $rows['des_of_child'];
                $this->Contact= $rows['contact'];
            }
        }
    }
/*************************************************** Setters ******************************************************/
      public function setReportID($reportID)
      {
        $this->ReportID=$reportID;
      }
      public function setUserID($userID)
      {
        $this->UserID=$userID;
      }
      public function setPostID($postID)
      {
        $this->PostID=$postID;
      }
      public function setWhenDate($whenDate)
      {
        $this->WhenDate=$whenDate;
      }
      public function setWhereFind($whereFind)
      {
        $this->WhereFind=$whereFind;
      }
      public function setDesOfChild($desOfchild)
      {
        $this->DesOfChild=$desOfchild;
      }
      public function setContact($contact)
      {
        $this->Contact=$contact;
      }
/************************************************ End of setters ***************************************************/

    
/**************************************************** Getters ******************************************************/
      public function getReportID()
      {
        return $this->ReportID;
      }
      public function getUserID()
      {
        return $this->UserID;
      }
      public function getPostID()
      {
        return $this->PostID;
      }
      public function getWhenDate()
      {
        return $this->WhenDate;
      }
      public function getWhereFind()
      {
        return $this->WhereFind;
      }
      public function getDesOfChild()
      {
        return $this->DesOfChild;
      }
      public function getContact()
      {
        return $this->Contact;
      }
/**************************************************** End of Getters ***************************************************/    
}
?>