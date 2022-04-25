<?php

// this function match a keyword in sql database if result more then 1 return size of result;
function check_exist($table_name, $column, $match_this)
{
  require "connect.php";
  $sql = $conn->prepare("SELECT * FROM $table_name WHERE $column = '$match_this'");
  try {
      $sql->execute();
      $result = $sql->fetchAll();
      return sizeof($result);
  } catch (\Throwable $th) {
      //throw $th;
  }
}
// this function also match a keyword in sql database if result more then 1 return row;
function check_exist_arr($table_name, $column, $value, $column2, $value2)
{
  require "connect.php";
  $sql = $conn->prepare("SELECT * FROM $table_name WHERE $column = '$value' AND BINARY $column2 = '$value2'");
  try {
      $sql->execute();
      $result = $sql->fetchAll();
      return $result;
  } catch (\Throwable $th) {
    return "no data found";
      //throw $th;
  }
}


?>