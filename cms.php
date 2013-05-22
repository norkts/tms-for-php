<?php
include 'lib/Cms.class.php';
include 'lib/Velocity.class.php';

if(!isset($_GET['file'])){
	exit();
}

$cms = new Cms($_GET['file']);

if(isset($_GET['act'])){
	if($_GET['act'] == 'save'){
		$params = $_GET[$_GET['name']];
		$module = $_GET['module'];
		$cms->saveForm($module, $params, $_GET['name']);
	}else if($_GET['act'] == 'view'){
		$cms->view();
	}else if($_GET['act'] == 'build'){
		$cms->init();
	}else if($_GET['act'] == 'form'){
		$cms->buildForm($_GET['module']);
	}else if($_GET['act'] == "edit-source"){
		echo "<form action='cms.php?file=".$_GET['file']."&act=save-tpl' method='POST'>";
		echo "<button type='submit'>保存</button>";
		echo "<textarea name='tplContent'>".$cms->getTpl()."</textarea>";
		echo "</form>";
	}else if($_GET['act'] == 'save-tpl'){
		$cms->saveTpl($_POST['tplContent']);
		$cms->edit();
	}else{
		$cms->view();
	}
}
