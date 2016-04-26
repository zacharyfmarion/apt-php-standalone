<?php

use \Tsugi\Util\LTIX;

class parsegrade {

  private $id;
  private $question;
  private $grade;

  # Constructor function
  function __construct($id, $question, $grade){
    $this->id = $id;
    $this->grade = $grade;
    $this->question = $question;
  }

  public function test(){
    echo("Testing, id = ".$this->id.", question = ".$this->question.", grade = ".$this->grade.".");
  }

  public static function staticTest(){
    echo("This is a static test");
  }

}

?>
