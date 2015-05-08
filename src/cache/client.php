<?php $data =  json_decode(file_get_contents("D:/xampp/htdocs/tms/src/data/client.json"), true);?>
<?php session_start();?>
<?php if($_SESSION == null || !isset($_SESSION["is_login"])){;?>
<?php     if(!isset($_GET["user"]) || !isset($_GET["pass"]) || $_GET["user"] != "admin" || $_GET["pass"] != "chengtooadmin"){;?>
<?php         die("invalid user or password!");?>
<?php     }else{;?>
<?php $_SESSION["is_login"] = true;?>
<?php };?>

<?php };?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>房管通客户端发布系统</title>
<style>
table, tr, td, th{
border: 1px solid #000;
}
</style>
</head>
<body>
<div class='module'>
<?php if(isset($_GET["act"]) && $_GET["act"] == "edit"): ?>
<a class='edit-btn' href='cms.php?file=client&act=form&module=MainClient'>编辑</a>
<?php endif; ?>
<?php $module = $data["MainClient"]["data"];?>
<?php $custom = array();
$custom = $module["ClientName"]["vals"];
$customs = $custom; ?>

<table>
<tr>
<th>PMS名称</th>
<th>JS程序简称</th>
<th>JS文件地址</th>
<th>JS文件版本号</th>
<th>publickey</th>
<th>secretkey</th>
<th>dbconn</th>
</tr>
<?php foreach($customs as $key=>$item):?>
<tr>
<td><?php echo $item['name'];?></td>
<td><?php echo $item['key'];?></td>
<td><?php echo $item['url'];?></td>
<td><?php echo $item['version'];?></td>
<td><?php echo $item['publickey'];?></td>
<td><?php echo $item['secretkey'];?></td>
<td><?php echo $item['dbconn'];?></td>
</tr>
<?php endforeach;?>
</table>

</div>
</body>
</html>