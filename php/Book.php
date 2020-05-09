<?php

class Book{
    
   public $id;
   public $title;
   public $content = "";
   public $dateModified;
   public $size;
   
    public function __construct($idetifier,$title,$dateModified,$size) {
     
       $this->id=$idetifier;
       $this->title=$title;
       $this->dateModified=$dateModified;
       $this->size=$size;
   }
   
   public function printInfoBook()
   {
       echo $this->id." :: ".$this->title." ( ".strval($this->dateModified)." ) [".strval($this->size)."]";
       echo "<br>";
       
   }
    
    
}

?>

