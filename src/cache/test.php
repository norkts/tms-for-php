<?php $data =  json_decode(file_get_contents("F:/www/cms/src/data/test.json"), true);?>
<!DOCTYPE html>
<html>
<head>
<title>这是测试2</title>
</head>
<body>
<div class='module'>
<?php if(isset($_GET["act"]) && $_GET["act"] == "edit"): ?>
<a class='edit-btn' href='cms.php?file=test&act=form&module=test'>编辑</a>
<?php endif; ?>
<?php $module = $data["test"]["data"];?>
<?php $custom = $module["link"]["vals"];
$custom = $custom; ?>

<a href="<?php echo $custom['href'];?>"><?php echo $custom['text'];?></a>


<?php $custom = $module["link2"]["vals"];
$custom = $custom; ?>

<a href="<?php echo $custom['href'];?>"><?php echo $custom['text'];?></a>

</div>

<div class='module'>
<?php if(isset($_GET["act"]) && $_GET["act"] == "edit"): ?>
<a class='edit-btn' href='cms.php?file=test&act=form&module=module2'>编辑</a>
<?php endif; ?>
<?php $module = $data["module2"]["data"];?>
<?php $custom = $module["img"]["vals"];
$custom = $custom; ?>

<a href="<?php echo $custom['href'];?>">
<img src="<?php echo $custom['img'];?>" width="<?php echo $custom['width'];?>" height="<?php echo $custom['height'];?>"/>
</a>


<?php $custom = $module["img2"]["vals"];
$img = $custom; ?>

<a href="<?php echo $img['href'];?>">
<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>"/>
</a>


<?php $custom = array();
$custom = $module["textlink"]["vals"];
$customs = $custom; ?>

<?php foreach($customs as $key=>$link):?>
<a href="<?php echo $link['href'];?>"><?php echo $link['text'];?></a>
<?php endforeach;?>

</div>
</body>
</html>