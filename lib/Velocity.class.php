<?php
class Velocity{
	var $tpl = "";
	var $source = array();
	var $_stack = array();
	
	public function __construct(){
		
	}
	
	public function parseLine($line){
		$line = trim($line);
		preg_match('/\#([a-zA-Z]*)/', $line, $match);
		$line = $this->parseVar($line);
		if($match){
			if(method_exists($this, "parse".strtolower($match[1]))){
				return $this->{"parse".strtolower($match[1])}($line);
			}else{
				return $line;
			}
		}else{
			return $line;
		}
	}
	
	public function parseforeach($line){
		preg_match('/\#foreach\((\$[a-zA-Z_0-9]+)\=\>(\$[a-zA-Z_0-9]+)\s+in\s+(\$[a-zA-Z_0-9]+)\s*\)/', $line, $match);

		$src= array();
		if($match){
			$src[] = "<?php foreach($match[3] as $match[1]=>$match[2]):?>";
			$this->_stack[] = "<?php endforeach;?>";
		}else{
			
			preg_match('/\#foreach\((.+?)\s+in\s+\[(.+)\.\.\.(.+)\]\s*\)/i', $line, $match);
			if($match){
				$src[] = "<?php for($match[1] = $match[2];$match[1] < $match[2]; $match[1]++):?>";
				$this->_stack[] = "<?php endfor;?>";
			}
			return $line;
		}

		return join(chr(0xA), $src);
	}
	
	public function parseif($line){
		preg_match('/\#if\((.+)\)/', $line, $match);
		$src= array();
		$src[] = "<?php if($1):?>";
		
		$this->_stack[] = "<?php endif;?>";
		return join(chr(0xA), $src);		
	}
	
	public function parseelse($line){
		$src= array();
		$src[] = "<?php else:?>";
		return join(chr(0xA), $src);		
	}
	
	public function parseset($line){
		preg_match('/\#set\((.+)\)/', $line, $match);
		$src= array();
		$src[] = "<?php $1;?>";
		return join(chr(0xA), $src);		
	}
	
	public function parseend($line){
		return array_pop($this->_stack);
	}
	
	public function parseVar($line){
		preg_match_all('/(\$[a-zA-Z_0-9]+)([\.a-zA-Z_0-9]*)/', $line, $match, PREG_SET_ORDER);
	
		if($match){
			foreach($match as $key=>$val){
				$arr = explode('.', $val[2]);
				$str = "";
	
				foreach ($arr as $key2=>$val2){
					if(strlen($val2) > 0){
						$str .= "['". $val2 ."']";
					}
				}
				
				if(substr(trim($line), 0, 1) == "#"){
					$line = str_replace($val[0], $val[1].$str, $line);
				}else{
					$line = str_replace($val[0], "<?php echo ".$val[1].$str.";?>", $line);
				}
			}
		}
			
		return $line;
	}	
}