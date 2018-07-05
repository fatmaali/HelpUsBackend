<?php
require_once '../Controller/QueryBuilder.php';

/*

Names:-

 userID
 fullname'
 username
 email
 DOB
 gender
 password1
 password2
 usertype
 dob
                      

*/


$UserObj = new User(NULL);
//$UserObj->setID($_REQUEST['userID']);
$UserObj->setUsername($_REQUEST['username']);
$UserObj->setEmail($_REQUEST['email']);
$UserObj->setFullname($_REQUEST['fullname']);
$UserObj->setGender($_REQUEST['gender']);
$UserObj->setPassword(sha1($_REQUEST['password1']));
$UserObj->setUserTypeID($_REQUEST['usertype']);
$UserObj->setDOB($_REQUEST['dob']);

//echo var_dump($UserObj);


if(!empty($_REQUEST['fullname'])&&!empty($_REQUEST['username'])&&!empty($_REQUEST['email'])&&!empty($_REQUEST['dob'])&&!empty($_REQUEST['gender'])&&!empty($_REQUEST['usertype'])&&!empty($_REQUEST['password1'])&&!empty($_REQUEST['password2']))
{
	

$p1=$_REQUEST['password1'];
$p2=$_REQUEST['password2'];
	



if($p1 == $p2 && strlen($p1)>=8 &&($_REQUEST['usertype']=='1' || $_REQUEST['usertype']=='2'))
{  
   
	$flag = User::Register($UserObj);
	if($flag)
	{
		
	        $toJson= array(
                        //'userID' => $_REQUEST['userID'],
                        'fullname' => $_REQUEST['fullname'],
                        'username' => $_REQUEST['username'],
                        'email' => $_REQUEST['email'],
                        'DOB'  => $_REQUEST['dob'],
                        'gender' => $_REQUEST['gender'],
                        'password' => sha1($_REQUEST['password1']),
                        'usertype' => $_REQUEST['usertype'],
                        'signup' => "successful"
                        );
		 $json = json_encode($toJson);
		 echo $json;
	}
	else 
	  {  $toJson= array('signup' => "unsuccessful");
	    $json = json_encode($toJson);
		 echo $json;
	  }
}

else
	  {  $toJson= array('signup' => "password doen't match or invalid password");
	    $json = json_encode($toJson);
		 echo $json;
	  }
		   
}
else
{
	 $toJson= array('signup' => "empty field");
	    $json = json_encode($toJson);
		 echo $json;
}

?>