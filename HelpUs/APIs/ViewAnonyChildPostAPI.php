<?php
require_once '../Controller/QueryBuilder.php';

/*
postID
*/


$queryObj= new QueryBuilder;





if(!empty($_REQUEST['postID']))
{ 
 $postObj= new AnonymousPost( $_REQUEST['postID']);
 
	
	$toJson=array(
	'PostID' => $postObj->getID(),
	'UserID' => $postObj->getUserID(),
	'Picture' => $postObj->getPic()  ,
    'Name' => $postObj->getName() ,
    'FindingPlace' =>$postObj->getFindingPlace() ,
    'FindingDate' =>$postObj->getFindingDate() ,
    'Description' =>  $postObj->getConFinding() ,
    'ContactInfo' => $postObj->getContactInfo() ,
    'ReportNumber' => $postObj->getReportNym(),
    'ViewPost'=>"Successful"

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