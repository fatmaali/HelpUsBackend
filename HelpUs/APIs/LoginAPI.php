<?php
require_once '../Controller/QueryBuilder.php';
/*
Names:-

email
password


*/

$UserObj = new User(NULL);
$UserObj->setUserEmail($_REQUEST['email']);
$UserObj->setUserPassword(sha1($_REQUEST['password']));

$queryObj = new QueryBuilder;

$res=User::login($UserObj);
$queryObj = new QueryBuilder;
if(!empty($res))
{   
		
	
		$Json=array(
				'logedin'=>"successful",
				'UserID' => $res[0]->getID(),
				'Username' => $res[0]->getUsername(),
                'Fullname' => $res[0]->getFullname(),
                'Email' =>  $res[0]->getEmail(),
                'Gender' =>  $res[0]->getGender(),
                'DOB' =>  $res[0]->getDOB(),
                'Picture' => $res[0]->getPIC(),
                'UserType' =>$res[0]->getUserTypeID() ,
              
		);
		echo json_encode($Json);
	
}

else
{
		$Json=array(
			'logedin'=>"unsuccessful");
		echo json_encode($Json);
	
}
?>