<?php

  date_default_timezone_set("Asia/Taipei");
  session_start();

class DB{
//設定屬性
  private $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
  private $root="root";
  private $password="";
  private $table;
  private $pdo;

//$this是指現在此class(類別)的DB。
//設定建構式，第16行的$table變數，因為第16行還沒執行，所以可以取一樣的變數名稱，但其實第16行和第11行是不同的。16行與17行的$table才是相同的。
  public function __construct($table){
    $this->table=$table;    //$this->table就是第11行先宣告的變數。意指將DB裡的table設定成外部公開__construct($table)帶進來的$table名稱。帶進來的$table名稱設定給此資料表名稱$this->table後，就可以將剛才建立DB專用連線的物件、屬性、成員、方法及PDO連線，拿來運用在帶進來的$table名稱。
    $this->pdo=new PDO($this->dsn,$this->root,$this->password);
        
  }

    //取得全部資料
      public function all(...$arg){
        $sql="select * from $this->table ";
      
        if(!empty($arg[0]) && is_array($arg[0])) {
          foreach($arg[0] as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
          }
          $sql=$sql. " where " . join(" && ",$tmp);
        }
      
        if(!empty($arg[1])){
          $sql=$sql.$arg[1];
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetchAll();
      }
    
    
    //取得單筆資料
    public function find($arg){
      $sql="select * from $this->table ";
      //因為是明確要取特定條件的單筆，所以跟all Func相比，find的第一個變數一定不能為空，所以不用判斷empty。
      if(is_array($arg)) {
        foreach($arg as $key => $value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql. " where " . join(" && ",$tmp);
      }else{
        $sql=$sql. " where `id`='$arg'";
      }
    
      // echo $sql;
      return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    //計算筆數，正常function是不應該再取名count，因為php系統本身就有內建此函數名稱。
    // 但因為我們改存在class類別中，所以不會衝突。
    //當然，你也可以改回原生base.php檔案，我們慣用的計算筆數函式名稱"nums"。
    public function count(...$arg){
      $sql="select count(*) from $this->table ";
    
      if(!empty($arg[0]) && is_array($arg[0])) {
        foreach($arg[0] as $key => $value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql. " where " . join(" && ",$tmp);
      }
    
      if(!empty($arg[1])){
        $sql=$sql.$arg[1];
      }
      // echo $sql;
      return $this->pdo->query($sql)->fetchColumn();
    }


    //新增與更新資料
      public function save($arg){
        if(!empty($arg['id'])){
          //更新
          //$sql="update $this->table set xxx=yyy where `id` = 'xxx'";
          foreach($arg as $key => $value){
            if($key!='id'){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
          }
          $sql="update $this->table set ".join(",",$tmp)." where `id`='".$arg['id']."'";
        }else{
          //新增
          //$sql="insert into $this->table (``,``,``) values('','','');
          $sql="insert into $this->table (`".join("`,`",array_keys($arg))."`) values('".join("','",$arg)."')";
        }
        return $this->pdo->exec($sql);
      }
    
    
    //刪除資料
    public function del($arg){
      $sql="delete from $this->table ";        //不要用delete *，否則所有後面所加的限制條件它都不管，直接把你整個資料表的全部資料刪掉。
    
      if(is_array($arg)) {
        foreach($arg as $key => $value){
          $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql. " where " . join(" && ",$tmp);
      }else{
        $sql=$sql. " where `id`='$arg'";
      }
    
      // echo $sql;
      return $this->pdo->exec($sql);    //如果用query，則是會得到null空集合。因為被影響(delete)的該筆已經被刪除了，所以回傳是沒資料的。
    }


    //萬用語法
    function q($sql){
     return $this->pdo->query($sql)->fetchAll();
    
    }


}


function to ($url){
  header("location:".$url);
}


?>