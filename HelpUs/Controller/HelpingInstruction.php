<?php
require_once 'DBConnection.php';
class HelpingInstruction {
    
    private $ID;
    private $Category;
    private $Title;
    private $Content;

    function __construct($id){
        if($id != ""){
            $DBConn=new Connection;
            $sql="select * from helping_instruction where ID=$id";
            $res= $DBConn->Conn->query($sql);

            foreach($res as $rows){
                $this->ID=$rows['ID'];
                $this->Category= $rows['category'];
                $this->Title= $rows['title'];
                $this->Content= $rows['content'];
            }
        }
    }
/*************************************************** Setters ******************************************************/
      public function setID($notiID)
      {
        $this->ID=$notiID;
      }
      public function setCategory($category)
      {
        $this->Category=$category;
      }
      public function setTitle($title)
      {
        $this->Title=$title;
      }
      public function setContent($content)
      {
        $this->Content=$content;
      }
/************************************************ End of setters ***************************************************/

    
/**************************************************** Getters ******************************************************/
      public function getID()
      {
        return $this->ID;
      }
      public function getCategory()
      {
        return $this->Category;
      }
      public function getTitle()
      {
        return $this->Title;
      }
      public function getContent()
      {
        return $this->Content;
      }
/**************************************************** End of Getters ***************************************************/    
}
?>