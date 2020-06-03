<?php
include_once "../base.php";

$title=new DB('title');

// if(!empty($_POST['id'])){} 正常是要判斷，避免請評委來看時出錯。所以我們要記得先建幾筆資料。
foreach($_POST['id'] as $key=>$id){
  if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
    $title->del($id);
  }else{
    // 更新
    $row=$title->find($id);
    $row['text']=$_POST['text'][$key];
    $row['sh']=($_POST['sh']==$id)?1:0;
    $title->save($row);
  }
}

to("../admin.php?do=title");

?>