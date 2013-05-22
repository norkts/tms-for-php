<?php

class Cms{
	
	var $tpl = null;
	var $tplname = "";
	
	var $source = array();
	var $editSource = array();
	
	var $cache = "./src/cache/";
	var $tplPath = "./src/";
	var $dataPath = "./src/data/";
	var $formPath = "./src/form/";
	
	var $data = array(); 
	
	var $module = null;
	var $tag = null;
	var $br = "";
	
	var $velocity = null;
	public function __construct($tpl){
		$this->tplname = $tpl;
		
		if(!file_exists($this->dataPath.$this->tplname.".json") || !file_exists($this->cache.$this->tplname.".php")){
			$this->init();
		}else{
			$data = $this->getData();
			$this->data = $data;
		}
		$this->velocity = new Velocity();
	}
	
	public function init(){
		$this->tpl = file($this->tplPath.$this->tplname.".html");
			
		if(file_exists($this->dataPath.$this->tplname.".json")){
			$data = $this->getData();
			$this->data = $data;
		}else{
			$this->data = array();
		}
		
		$this->parseTpl();
		$this->buildData();
		$this->view();
	}
	
	public function getTpl(){
		return file_get_contents($this->tplPath.$this->tplname.".html");
	}
	
	public function saveTpl($content){
		return file_put_contents($this->tplPath.$this->tplname.".html", $content);
	}
	
	public function html(){
		ob_start();
		$this->view();
		$html = ob_get_contents();
		$this->writefile($this->cache."html/".$this->tplname.".html", $html);
		ob_end_flush();
	}
	
	
	public function view(){
		include $this->cache.$this->tplname.".php";
	}
	
	public function edit(){
		header('Location:cms.php?file='.$this->tplname.'&act=edit');	
	}
		
	public function parseTpl(){
		$this->source[] = '<?php $data =  json_decode(file_get_contents("'.str_replace("\\", "/", realpath($this->dataPath))."/".$this->tplname.".json".'"), true);?>';
		foreach ($this->tpl as $key=>$val){
			$tag = $this->getTagInfo(trim($val));
			if($tag){
				$this->tag = $tag;
				$src = $this->{str_replace('/', '', $tag['tag'])}();
				$this->source[] = $src;
			}else{
				$this->source[] = $this->velocity->parseLine($val);
			}
		}
		
		$this->saveCache();
	}

	
	public function saveCache(){
		if(!is_dir($this->cache)){
			mkdir($this->cache);
		}
		
		$this->writefile($this->cache.$this->tplname.".php", join(chr(0xA), $this->source));
	}
	
	public function saveForm($module, $data){
		$saved = &$this->data[$module]['data'];
		
		foreach($data as $key=>$val){
			$saved[$key]['vals'] = array();
			foreach($val as $key2=>$val2){
				if(is_array($val2)){

					$item = array();
					foreach ($val2 as $key3=>$val3){
						$item[$key3] = $val3;
					}
					
					$saved[$key]['vals'][] = $item;
				}else{
					$saved[$key]['vals'][$key2] = $val2;
				}
			}
		}
		$this->buildData();
		$this->edit();
	}
	
	public function getTagInfo($line){
		if(strlen($line) == 0){
			return false;	
		}
		
		preg_match('/\<cms\:(.+?)\s+(.*?)\>/i', $line, $match);

		if($match){
			$res = array();
			$res['tag'] = $match[1];

			preg_match_all('/\s*(.*?)\=[\'\"](.*?)[\'\"]/m', $match[2], $match2, PREG_SET_ORDER);
			
			foreach($match2 as $key=>$val){
				$res[$val[1]] = $val[2];
			}
			
			return $res;
		}else{
			preg_match('/\<\/cms\:(.*?)\>/', $line, $match);
			
			if($match){
				$res = array();
				$res['tag'] = '/'.$match[1];
				
				return $res;
			}else{
				return false;
			}			
		}
		
	}
	
	public function getData(){
		return json_decode(file_get_contents($this->dataPath.$this->tplname.".json"), true);
	}
	
	
	public function buildForm($module){
		unlink($this->formPath.$this->tplname.".php");
		if(!file_exists($this->formPath.$this->tplname.".php")){
			$data = $this->data[$module];
			
			$formArr = array();
			$formArr[] = "<?php include('".str_replace('\\', '/', realpath('.'))."/header.php');?>";
			$formArr[] = "<form action='cms.php' method='get'>";
			$formArr[] = "<input type='hidden' name='name' value='".$module."'/>";
			$formArr[] = "<input type='hidden' name='file' value='".$this->tplname."'/>";
			$formArr[] = "<input type='hidden' name='module' value='".$module."'/>";
			$formArr[] = "<input type='hidden' name='act' value='save'/>";
			$formArr[] = "<div class='module-form' data-name='".$module."'>";
			$formArr[] = "<h1>".$data['title']."</h1>";
			foreach ($data['data'] as $key=>$val){
				$formArr[] = "<table>";
				$formArr[] = "<caption>$val[title]</caption>";				
				$formArr[] = "<tr>";
				foreach ($val['attrs'] as $key2=>$attr){
					$formArr[] = "<th>$attr[title]($attr[type])</th>";
				}
				$formArr[] = "</tr>";

				$count = 0;
				foreach($val['vals'] as $key2=>$val2){
					if(is_array($val2)){
						$formArr[] = "<tr>";
					}else if($count == 0){
						$formArr[] = "<tr>";
					}

					if(is_array($val2)){
						foreach($val2 as $key3=>$val3){
							if($val['attrs'][$key3]['type'] == "bool"){
								$type = "checkbox";
							}else{
								$type = "text";
							}
							
							$formArr[] = "<td><input type='".$type."' name='".$module.'['.$val['name']."][$key2][".$key3."]' value='".$val3."'/></td>";
						}
						
					}else{
						if($val['attrs'][$key2]['type'] == "bool"){
							$type = "checkbox";
						}else{
							$type = "text";
						}
						
						$formArr[] = "<td><input type='".$type."' name='".$module.'['.$val['name']."][".$key2."]' value='".$val2."'/></td>";
					}
					
					if(is_array($val2)){
						$formArr[] = "<tr>";
					}else if($count == count($val['vals'])-1){
						$formArr[] = "</tr>";
					}

					$count++;
				}
				
				$formArr[] = "</table>";
			}
			
			$formArr[] = "<button type='submit'>保存</button>";
			$formArr[] = "</div>";
			$formArr[] = "</form>";
			$formArr[] = "<?php include('".str_replace('\\', '/', realpath('.'))."/footer.php');?>";
			$this->writefile($this->formPath.$this->tplname.".php", join(chr(0xA),$formArr));
		}
		include $this->formPath.$this->tplname.".php";
	}
	
	public function buildData(){
		if(!is_dir($this->dataPath)){
			mkdir($this->dataPath);
		}
		
		$this->writefile($this->dataPath.$this->tplname.".json", json_encode($this->data));
	}
	
	public function writefile($filename, $text){
		if(!file_exists(dirname($filename))){
			mkdir(dirname($filename));
		}

		$fp = fopen($filename, 'w+');
		fwrite($fp, $text);
		fclose($fp);
	}
	
	
	public function module(){
		$tag = $this->tag;
		
		if($tag['tag'] == 'module'){
			if(!isset($this->data[$tag['name']])){
				$this->data[$tag['name']] = array();
			}
						
			$this->module = &$this->data[$tag['name']];
			$this->module = array_merge($this->module, $tag);
			if(!isset($this->module['data'])){
				$this->module['data'] = array();
			}
			
		}else{
			return "</div>";
		}
		
		$moudleArr = array();

		$moudleArr[] = "<div class='module'>";
		$moudleArr[] = '<?php if(isset($_GET["act"]) && $_GET["act"] == "edit"): ?>';
		$moudleArr[] = "<a class='edit-btn' href='cms.php?file=$this->tplname&act=form&module=".$this->module['name']."'>编辑</a>";
		$moudleArr[] = '<?php endif; ?>';
		
		$moudleArr[] = '<?php $module = $data["'.$this->module['name'].'"]["data"];?>';
		return join(chr(0xA), $moudleArr);
	}
	
	public function custom(){
		$tag = $this->tag;
		
		if($tag['tag'] == 'custom'){
			return $this->_custom($tag);
		}else{
			return "";
		}
	}
	
	public function _custom($tag){

		if(isset($tag['keys'])){
			if(!isset($this->module['data'][$tag['name']])){
				$this->module['data'][$tag['name']] = array();
			}
				
			$custom = &$this->module['data'][$tag['name']];
			$custom = array_merge($custom, $tag);
				
			$attrs= explode(';', $tag['keys']);
				
			if(!isset($custom['attrs'])){
				$custom['attrs'] = array();
			}
			
			if(!isset($custom['vals'])){
				$custom['vals'] = array();
			}			
				
			$dataAttrs = array();
			$dataVals = array();
			foreach($attrs as $key=>$val){
				$attr = explode(':', $val);
				if(count($attr) == 3){
					if(isset($custom['attrs'][$attr[0]])){
						$dataAttrs[$attr[0]] = array('type'=>$attr[1], 'title'=>$attr[2]);
						$dataVals[$attr[0]] = $custom['vals'][$attr[0]];
					}else{
						$dataAttrs[$attr[0]] = array('type'=>$attr[1], 'title'=>$attr[2]);
						$dataVals[$attr[0]] = '';
					}
				}
			}
				
			$custom['attrs'] = $dataAttrs;
			$custom['vals'] = $dataVals;
			
			$src= array();
			$src[] = '$custom = $module["'.$custom['name'].'"]["vals"];';
			$src[] = '$'.$tag['tag'].' = $custom;';
			return "<?php ".join(chr(0xA), $src)." ?>".chr(0xA);
		}
	}

	public function _customs($tag){
		if(isset($tag['keys'])){
			if(!isset($this->module['data'][$tag['name']])){
				$this->module['data'][$tag['name']] = array();
			}
	
			$custom = &$this->module['data'][$tag['name']];
			$custom = array_merge($custom, $tag);
	
			$attrs= explode(';', $tag['keys']);
	
			if(!isset($custom['attrs'])){
				$custom['attrs'] = array();
			}
				
			if(!isset($custom['vals'])){
				$custom['vals'] = array();
			}
	
			$dataAttrs = array();
			foreach($attrs as $key=>$val){
				$attr = explode(':', $val);
				if(count($attr) == 3){
					if(isset($custom['attrs'][$attr[0]])){
						$dataAttrs[$attr[0]] = array('type'=>$attr[1], 'title'=>$attr[2]);
					}else{
						$dataAttrs[$attr[0]] = array('type'=>$attr[1], 'title'=>$attr[2]);
					}
				}
			}
				
			$custom['attrs'] = $dataAttrs;
	
			$dataVals = array();
			for($index = 0; $index < $tag['rows']; $index++){
				$item = array();
				foreach($custom['attrs'] as $key=>$val){
					if(isset($custom['vals'][$index]) && isset($custom['vals'][$index][$key])){
						$item[$key] = $custom['vals'][$index][$key];
					}else{
						$item[$key] = "";
					}

				}
				
				$dataVals[] = $item;
			}
				
			$custom['vals'] = $dataVals;
				
			$src= array();
			$src[] = '$custom = array();';
			$src[] = '$custom = $module["'.$custom['name'].'"]["vals"];';
			$src[] = '$'.$tag['tag'].' = $custom;';
			return "<?php ".join(chr(0xA), $src)." ?>".chr(0xA);
		}
	}
		
	public function img(){
		$tag = $this->tag;

		if($tag['tag'] == "img"){
			$tag['keys'] = "href:url:链接地址;src:url:图片地址;height:text:图片高度;width:text:图片宽度;alt:text:图片说明";
			return $this->_custom($tag);
		}else{
			return "";
		}
		
	}
	
	public function link(){
		$tag = $this->tag;
	
		if($tag['tag'] == "link"){
			$tag['keys'] = "href:url:链接地址;text:text:链接地址;isblank:bool:是否新窗口中打开";
			return $this->_custom($tag);
		}else{
			return "";
		}
	
	}
	
	public function text(){
		$tag = $this->tag;
		
		if($tag['tag'] == "text"){
			$tag['keys'] = "text:text:链接地址;";
			return $this->_custom($tag);
		}else{
			return "";
		}		
	}
		
	public function customs(){
		$tag = $this->tag;
		if($tag['tag'] == "customs"){
			return $this->_customs($tag);
		}else{
			return "";
		}
	}
	
}