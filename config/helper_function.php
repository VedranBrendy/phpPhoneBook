<?php 

function numForm($num){

  //check first occurrence of digit 9, if is 9 number is mobile
  $mob = strpos($num, "9").'<br>';
  //check first occurrence of digit 1, if is true number is in Zagreb region
  $fix = strpos($num, "1").'<br>';

  /* For mobile phone with 10 digits */
  if(strlen($num) == 10){

    $first_three_num = substr($num, 0,3);
    $second_three_num = substr($num, 3,3);
    $rest = substr($num,6,5);

    return $first_three_num." - ".$second_three_num." - ".$rest;
  
  /* For mobile phone with 9 digits */
  } elseif(strlen($num) == 9 && $mob == 1){

    $first_three_num = substr($num, 0,3);
    $second_three_num = substr($num, 3,3);
    $rest = substr($num,6,4);

    return $first_three_num." - ".$second_three_num." - ".$rest;

  /* For fixsed phone with 9 digits*/
  } elseif(strlen($num) == 9 && $fix != 1){

    $first_three_num = substr($num, 0,3);
    $second_three_num = substr($num, 3,3);
    $rest = substr($num, 6,3);

    return $first_three_num." - ".$second_three_num." - ".$rest;

  /* For fixsed phone with 9 digits*/
  } elseif(strlen($num) == 9){
    $first_three_num = substr($num, 0,2);
    $second_three_num = substr($num, 2,3);
    $rest = substr($num, 5,4);

    return $first_three_num." - ".$second_three_num." - ".$rest; 

  }
}


?>