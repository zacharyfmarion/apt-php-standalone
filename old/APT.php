<?php

class APT{

  /*
   * Function to read grade info from an html file using a DOMDocument
  */
  // static function getInfo($text){
  //   // creating a dom object to load html
  //   $DOM = new DOMDocument;
  //   $DOM->loadHTML($text);
  //
  //   // Not sure what format the file is in right now...
  //   $studentId = $DOM->getElementById('student-id')->textContent;
  //   $questionId = $DOM->getElementById('question-id')->textContent;
  //   $grade = $DOM->getElementById('grade')->textContent;
  //
  //   echo($studentId.", ".$grade);
  //
  //   return array($studentId, $questionId, $grade);
  // }

  /*
   * Functions to parse the HTML file with regular expressions (because APT output sucks)
  */
  static function getGrade($text){
    $pattern = '/<!--PERC:([0-9\.]+) -->/';
    return floatval(self::regexFind($text, $pattern));

  }

  static function getProblem($text){
    $pattern = '/<b>Problem<\/b>: (.*)<br>/';
    return self::regexFind($text, $pattern);
  }

  static function getUser($text){
    $pattern = '/<p>user is: (.*)<\/p>/';
    return self::regexFind($text, $pattern);
  }

  /*
   * Helper function to get the first capture
   * group of a regex search
  */
  static function regexFind($text, $pattern){
    preg_match($pattern, $text, $matches);
    return $matches[1];
  }

}

?>
