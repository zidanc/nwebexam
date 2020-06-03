<?php

include_once "../base.php";

$title=new DB('title');

if(!empty($_FILES['img']['tmp_name'])){
  // echo "<pre>";print_r($_FILES);"</pre>";
  $filename=$_FILES['img']['name'];
  move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$filename);
}

$text=$_POST['text'];
$sh=0;

$title->save(['text'=>$text,'img'=>$filename,'sh'=>$sh]);

to("../admin.php?do=title");



?>