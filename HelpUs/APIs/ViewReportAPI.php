<?php
require_once '../Controller/QueryBuilder.php';

/*
postID
UserID
*/


$queryObj= new QueryBuilder;





if(!empty($_REQUEST['postID']))
{ 
 $postObj=  $queryObj->SelectReportByPUId($_REQUEST['postID'],$_REQUEST['userID']);
 
	
	$toJson=array(
	'ReportID' => $postObj->getReportID(),
	'PostID' => $postObj->getPostID(),
	'UserID' => $postObj->getUserID(),
    'FindingPlace' =>$postObj->getWhereFind() ,
    'FindingDate' =>$postObj->getWhenDate() ,
    'Description' =>  $postObj->getDesOfChild() ,
    'ContactInfo' => $postObj->getContact() ,

    'ViewReport'=>"Successful"

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