<?php include('F:/www/cms/header.php');?>
<form action='cms.php' method='get'>
<input type='hidden' name='name' value='module2'/>
<input type='hidden' name='file' value='test'/>
<input type='hidden' name='module' value='module2'/>
<input type='hidden' name='act' value='save'/>
<div class='module-form' data-name='module2'>
<h1>王八蛋</h1>
<table>
<caption>图片测试</caption>
<tr>
<th>链接地址(url)</th>
<th>图片地址(url)</th>
<th>图片高度(text)</th>
<th>图片宽度(text)</th>
</tr>
<tr>
<td><input type='text' name='module2[img][href]' value='http://www.baidu.com'/></td>
<td><input type='text' name='module2[img][img]' value='http://dummyimage.com/300x300/e66/fff'/></td>
<td><input type='text' name='module2[img][height]' value='300'/></td>
<td><input type='text' name='module2[img][width]' value='300'/></td>
</tr>
</table>
<table>
<caption>图片测试2</caption>
<tr>
<th>链接地址(url)</th>
<th>图片地址(url)</th>
<th>图片高度(text)</th>
<th>图片宽度(text)</th>
<th>图片说明(text)</th>
</tr>
<tr>
<td><input type='text' name='module2[img2][href]' value='http://www.baidu.com'/></td>
<td><input type='text' name='module2[img2][src]' value='http://dummyimage.com/300x300/e66/fff'/></td>
<td><input type='text' name='module2[img2][height]' value='300'/></td>
<td><input type='text' name='module2[img2][width]' value='300'/></td>
<td><input type='text' name='module2[img2][alt]' value='这是测试图片'/></td>
</tr>
</table>
<table>
<caption>百度首页链接</caption>
<tr>
<th>链接地址(url)</th>
<th>链接名称(text)</th>
</tr>
<tr>
<td><input type='text' name='module2[textlink][0][href]' value='http://www.baidu1.com'/></td>
<td><input type='text' name='module2[textlink][0][text]' value='百度首页链接1'/></td>
<tr>
<tr>
<td><input type='text' name='module2[textlink][1][href]' value='http://www.baidu2.com'/></td>
<td><input type='text' name='module2[textlink][1][text]' value='百度首页链接2'/></td>
<tr>
<tr>
<td><input type='text' name='module2[textlink][2][href]' value='http://www.baidu3.com'/></td>
<td><input type='text' name='module2[textlink][2][text]' value='百度首页链接3'/></td>
<tr>
<tr>
<td><input type='text' name='module2[textlink][3][href]' value='http://www.baidu4.com'/></td>
<td><input type='text' name='module2[textlink][3][text]' value='百度首页链接4'/></td>
<tr>
<tr>
<td><input type='text' name='module2[textlink][4][href]' value='http://www.baidu5.com'/></td>
<td><input type='text' name='module2[textlink][4][text]' value='百度首页链接5'/></td>
<tr>
</table>
<button type='submit'>保存</button>
</div>
</form>
<?php include('F:/www/cms/footer.php');?>