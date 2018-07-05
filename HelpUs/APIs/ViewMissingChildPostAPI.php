<?php

require_once '../Controller/QueryBuilder.php';

/*
postID
*/


$queryObj= new QueryBuilder;





if(!empty($_REQUEST['postID']))
{ 
 $postObj= new MissingChildPost( $_REQUEST['postID']);
 
	
	$toJson=array(
	'UserID' => $postObj->getUserID(),
	'PostID' => $postObj->getPostID(),
    'Picture' => $postObj->getPic(),
    'Area' =>  $postObj->getArea(),
    'City' => $postObj->getCity() ,
    'MissingDate' =>  $postObj->getMissingData(),
    'Name' =>  $postObj->getName(),
    'Height' => $postObj->getHeight() ,
    'Weight' =>  $postObj->getWeight(),
    'Gender' =>  $postObj->getGender(),
    'EyeColor' => $postObj->getEyeColor() ,
    'Hair' => $postObj->getHairColor() ,
    'DateOfBirth' => $postObj->getDOB() ,
    'Age' =>  $postObj->getAge(),
    'PhoneNumber' =>   $postObj->getPhoneNo(),
    'AnotherPhone' =>  $postObj->getAnotherPNo(),
    'FBlink' =>  $postObj->getFbLink(),
    'Email' =>   $postObj->getEmail(),
    'ReportNumber' =>  $postObj->getReportNum() ,
    'ViewPosts'=>"Successful"

	);
	
	$json2 = json_encode($toJson);
	echo $json2;

}

else
{
	
	     $toJson= array('View Post' => "unsuccessful" );
		 $json2 = json_encode($toJson);
		 echo $json2;
	
}

?>