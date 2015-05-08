<?php include('D:/xampp/htdocs/tms/header.php');?>
<form action='cms.php' method='get'>
<input type='hidden' name='name' value='test'/>
<input type='hidden' name='file' value='test'/>
<input type='hidden' name='module' value='test'/>
<input type='hidden' name='act' value='save'/>
<div class='module-form' data-name='test'>
<h1>测试页面1</h1>
<table>
<caption>链接测试</caption>
<tr>
<th>链接地址(url)</th>
<th>连接名称(text)</th>
</tr>
<tr>
<td><input type='text' name='test[link][href]' value='http://www.baidu.com'/></td>
<td><input type='text' name='test[link][text]' value='百度首页2'/></td>
</tr>
</table>
<table>
<caption>链接测试2</caption>
<tr>
<th>链接地址(url)</th>
<th>连接名称(text)</th>
</tr>
<tr>
<td><input type='text' name='test[link2][href]' value='http://www.google.com'/></td>
<td><input type='text' name='test[link2][text]' value='谷歌首页'/></td>
</tr>
</table>
<button type='submit'>保存</button>
</div>
</form>
<?php include('D:/xampp/htdocs/tms/footer.php');?>