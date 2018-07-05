<?php
    require_once 'DBConnection.php';
    require_once 'User.php';
    require_once 'UserType.php';
    require_once 'Report.php';
    require_once 'Notification.php';
    require_once 'HelpingInstruction.php';
    require_once 'AnonPost.php';
    require_once 'MissingChildPost.php';

    class QueryBuilder extends Connection {
        
/*************************************************** User table ******************************************************/
    public function SelectUserByID($ID) // Select user by ID
    {
        $sql = "SELECT * FROM user WHERE ID='".$ID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new User($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
    
    public function SelectAdmins() // Select All admins
    {
        $sql = "SELECT * FROM user WHERE usertype_id='1'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new User($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }

    public function SelectUserByEmail($email) // Select user by Email 
    {
        $sql = "SELECT * FROM user WHERE email='".$email."'";
        $res = $this->Conn->prepare($sql); 
        $res->bindParam(1, $email);
        $res->execute();
        $result = $res->fetchAll();
        $i=0;       
        foreach($result as $rows)
        {
            $u=new User($rows['ID']);
            $result[$i]=$u;
            $i++;
        }
        return $result;
    }
        
    public function SelectUserByUsername($username) // Select user by Username
    {
        $sql = "SELECT * FROM user WHERE email='".$username."'";
        $res = $this->Conn->prepare($sql); 
        $res->bindParam(1, $username);
        $res->execute();
        $result = $res->fetchAll();
        $i=0;       
        foreach($result as $rows)
        {
            $u=new User($rows['ID']);
            $result[$i]=$u;
            $i++;
        }
        return $result;
    }
        
    public function selectByEmailOrUserName($name,$pass) // Select user by email or username
    {
        $s="SELECT * FROM user WHERE (email=? or username=?) and password=?";
        $res = $this->Conn->prepare($s); 
        $res->bindParam(1, $name);
        $res->bindParam(2, $name);
        $res->bindParam(3, $pass);
        $res->execute();
        $result = $res->fetchAll();
        $i=0;       
        foreach($result as $rows)
        {
            $u=new User($rows['ID']);
            $result[$i]=$u;
            $i++;
        }
        return $result;
    }
        
    static function isExist($email,$username) // Check if user exist or not
    {
        $DBObj = new Connection;
        $sql="SELECT * FROM user WHERE email=:email OR username= :name ";
        $res= $DBObj->Conn->prepare($sql);
        $res->execute(array( ':email' => $email ,':name' => $username));
        $result=$res->fetch();
        if(is_array($result) || is_object($result)){
            foreach($result as $rows){
                return TRUE; // Exist
            }
            return FALSE; // Not exist
        }   
    }

    public function AddUser($add) // Add user to database
    {
        $sql = "INSERT INTO user(`ID`, `username`, `email`, `password`, `fullname`, `gender`, `dob`, `profile_pic`,`usertype_id`) VALUES ('','".$add->getUsername

()."','".$add->getEmail()."','".$add->getPassword()."','".$add->getFullname()."','".$add->getGender()."','".$add->getDOB()."','".$add->getPIC()."','".$add-

>getUserTypeID()."')";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }

    public function UpdateUser($u) // Update all user information
    {
        $sql = "UPDATE user SET `ID`='',`username`='".$u->getUsername()."',`email`='".$u->getEmail()."',`password`='".$u->getPassword()."',`fullname`='".$u-

>getFullname()."',`gender`='".$u->getGender()."',`dob`='".$u->getDOB()."',`profile_pic`='".$u->getPIC()."',`usertype_id`='".$u->getUserTypeID()."' WHERE ID='".$u-

>getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }

    public function DeleteUser($ID) // Delete user
    {
        $sql = "DELETE FROM user WHERE ID='".$ID."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }

    public function UpdateUsername($u) // Update username
    {
        $sql = "UPDATE user SET `username`='".$u->getUsername()."' WHERE ID='".$u->getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }        

    public function UpdateEmail($u) // Update email
    {
        $sql = "UPDATE user SET `email`='".$u->getEmail()."' WHERE ID='".$u->getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function UpdatePass($u) // Update password
    {
        $sql = "UPDATE user SET `password`='".$u->getPassword()."' WHERE ID='".$u->getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function UpdateFullname($u) // Update fullname
    {
        $sql = "UPDATE user SET `fullname`='".$u->getFullname()."' WHERE ID='".$u->getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }

    public function UpdateGender($u) // Update gender
    {
        $sql = "UPDATE user SET `gender`='".$u->getGender()."' WHERE ID='".$u->getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function UpdateDOB($u) // Update DOB
    {
        $sql = "UPDATE user SET `dob`='".$u->getDOB()."' WHERE ID='".$u->getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }

    public function UpdatePIC($u) // Update profile picture
    {
        $sql = "UPDATE user SET `profile_pic`='".$u->getPIC()."' WHERE ID='".$u->getID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
/*********************************************** End of User table ***************************************************/
      
        
/************************************************* Report table ******************************************************/
    public function MakeReport($rep) // Make a report
    {   
        $sql = "INSERT INTO report(`ID`,`userID`,`postID`, `when_date`, `where_find`, `des_of_child`, `contact`) VALUES ('','".$rep->getUserID()."','".$rep->getPostID

()."','".$rep->getWhenDate()."','".$rep->getWhereFind()."','".$rep->getDesOfChild()."','".$rep->getContact()."')";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function SelectReport($ID) // Select a report by Report ID
    {
        $sql = "SELECT * FROM report WHERE ID='".$ID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new Report($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
         public function SelectReportByPUId($PID , $UID) // Select a report by Report ID
    {
        $sql = "SELECT * FROM report WHERE postID='".$PID."' AND userID='".$UID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new Report($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
    public function SelectReportByUserID($userID) // Select a report by user ID
    {
        $sql = "SELECT * FROM report WHERE userID='".$userID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new Report($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
    public function SelectReportByPostID($postID) // Select a report by post ID
    {
        $sql = "SELECT * FROM report WHERE postID='".$postID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new Report($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
    public function DeleteReport($ID) // Delete report
    {
        $sql = "DELETE FROM report WHERE ID='".$ID."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
/********************************************** End of Report table **************************************************/
       
        
/*********************************************** Notification table **************************************************/
    public function AddNotification($noti) // Add a notification
    {
        $sql = "INSERT INTO notification(`ID`,`postID`,`noti_from`, `noti_to`, `date`, `content`) VALUES ('','".$noti->getPostID()."','".$noti->getNotiFrom()."','".

$noti->getNotiTo()."','".$noti->getDate()."','".$noti->getContent()."')";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
        
    }
/******************************************* End of Notification table ***********************************************/
       
        
/******************************************* HelpingInstruction table ************************************************/
    public function SelectAllHelpingInstruction($ID) // Select all helping instructions
    {
        $sql = "SELECT * FROM helping_instruction WHERE Confirmation=1";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new HelpingInstruction($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
    public function SelectHelpingInstruction($ID) // Select helping instruction by ID
    {
        $sql = "SELECT * FROM helping_instruction WHERE ID='".$ID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new HelpingInstruction($rows['ID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
    public function DeleteHelpingInstruction($ID) // Delete a helping instruction
    {
        $sql = "SELECT * FROM user WHERE usertype_id='1'";
        $res= $this->Conn->query($sql);
        if($res == true){
            $sql = "DELETE FROM helping_instruction WHERE ID='".$ID."'";
            
            $result=  $this->Conn->prepare($sql);
            $result->execute();
        } else {
            echo "Only admin who can delete a helping instruction.";
        }
    }

    public function SelectByCategory($category) // Select a helping instruction by category 
    {
        $sql = "SELECT * FROM helping_instruction WHERE category='".$category."'";
        $res = $this->Conn->prepare($sql); 
        $res->bindParam(1, $category);
        $res->execute();
        $result = $res->fetchAll();
        $i=0;       
        foreach($result as $rows)
        {
            $u=new HelpingInstruction($rows['ID']);
            $result[$i]=$u;
            $i++;
        }
        return $result;
    }
/*************************************** End of HelpingInstruction table *********************************************/
        
        
/********************************************* AnonymousPost table **************************************************/
    public function SelectAnonPost($Pid) // Select anonymous post
    {
        $sql = "SELECT * FROM anon_post WHERE postID='".$Pid."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new AnonymousPost($rows['postID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
    
    
     public function getPostIDByUserID($uid)
    {
        $sql = "SELECT MAX(postID) FROM anon_post WHERE userID=".$uid;
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {   $ID=$res;
            $ID=new AnonymousPost(
            $rows['MAX(postID)']);
            $Result[$i]=$ID;
            $i++;
        }
       // echo var_dump($Result[0]->getPostID());
       $pid=$Result[0]->getPostID()+0;
      // echo var_dump($pid);
        return $pid;
        
        
    }

public function getPicByUserID($uid)
    {
       $q= new QueryBuilder();
        $postid= $q->getPostIDByUserID($uid);
        //echo $postid;
        $sql = "SELECT pic FROM anon_post WHERE postID=".$postid;
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {   $ID=$res;
            $ID=new AnonymousPost($postid);
            $Result[$i]=$ID;
            $i++;
        }
       // echo var_dump($Result[0]->getPostID());
      // echo $pic=$Result[0]->getPic();
      // echo var_dump($pid);
        return $pic;
        
        
    }

    public function enrollFace()
    {
$queryUrl = "https://api.kairos.com/enroll";
$rec = "https://api.kairos.com/recognize";

     //   $queryUrl = "https://api.kairos.com/recognize";



$path = '12.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
//echo $data;
$imageObject = '{"image": "' .$base64. '","subject_id":"5","gallery_name":"frist"}';

//echo $imageObject;
$APP_ID = "d63132f8";
$APP_KEY = "730ea2ac5dd2d841e03b3668b9a895b3";
 
$request = curl_init($queryUrl);

curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request,CURLOPT_POSTFIELDS, $imageObject);
curl_setopt($request, CURLOPT_HTTPHEADER, array(
        "Content-type: application/json",
        "app_id:d63132f8" ,
        "app_key:730ea2ac5dd2d841e03b3668b9a895b3" 
    )
);
//echo "string";
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($request);
// show the API response
//$s=json_decode($response);
$ar =json_decode($response, true);
// access first element of $ar array
echo $response;
//===========================================================================================
$imageObject = '{"image": "' .$base64. '","gallery_name":"frist"}';

//echo $imageObject;
$APP_ID = "d63132f8";
$APP_KEY = "730ea2ac5dd2d841e03b3668b9a895b3";
 
$request = curl_init($rec);


curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request,CURLOPT_POSTFIELDS, $imageObject);
curl_setopt($request, CURLOPT_HTTPHEADER, array(
        "Content-type: application/json",
        "app_id:d63132f8" ,
        "app_key:730ea2ac5dd2d841e03b3668b9a895b3" 
    )
);
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
$responsee = curl_exec($request);
//curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

$ar =json_decode($response, true);
// access first element of $ar array
//echo "rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr";

echo $responsee;
curl_close($request);

// access first element of $ar array
//echo $response;
    }

      public function UpdateConfirmation($uid) // Update report number
    {
        $q= new QueryBuilder();
        $postID= $q->getPostIDByUserID($uid);
        //echo $postID;
        $sql = "UPDATE anon_post SET Confirmation=1 WHERE postID='".$postID."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
    
    
     public function SelectAllAnonPost() // Select all anonymous post
    {
    $DBObj = new Connection;
    $sql="SELECT * FROM anon_post ";
    $res= $DBObj->Conn->prepare($sql);
    $res->execute();
    $result=$res->fetchAll();
     $i=0;
     $Result2;
    foreach($result as $rows)
    {
        $postObj=new AnonymousPost($rows['postID']);
        $Result2[$i]=$postObj;
        $i++;
    
    }
    return $Result2;    
        
    }
        
    public function AddAnonPost($anon) // Add anonymous post
    {
        $sql = "INSERT INTO anon_post(`postID`, `userID`, `name`, `pic`, `finding_place`, `finding_date`, `con_finding`, `contact_info`, `report_num`) VALUES ('','".

$anon->getUserID()."','".$anon->getName()."','".$anon->getPic()."','".$anon->getFindingPlace()."','".$anon->getFindingDate()."','".$anon->getConFinding()."','".$anon-

>getContactInfo()."','".$anon->getReportNum()."')";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function DeleteAnonPost($ID) // Delete anonymous post
    {
        $sql = "DELETE FROM anon_post WHERE postID='".$ID."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function UpdateAnonPost($u) // Update anonymous post
    {
        $sql = "UPDATE anon_post SET `postID`='',`userID`='".$anon->getUserID()."',`name`='".$anon->getName()."',`pic`='".$anon->getPic()."',`finding_place`='".$u-

>getFindingPlace()."',`finding_date`='".$u->getFindingDate()."',`con_finding`='".$u->getConFinding()."',`contact_info`='".$anon->getContactInfo()."',`report_num`='".

$u->getReportNum()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function UpdateAnonReportNum($u) // Update report number
    {
        $sql = "UPDATE anon_post SET `report_num`='".$u->getReportNum()."' WHERE postID='".$u->getPostID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function SearchAnonPost($term) // Search of anonymous posts
    {
        if (strlen($term) < 2) {
            return null;
        } else {
            $term = '%' . $term . '%';
            $stmt = $dbh->prepare("SELECT * FROM anon_post WHERE name LIKE :term");
            $stmt->bindParam(':term', $term, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
        }
    }
/******************************************* End of anonymousPost table *********************************************/
        
        
/******************************************** MissingChildPost table *************************************************/
    public function SelectAllMissChildPost() // Select all missing child post
    {
        $sql = "SELECT * FROM missing_child_post";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new MissingChildPost($rows['postID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
    public function SelectMissChildByPostID($postID) // Select missing child post by post ID
    {
        $sql = "SELECT * FROM missing_child_post WHERE postID='".$postID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new MissingChildPost($rows['postID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
    public function SelectMissChildByUserID($userID) // Select missing child post by user ID
    {
        $sql = "SELECT * FROM missing_child_post WHERE userID='".$userID."'";
        $res= $this->Conn->query($sql);
        $i=0;
        $Result;
        
        foreach($res as $rows)
        {
            $ID=new MissingChildPost($rows['postID']);
            $Result[$i]=$ID;
            $i++;
        }
        return $Result;
    }
        
    public function SelectMissChildByCity($city) // Select missing child post by city 
    {
        $sql = "SELECT * FROM missing_child_post WHERE city='".$city."'";
        $res = $this->Conn->prepare($sql); 
        $res->bindParam(1, $city);
        $res->execute();
        $result = $res->fetchAll();
        $i=0;       
        foreach($result as $rows)
        {
            $u=new MissingChildPost($rows['ID']);
            $result[$i]=$u;
            $i++;
        }
        return $result;
    }
        
    public function SelectMissChildByArea($area) // Select missing child post by area
    {
        $sql = "SELECT * FROM missing_child_post WHERE area='".$area."'";
        $res = $this->Conn->prepare($sql); 
        $res->bindParam(1, $area);
        $res->execute();
        $result = $res->fetchAll();
        $i=0;       
        foreach($result as $rows)
        {
            $u=new MissingChildPost($rows['ID']);
            $result[$i]=$u;
            $i++;
        }
        return $result;
    }
    
    public function SelectMissChildByGender($gender) // Select missing child post by gender 
    {
        $sql = "SELECT * FROM missing_child_post WHERE gender='".$gender."'";
        $res = $this->Conn->prepare($sql); 
        $res->bindParam(1, $gender);
        $res->execute();
        $result = $res->fetchAll();
        $i=0;       
        foreach($result as $rows)
        {
            $u=new MissingChildPost($rows['ID']);
            $result[$i]=$u;
            $i++;
        }
        return $result;
    }
        
    public function AddMissChildPost($miss) // Add missing child post
    {
        $sql = "INSERT INTO missing_child_post(`postID`, `userID`, `pic`, `city`, `area`, `missing_date`, `name`, `gender`, `height`, `weight`, `eye_color`, 

`hair_color`, `dob`, `age`, `phone_no`, `another_pno`, `email`, `fb_link`, `report_num`) VALUES ('','".$miss->getUserID()."','".$miss->getPic()."','".$miss->getCity

()."','".$miss->getArea()."','".$miss->getMissingDate()."','".$miss->getName()."','".$miss->getGender()."','".$miss->getHeight()."','".$miss->getWeight()."','".$miss-

>getEyeColor()."','".$miss->getHairColor()."','".$miss->getDOB()."','".$miss->getAge()."','".$miss->getPhoneNo()."','".$miss->getAnotherPNo()."','".$miss->getEmail

()."','".$miss->getFbLink()."','".$miss->getReportNum()."')";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function DeleteMissChildPost($ID) // Delete missing child post
    {
        $sql = "DELETE FROM missing_child_post WHERE postID='".$ID."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function UpdateMissChildPost($u) // Update missing child post
    {
        $sql = "UPDATE missing_child_post SET `postID`='',`pic`='".$u->getUserID()."', `pic`='".$u->getPic()."', `city`='".$u->getCity()."', `area`='".$u->getArea

()."', `missing_date`='".$u->getMissingDate()."', `name`='".$u->getName()."', `gender`='".$u->getGender()."', `height`='".$u->getHeight()."', `weight`='".$u-

>getWeight."', `eye_color`='".$u->getEyeColor()."', `hair_color`='".$u->getHairColor()."', `dob`='".$u->getDOB()."', `age`='".$u->getAge()."', `phone_no`='".$u-

>getPhoneNo()."', `another_pno`='".$u->getAnotherPNo()."', `email`='".$u->getEmail()."', `fb_link`='".$u->getFbLink()."', `report_num`='".$u->getReportNum()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }
        
    public function UpdateMissReportNum($u) // Update report number
    {
        $sql = "UPDATE missing_child_post SET `report_num`='".$u->getReportNum()."' WHERE postID='".$u->getPostID()."'";
        
        $result=  $this->Conn->prepare($sql);
        $result->execute();
    }

    public function SearchMissChildPost($term) // Search of missing child posts
    {
        if (strlen($term) < 2) {
            return null;
        } else {
            $term = '%' . $term . '%';
            $stmt = $dbh->prepare("SELECT * FROM missing_child_post WHERE name LIKE :term");
            $stmt->bindParam(':term', $term, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
        }
    }
/**************************************** End of MissingChildPost table **********************************************/
}


/************************************************* Test area *********************************************************/
$qObj = new QueryBuilder;

#$ReportObl = new Report(NULL);
#$ReportObl->setUserID("2");
#$ReportObl->setPostID("1");
#$ReportObl->setWhenDate("10/10/2018");
#$ReportObl->setWhereFind("test");
#$ReportObl->setDesOfChild("test");
#$ReportObl->setContact("test");
#$qObj->MakeReport($ReportObl);

#$UserObl = new User(NULL);
#$UserObl->setUsername("hazem");
#$UserObl->setEmail("hazem");
#$UserObl->setPassword("1");
#$UserObl->setFullname("hazem");
#$UserObl->setGender("Male");
#$qObj->AddUser($UserObl);

#echo var_dump($qObj->SelectReportByPostID(2));
#echo var_dump($qObj->DeleteAnonPost(1));
/********************************************** End of test area *****************************************************/
?>