<?php
require_once 'DBConnection.php';
class MissingChildPost {
    
    private $PostID;
    private $UserID;
    private $Pic;
    private $City;
    private $Area;
    private $MissingDate;
    private $Name;
    private $Gender;
    private $Height;
    private $Weight;
    private $EyeColor;
    private $HairColor;
    private $DOB;
    private $Age;
    private $PhoneNo;
    private $AnotherPNo;
    private $Email;
    private $FbLink;
    private $ReportNum;

    function __construct($id){
        if($id != ""){
            $DBConn=new Connection;
            $sql="select * from missing_child_post where postID=$id";
            $res= $DBConn->Conn->query($sql);

            foreach($res as $rows){
                $this->PostID=$rows['postID'];
                $this->UserID=$rows['userID'];
                $this->Pic=$rows['pic'];
                $this->Area= $rows['city'];
                $this->City= $rows['area'];
                $this->MissingDate= $rows['missing_date'];
                $this->Name= $rows['name'];
                $this->Gender= $rows['gender'];
                $this->Height= $rows['height'];
                $this->Weight= $rows['weight'];
                $this->EyeColor= $rows['eye_color'];
                $this->HairColor= $rows['hair_color'];
                $this->DOB= $rows['dob'];
                $this->Age= $rows['age'];
                $this->PhoneNo= $rows['phone_no'];
                $this->AnotherPNo= $rows['another_pno'];
                $this->Email= $rows['email'];
                $this->FbLink= $rows['fb_link'];
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
      public function setPic($PIC)
      {
        $this->Pic=$PIC;
      }
      public function setCity($city)
      {
        $this->City=$city;
      }
      public function setArea($area)
      {
        $this->Area=$area;
      }
      public function setMissingDate($missingDate)
      {
        $this->MissingDate=$missingDate;
      }
      public function setName($name)
      {
        $this->Name=$name;
      }
      public function setGender($gender)
      {
        $this->Gendere=$gender;
      }
      public function setHeight($height)
      {
        $this->Height=$height;
      }
      public function setWeight($weight)
      {
        $this->Weight=$weight;
      }
      public function setEyeColor($eyeColor)
      {
        $this->EyeColor=$eyeColor;
      }
      public function setHairColor($hairColor)
      {
        $this->HairColor=$hairColor;
      }
      public function setDOB($dob)
      {
        $this->DOB=$dob;
      }
      public function setAge($age)
      {
        $this->Age=$age;
      }
      public function setPhoneNo($phoneNo)
      {
        $this->PhoneNo=$phoneNo;
      }
      public function setAnotherPNo($anotherPNo)
      {
        $this->AnotherPNo=$anotherPNo;
      }
      public function setEmail($email)
      {
        $this->Email=$email;
      }
      public function setFbLink($fbLink)
      {
        $this->FbLink=$fbLink;
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
      public function getPic()
      {
        return $this->Pic;
      }
      public function getCity()
      {
        return $this->City;
      }
      public function getArea()
      {
        return $this->Area;
      }
      public function getMissingDate()
      {
        return $this->MissingDate;
      }
      public function getName()
      {
        return $this->Name;
      }
      public function getGender()
      {
        return $this->Gender;
      }
      public function getHeight()
      {
        return $this->Height;
      }
      public function getWeight()
      {
        return $this->Weight;
      }
      public function getEyeColor()
      {
        return $this->EyeColor;
      }
      public function getHairColor()
      {
        return $this->HairColor;
      }
      public function getDOB()
      {
        return $this->DOB;
      }
      public function getAge()
      {
        return $this->Age;
      }
      public function getPhoneNo()
      {
        return $this->PhoneNo;
      }
      public function getAnotherPNo()
      {
        return $this->AnotherPNo;
      }
      public function getEmail()
      {
        return $this->Email;
      }
      public function getFbLink()
      {
        return $this->FbLink;
      }
      public function getReportNum()
      {
        return $this->ReportNum;
      }
/**************************************************** End of Getters ***************************************************/    
}
?>