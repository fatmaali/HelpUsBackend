<?php
require_once '../Controller/QueryBuilder.php';
//$platForm =$_REQUEST['platform'];


/*
Names:-


userID
pic
area
city
missing_date
name
height
weight
eye_color
hair_color
dob
age
gender
email
phoneno
anotherno
fb
report_num
*/



$queryObj= new QueryBuilder;
$userID= $_REQUEST['userID'];

$PostObj=new MissingChildPost(NULL);
$PostObj->setPic($_REQUEST['pic']);
$PostObj->setUserID($_REQUEST['userID']);
$PostObj->setArea($_REQUEST['area']);
$PostObj->setCity($_REQUEST['city']);
$PostObj->setMissingDate($_REQUEST['missing_date']);
$PostObj->setName($_REQUEST['name']);
$PostObj->setHeight($_REQUEST['height']);
$PostObj->setWeight($_REQUEST['weight']);
$PostObj->setEyeColor($_REQUEST['eye_color']);
$PostObj->setHairColor($_REQUEST['hair_color']);
$PostObj->setDOB($_REQUEST['dob']);
$PostObj->setAge($_REQUEST['age']);
$PostObj->setGender($_REQUEST['gender']);
$PostObj->setEmail($_REQUEST['email']);
$PostObj->setPhoneNo($_REQUEST['phoneno']);
$PostObj->setAnotherPNo($_REQUEST['anotherno']);
$PostObj->setFbLink($_REQUEST['fb']);
$PostObj->setReportNum($_REQUEST['report_num']);
$queryObj->AddMissChildPost($PostObj);


if(!empty($_REQUEST['pic'])&& !empty($_REQUEST['name']) && !empty($_REQUEST['height']) && !empty($_REQUEST['weight']) && !empty($_REQUEST['eye_color']) && !empty($_REQUEST['hair_color'])  && !empty($_REQUEST['age']) && !empty($userID))
{
        $toJson= array(
        
                    'UserID' => $_REQUEST['userID'],
                    'Picture' => $_REQUEST['pic'],
                    'Area' => $_REQUEST['area'],
                    'City' => $_REQUEST['city'],
                    'MissingDate' => $_REQUEST['missing_date'],
                    'Name' => $_REQUEST['name'],
                    'Height' => $_REQUEST['height'],
                    'Weight' => $_REQUEST['weight'],
                    'Gender' => $_REQUEST['gender'],
                    'EyeColor' => $_REQUEST['eye_color'],
                    'Hair' => $_REQUEST['hair_color'],
                    'DateOfBirth' => $_REQUEST['dob'],
                    'Age' => $_REQUEST['age'],
                    'PhoneNumber' => $_REQUEST['phoneno'],
                    'AnotherPhone' => $_REQUEST['anotherno'],
                    'FBlink' => $_REQUEST['fb'],
                    'Email' => $_REQUEST['email'],
                    'ReportNumber' => $_REQUEST['report_num'],
                    'AddPost' => "Successful!"
                    );
     $json2 = json_encode($toJson);
     echo $json2;
    
}
?>