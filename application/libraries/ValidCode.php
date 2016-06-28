<?php
	class ValidCode {
		private $width; //宽
		private $height; //高
		private $num;  //数量
		private $code; //验证码
		private $img;  //图像的资源
		private $initStr; //初始化随机验证码
		private $outType; //输出的验证码格式
		private $savePath; //验证码图片保存路径
		private $expires; //以秒为单位
		private $codeFileName; //验证码图片的网络路径 
		private $params;
		private $isNoisyPoint;

		//初始化验证码数据
		function ValidCode($params=array()){
			$this->params = $params;
		   	$this->width = isset($params['width']) ? $params['width'] : '50';
		    $this->height = isset($params['height']) ? $params['height'] : '30';
		    $this->num = isset($params['num']) ? $params['num'] : '6';
		    $this->outType = isset($params['outType']) ? $params['outType'] : 'jpg';
		    $this->initStr = isset($params['initStr']) ? $params['initStr'] : 'abcdefghijklmnopqrstwvuxyz0123456789';
		    $this->savePath = isset($params['savePath']) ? $params['savePath'] : './public/captcha/';
		    $this->expires = isset($params['expires']) ? $params['expires'] : '7200';
		    $this->isNoisyPoint = isset($params['isNoisyPoint']) ? $params['isNoisyPoint'] : true;
		    $this->code = $this->createcode($this->initStr); //初始化验证码数据	
		    //删除过期的验证码
		    $this->deleteOldCode();	
		}

		//获取字符的验证码， 用于保存在服务器中
		function getCodeInfo() {
			$codeInfo = array(
				'codeVal'=>strtolower($this->code),
				'codeFileName'=>$this->codeFileName
			);
			return $codeInfo;
		}

		//输出图像
		function outimg() {
		   	//创建背景 (颜色， 大小， 边框)
		   	$this->createbg();
		   	//干扰元素(点， 线条)
		   	$this->setdisturbcolor();
		   	//画字 (大小， 字体颜色)
		   	$this->outstring();
		   	//输出图像
		   	return $this->printimg();
		}

	  	private function createbg() {
		   	//创建资源
		   	$this->img = imagecreatetruecolor($this->width, $this->height);
		   	//设置随机的背景颜色
		   	$bgcolor = imagecolorallocate($this->img, 255, 255, 255); 
		   	//设置背景填充
		   	imagefill($this->img, 0, 0, $bgcolor);
	  	}

		private function outstring() {
   			for($i=0; $i<$this->num; $i++) {
  
	    		//$color= imagecolorallocate($this->img, 207, 155, 159); 
	    		$color = imagecolorallocate($this->img, 0, 0, 0); 
	  
	    		//$fontsize = rand(3,5); //字体大小
	    		$fontsize = 5;
	  
	    		$x = 3+($this->width/$this->num)*$i; //水平位置
	    		//$y = rand(0, imagefontheight($fontsize)-7);
	    		$y = $this->height/2-imagefontheight($fontsize)/2;
	    		//画出每个字符
	    		imagechar($this->img, $fontsize, $x, $y, $this->code{$i}, $color);
	   		}
  		}

		private function setdisturbcolor() {
			//是否加上噪点
			//if($this->isNoisyPoint == true){
				for($i=0; $i<100; $i++) {
					$color= imagecolorallocate($this->img,  102, 102, 102); 
					imagesetpixel($this->img, rand(1, $this->width-2), rand(1, $this->height-2), $color);
				}
			//}
			//加线条
			for($i=0; $i<5; $i++) {
				$color= imagecolorallocate($this->img, 237,173,173); 
				$x = rand($this->width/2-10, $this->width/2+10);
				$y = rand($this->height/2-10, $this->height+10);
				$w = rand(50,100);
				$h = rand(20,30);
				imagearc($this->img, $x, $y, $w, $h, 180, 360, $color);
				
			}
			//画边框
		   	$bordercolor = imagecolorallocate($this->img, 102, 102, 102);
		    imagerectangle($this->img, 0, 0, $this->width-1, $this->height-1, $bordercolor);
		}

		//输出图像
		private function printimg() {
			//$fileName = time().mt_rand(100,999);
			$fileName = microtime(TRUE);
			if(function_exists("imagejpeg")){
			  	//header("Content-type: image/jpeg");
			  	//imagegif($this->img);
			  	$flag = imagejpeg($this->img, $this->savePath.$fileName.'.jpg');
				if(!$flag){
					return false;
				}	
			  	$this->codeFileName = $fileName.'.jpg';
			}elseif (imagetypes() & IMG_GIF){
			  	$flag = imagegif($this->img, $this->savePath.$fileName.'.gif');
			  	if(!$flag){
			  		return false;
			  	}
			  	$this->codeFileName = $fileName.'.gif';
			}elseif (imagetypes() & IMG_PNG){
			  	$flag = imagepng($this->img, $this->savePath.$fileName.'.png');
			  	if(!$flag){
			  		return false;
			  	}
			  	$this->codeFileName = $fileName.'.png';
			}else {
			  	return false;
			}
			return true;
		}

		//生成验证码字符串
		private function createcode($codes) {
			$codes = $codes;
			$code = "";
			for($i=0; $i < $this->num; $i++) {
				$code .=$codes{rand(0, strlen($codes)-1)}; 
			}
			return $code;
		}

		//删除过期的验证码
		private function deleteOldCode(){
			$now = microtime(TRUE);
			$currentDir = @opendir($this->savePath);
			while ($fileName = @readdir($currentDir)){
				if ((substr($fileName, -4) === '.jpg' || substr($fileName, -4) === '.png' || substr($fileName, -4) === '.gif') && (str_replace('.jpg', '', $fileName) + $this->expires) < $now){
					if(!unlink($this->savePath.$fileName)){
						$responseData = array('responseCode'=>'100', 'responseMessage'=>'删除验证码失败');
						return $responseData;
					}
				}
			}
			@closedir($current_dir);
		}

	  	//用于自动销毁图像资源
		function __destruct() {
			//imagedestroy($this->img);
		}

	}

?>