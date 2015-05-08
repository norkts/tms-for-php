<?php include('D:/xampp/htdocs/tms/header.php');?>
<form action='cms.php' method='get'>
<input type='hidden' name='name' value='MainClient'/>
<input type='hidden' name='file' value='client'/>
<input type='hidden' name='module' value='MainClient'/>
<input type='hidden' name='act' value='save'/>
<div class='module-form' data-name='MainClient'>
<h1>客户端JS文件更新</h1>
<table>
<caption>客户端JS文件列表</caption>
<tr>
<th>PMS名称(text)</th>
<th>JS程序简称(text)</th>
<th>JS文件地址(url)</th>
<th>JS文件版本号(text)</th>
<th>publickey(text)</th>
<th>secretkey(text)</th>
<th>连接字符串(text)</th>
</tr>
<tr>
<td><input type='text' name='MainClient[ClientName][0][name]' value='佳期'/></td>
<td><input type='text' name='MainClient[ClientName][0][key]' value='JQ'/></td>
<td><input type='text' name='MainClient[ClientName][0][url]' value='http://download.fangguantong.com/download/JQ.js'/></td>
<td><input type='text' name='MainClient[ClientName][0][version]' value='0.0.003'/></td>
<td><input type='text' name='MainClient[ClientName][0][publickey]' value='1bc32a0e978f6ef7bde0'/></td>
<td><input type='text' name='MainClient[ClientName][0][secretkey]' value='f1e695a7e843a000c82f'/></td>
<td><input type='text' name='MainClient[ClientName][0][dbconn]' value='driver={SQL Server};server=(local)\\hoteluxserver;uid=sa;pwd=888;database=hotelux'/></td>
<tr>
<tr>
<td><input type='text' name='MainClient[ClientName][1][name]' value='新锐'/></td>
<td><input type='text' name='MainClient[ClientName][1][key]' value='XR'/></td>
<td><input type='text' name='MainClient[ClientName][1][url]' value='http://download.fangguantong.com/download/XR.js'/></td>
<td><input type='text' name='MainClient[ClientName][1][version]' value='0.0.004'/></td>
<td><input type='text' name='MainClient[ClientName][1][publickey]' value='1898750f-d860-11e4-92be'/></td>
<td><input type='text' name='MainClient[ClientName][1][secretkey]' value='1f553885-d860-11e4-92be'/></td>
<td><input type='text' name='MainClient[ClientName][1][dbconn]' value='driver={SQL Server};server=(local)\\XRSQL;uid=sa;pwd=admin;database=jdgl'/></td>
<tr>
<tr>
<td><input type='text' name='MainClient[ClientName][2][name]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][2][key]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][2][url]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][2][version]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][2][publickey]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][2][secretkey]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][2][dbconn]' value=''/></td>
<tr>
<tr>
<td><input type='text' name='MainClient[ClientName][3][name]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][3][key]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][3][url]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][3][version]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][3][publickey]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][3][secretkey]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][3][dbconn]' value=''/></td>
<tr>
<tr>
<td><input type='text' name='MainClient[ClientName][4][name]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][4][key]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][4][url]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][4][version]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][4][publickey]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][4][secretkey]' value=''/></td>
<td><input type='text' name='MainClient[ClientName][4][dbconn]' value=''/></td>
<tr>
</table>
<button type='submit'>保存</button>
</div>
</form>
<?php include('D:/xampp/htdocs/tms/footer.php');?>