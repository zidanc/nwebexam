<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=files";
$pdo=new PDO($dsn,"root","");
date_default_timezone_set("Asia/Taipei");
session_start();

function all($table,...$arg){
  global $pdo;
  $sql="select * from $table ";

  if(isset($arg[0]) && is_array($arg[0])){
    
    $tmp=[];
    foreach($arg[0] as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }

    $sql=$sql. " where " .join(" && ",$tmp);
  }

  if(isset($arg[1])){
    $sql=$sql . $sql[1];
  }

  // echo $sql;
  return $pdo->query($sql)->fetchAll();
}




function del($table,$arg){
  global $pdo;
  $sql="delete from $table ";
  
  if(is_array($arg)){
    $tmp=[];
    foreach($arg as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql. " where " .join(" && ",$tmp);
  
  }else{
    $sql=$sql . " where `id`='$arg'";
  }

  // echo $sql;
  return $pdo->exec($sql);
}



function find($table,$arg){
  global $pdo;
  $sql="select * from $table ";
  
  if(is_array($arg)){
    $tmp=[];
    foreach($arg as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }

    $sql=$sql. " where " .join(" && ",$tmp);
  }else{
    $sql=$sql. " where `id`='$arg'";
  }
  // echo $sql;
  return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}


function nums($table,...$arg){
  global $pdo;
  $sql="select count(*) from $table ";
  
  if(isset($arg[0]) && is_array($arg[0])){
    $tmp=[];
    foreach($arg[0] as $key => $value){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
    }
    $sql=$sql . " where " . join(" && ",$tmp);
  }

  if(isset($arg[1])){
    $sql=$sql. $arg[1];
  }
  // echo $sql;
  return $pdo->query($sql)->fetchColumn();
}



function q($sql){
  global $pdo;

  return $pdo->query($sql)->fetchAll();
}



function save($table,$arg){
  global $pdo;
  //update
  if(isset($arg['id'])){
    $tmp=[];
    foreach($arg as $key => $value){
      if($key!='id'){
      $tmp[]=sprintf("`%s`='%s'",$key,$value);
      }
    }
    $sql="update $table set ". join(",",$tmp) . " where `id`='" . $arg['id']."'";
  }else{
  //insert
    $sql="insert into $table (`" . join("`,`",array_keys($arg))."`) values ('". join("','",$arg) ."')";
  }
  // echo $sql;
  return $pdo->exec($sql);
}


function to($url){
  header("location:".$url);
}



// ※架構：
// all:...$arg。 第三個變數：if(isset($arg[1])){  $sql=$sql . $sql[1];  }。｜query($sql)->fetchAll();
// nums:...$arg。 同上。｜ query($sql)->fetchColumn();
// find:$arg。僅需判斷是否為陣列，不是就" where `id`='$arg'"; ｜ query($sql)->fetch(PDO::FETCH_ASSOC);
// del:$arg。僅需判斷是否為陣列，不是就" where `id`='$arg'"; ｜ exec($sql);
// save:判斷變數有無id，若是有id，foreach時記得先排除id再格式化sprintf存入陣列。 ｜ exec($sql);

?>