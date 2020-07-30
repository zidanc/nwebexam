<?php

include_once "base.php";

$total=new DB('total');


?>

<!-- 因為all()出來是個陣列，所以用<pre></pre>來排版會比較好判讀。 -->
  <?php 
    echo "<pre>";print_r($total->all());"</pre>";    // $total用箭頭符號代入到base.php內，幫我執行all()這個程式。
    echo "<hr>";
    echo "<pre>";print_r($total->all(['id'=>2]));"</pre>";
    echo "<hr>(三)";
    echo "<pre>";print_r($total->all([]," order by id DESC"));"</pre>";  //如果只要執行all Func的第二個if ($arg[0]不是陣列，直接就是一個字串-限制條件)，記得前方要加" [] "，這樣才能將限制條件的語句加到$sql語法中。不然，它就只會跑第一句$sql="select * from $this->table ";因此降冪排列的限制條件根本不會幫你加入到語法中。
    echo "<hr>(四)下方此為錯誤的排序呈現";
    echo "<pre>";print_r($total->all(" order by id DESC"));"</pre>";  //會出錯，理由如上。不然base.php中的all Func的第一個if要加else{ $sql=$sql.$arg[0]; }
    echo "<hr>";
    echo "測試count";
    echo "<pre>";print_r($total->count());"</pre>";
    echo "<hr>測試find";
    echo "<pre>";print_r($total->find(['id'=>2]));"</pre>";
    echo "<hr>測試save-update";
    // echo "<pre>";print_r($total->save(['total'=>300]));"</pre>";  //total此為欄位名稱。
    echo "<hr>測試save-insert";
    echo "<pre>";print_r($total->save(['id'=>3,'total'=>400]));"</pre>";  //total此為欄位名稱。
    echo "<hr>測試delete";
    echo "<pre>";print_r($total->del(['total'=>300]));"</pre>"; 
   ?>