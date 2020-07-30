<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">網站標題管理</p>
  <form method="post" action="?">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="45%">網站標題</td>
          <td width="23%">替代文字</td>
          <td width="7%">顯示</td>
          <td width="7%">刪除</td>
          <td></td>
        </tr>
        <?php
          $title=new DB('title');   //等號右手邊的title就是現在我要針對資料庫的title資料表動作。告訴DB class，請套用DB的物件帳密、屬性、方法、成員到現在title這個表格。
          $rows=$title->all();
          foreach($rows as $row){
              $isChk=($row['sh']==1)?'checked':'';
          
        ?>
        <tr>
          <td width="45%"><img src="./img/<?=$row['img'];?>" style="width:300px; height:30px;"></td>
          <td width="23%"> <input type="text" name="text[]" id="" value="<?=$row['text'];?>"></td>    <!-- 瀏覽器共同規範，若要儲存多筆，就在name屬性值改成陣列。name="要改成陣列，才可以儲存多筆。不然，都只會有一筆(當筆傳輸form表單的最後一筆)被寫入到資料庫" -->
          <td width="7%"> <input type="radio" name="sh" id="" value="<?=$row['id'];?>" <?=$isChk;?>> </td>       <!-- value不是用sh，而是id。因為到時候送回資料庫時，我們需要id，告訴資料表id多少，改成顯示/不顯示 -->
          <td width="7%"><input type="checkbox" name="del[]" id="" value="<?=$row['id'];?>"></td>     <!-- name="要改成陣列，才可以暫存多選del[]" -->
          <td><input type="button" value="更新圖片"> </td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=title&#39;)" value="新增網站標題圖片"></td>
          <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
        </tr>
      </tbody>
    </table>

  </form>
</div>