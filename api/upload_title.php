<?php
include_once "../base.php";

$title=new DB('title');
$row=$title->find($_POST['id']);
if(!empty($_FILES['img']['tmp_name'])){
  $filename=$_FILES['img']['name'];
  move_uploaded_file($_FILES['img']['tmp_name'],'../img/'.$filename);
  $row['img']=$filename;
  $title->save($row);
  
  // $row->save();
}

/* $title=new DB('title');
if(!empty($_FILES['img']['tmp_name'])){
    $filename=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$filename);
}
$text=$_POST['text'];
$sh=0;
$title->save(['text'=>$text,'img'=>$filename,'sh'=>$sh]);
*/
to("../admin.php?do=title");
?>