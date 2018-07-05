<?php
require_once '../Controller/QueryBuilder.php';

/*
Names :

userID
postID
finding_place
finding_date
Description
contactInfo

*/

$queryObj= new QueryBuilder;
$userID= $_REQUEST['userID'];

$reportObj=new Report(NULL);
$reportObj->setUserID($_REQUEST['userID']);
$reportObj->setPostID($_REQUEST['postID']);
$reportObj->setWhereFind($_REQUEST['finding_place']);
$reportObj->setWhenDate($_REQUEST['finding_date']);
$reportObj->setDesOfChild($_REQUEST['Description']);
$reportObj->setContact($_REQUEST['contactInfo']);

                        

if(!empty($_REQUEST['postID'])&& !empty($_REQUEST['finding_place'])&& !empty($_REQUEST['finding_date'])&& !empty($_REQUEST['Description']) && !empty($userID))
{     
       $toJson= array(
                   
                    'Make sighting report' => "Successful!"
                    );
                    
                    
                   
     $json2 = json_encode($toJson);
     echo $json2;
    
}
else
{
	 $toJson= array(
                
                    'Make sighting report ' => "unSuccessful!"
                    );
                    
                    
                   
     $json2 = json_encode($toJson);
     echo $json2;
	
}
?>