<?php
require_once '../Controller/QueryBuilder.php';

$queryObj= new QueryBuilder;

if(!empty($_REQUEST['UserID']))  // if no continue in posts without login=]\
 {
 	 
  
	$User= new User($_REQUEST['UserID']);
 	$Result=$queryObj->SelectAllAnonPost();

	if(!empty($Result))
	{
			

		
		
	  $toJson=array();	   //create array 
      foreach($Result as $res)
      {
      
	$postObj= new AnonymousPost($res->getPostID());
	array_push($toJson,array(
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

	     $toJson= array( 'View posts' => "unsuccessful , need login" );
		 $json2 = json_encode($toJson);
		 echo $json2;

}


?>