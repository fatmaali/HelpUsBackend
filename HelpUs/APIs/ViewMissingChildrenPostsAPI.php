<?php
require_once '../Controller/QueryBuilder.php';

$queryObj= new QueryBuilder;

if(!empty($_REQUEST['UserID']))  // if no continue in posts without login=]\
 {
 	 
  
	$User= new User($_REQUEST['UserID']);
 	$Result=$queryObj->SelectAllMissChildPost();

	if(!empty($Result))
	{
			
	
	  $toJson=array();	   //create array 
      foreach($Result as $res)
      {
      
	$postObj= new MissingChildPost($res->getPostID());
	array_push($toJson,array(
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
	)
	);
	

	
     }
     	
   }
   else{
   	$toJson=array('View Posts' => 'No posts Found');
   	
   }
   $json2 = json_encode($toJson);
	echo $json2;
}


else
{

	     $toJson= array( 'View all posts ' => "unsuccessful , need login" );
		 $json2 = json_encode($toJson);
		 echo $json2;

}


?>