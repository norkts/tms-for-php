<!DOCTYPE html>
<html>
	<head>
		<title>运营人员系统</title>
    </head>
	<body>
<table>
    <tr>
        <th>模版列表</th>
        <th>编译模版</th>
        <th>编辑数据</th>
        <th>查看结果</th>
        <th>编辑源码</th>
    </tr>
		<?php
            include("lib/Cms.class.php");
            $cms = new Cms("", false);
            $tplpath = $cms->tplPath;
            
            $tpldir = dir($tplpath);
            while($file = $tpldir->read()){
                if(is_file($tplpath.$file)){
                    $name = str_replace(".html", "", $file);
    ?>
    <tr>
        <td><?php echo $name;?></td>
        <td><a href="cms.php?file=<?php echo $name;?>&act=build">编译</a></td>
        <td><a href="cms.php?file=<?php echo $name;?>&act=edit">编辑</a></td>
        <td><a href="cms.php?file=<?php echo $name;?>&act=view">查看</a></td>
        <td><a href="cms.php?file=<?php echo $name;?>&act=edit-source">源码</a></td>
    </tr>
    <?php
                }
            }
        ?>
</table>
    </body>
</html>