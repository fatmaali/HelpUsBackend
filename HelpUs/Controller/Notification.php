<?php
require_once 'DBConnection.php';
class Notification {
    
    private $NotiID;
    private $PostID;
    private $NotiFrom;
    private $NotiTo;
    private $Date;
    private $Content;

    function __construct($id){
        if($id != ""){
            $DBConn=new Connection;
            $sql="select * from notification where ID=$id";
            $res= $DBConn->Conn->query($sql);

            foreach($res as $rows){
                $this->NotiID=$rows['ID'];
                $this->PostID=$rows['postID'];
                $this->NotiTo= $rows['noti_from'];
                $this->NotiFrom= $rows['noti_to'];
                $this->Date= $rows['date'];
                $this->Content= $rows['content'];
            }
        }
    }
/*************************************************** Setters ******************************************************/
      public function setNotiID($notiID)
      {
        $this->NotiID=$notiID;
      }
      public function setPostID($postID)
      {
        $this->PostID=$postID;
      }
      public function setNotiFrom($notiFrom)
      {
        $this->NotiFrom=$notiFrom;
      }
      public function setNotiTo($notiTo)
      {
        $this->NotiTo=$notiTo;
      }
      public function setDate($date)
      {
        $this->Date=$date;
      }
      public function setContent($content)
      {
        $this->Content=$content;
      }
/************************************************ End of setters ***************************************************/

    
/**************************************************** Getters ******************************************************/
      public function getNotiID()
      {
        return $this->NotiID;
      }
      public function getPostID()
      {
        return $this->PostID;
      }
      public function getNotiFrom()
      {
        return $this->NotiFrom;
      }
      public function getNotiTo()
      {
        return $this->NotiTo;
      }
      public function getDate()
      {
        return $this->Date;
      }
      public function getContent()
      {
        return $this->Content;
      }
/**************************************************** End of Getters ***************************************************/    
}
?>