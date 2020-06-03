

<h3 style="text-align:center;">新增標題區圖片</h3>
<!-- 行內樣式style="text-align:center;"等同於class="cent" -->
<hr>
<form action="api/insert_title.php" method="post" enctype="multipart/form-data">
  <table style="width:80%;margin:auto;">
    <tr>
      <td style="text-align:right;">標題區圖片：</td>
      <td><input type="file" name="img"></td>
    </tr>
    <tr>
      <td style="text-align:right;">標題區替代文字：</td>
      <td><input type="text" name="text"></td>
    </tr>

  </table>

  <div style="width:100px;margin:auto;">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
  </div>
</form>

