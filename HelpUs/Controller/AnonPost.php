<?php
require_once 'DBConnection.php';
class AnonymousPost {
    
    private $PostID;
    private $UserID;
    private $Name;
    private $Pic;
    private $FindingPlace;
    private $FindingDate;
    private $ConFinding;
    private $ContactInfo;
    private $ReportNum;

    function __construct($id){
        if($id != ""){
            $DBConn=new Connection;
            $sql="select * from anon_post where ID=$id";
            $res= $DBConn->Conn->query($sql);

            foreach($res as $rows){
                $this->PostID=$rows['ID'];
                $this->UserID=$rows['userID'];
                $this->Name=$rows['name'];
                $this->Pic=$rows['pic'];
                $this->FindingPlace= $rows['finding_place'];
                $this->FindingDate= $rows['finding_date'];
                $this->ConFinding= $rows['con_finding'];
                $this->ContactInfo= $rows['contact_info'];
                $this->ReportNum= $rows['report_num'];
            }
        }
    }
/*************************************************** Setters ******************************************************/
      public function setPostID($postID)
      {
        $this->PostID=$postID;
      }
      public function setUserID($userID)
      {
        $this->UserID=$userID;
      }
      public function setName($name)
      {
        $this->Name=$name;
      }
      public function setPic($PIC)
      {
        $this->Pic=$PIC;
      }
      public function setFindingPlace($findingPlace)
      {
        $this->FindingPlace=$findingPlace;
      }
      public function setFindingDate($findingDate)
      {
        $this->FindingDate=$findingDate;
      }
      public function setConFinding($conFinding)
      {
        $this->ConFinding=$conFinding;
      }
      public function setContactInfo($contactInfo)
      {
        $this->ContactInfo=$contactInfo;
      }
      public function setReportNum($reportNum)
      {
        $this->ReportNum=$reportNum;
      }
/************************************************ End of setters ***************************************************/

    
/**************************************************** Getters ******************************************************/
      public function getPostID()
      {
        return $this->PostID;
      }
      public function getUserID()
      {
        return $this->UserID;
      }
      public function getName()
      {
        return $this->Name;
      }
      public function getPic()
      {
        return $this->Pic;
      }
      public function getFindingPlace()
      {
        return $this->FindingPlace;
      }
      public function getFindingDate()
      {
        return $this->FindingDate;
      }
      public function getConFinding()
      {
        return $this->ConFinding;
      }
      public function getContactInfo()
      {
        return $this->ContactInfo;
      }
      public function getReportNum()
      {
        return $this->ReportNum;
      }
/**************************************************** End of Getters ***************************************************/    
}
?>