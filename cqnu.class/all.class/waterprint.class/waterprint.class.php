<?php 
/* * *********************************************
 * @类名:   	WaterMask
 * @参数:   	
				public $pos = 0; //水印位置 
				public $transparent = 45; //水印透明度 
				public $waterImg = ''; //水印图片 
				private $srcImg = ''; //需要添加水印的图片 
				private $im = ''; //图片句柄 
				private $water_im = ''; //水印图片句柄 
				private $srcImg_info = ''; //图片信息 
				private $waterImg_info = ''; //水印图片信息 
				private $x = ''; //水印X坐标 
				private $y = ''; //水印y坐标 
 * @方法	    output()-输出水印图片文件覆盖到输入的图片文件
 * @功能:   	给图片添加指定水印
 * @作者:   	不敢为天下
*/
class WaterMask{ 
public $pos = 0; //水印位置 
public $transparent = 45; //水印透明度 
public $waterImg = ''; //水印图片 

private $srcImg = ''; //需要添加水印的图片 
private $im = ''; //图片句柄 
private $water_im = ''; //水印图片句柄 
private $srcImg_info = ''; //图片信息 
private $waterImg_info = ''; //水印图片信息 
private $x = ''; //水印X坐标 
private $y = ''; //水印y坐标 

function __construct($img) { //析构函数 
$this->srcImg = file_exists($img) ? $img : die('"'.$img.'" 源文件不存在！'); 
} 
private function imginfo() { //获取需要添加水印的图片的信息，并载入图片。 
$this->srcImg_info = getimagesize($this->srcImg); 
switch ($this->srcImg_info[2]) { 
case 3: 
$this->im = imagecreatefrompng($this->srcImg); 
break 1; 
case 2: 
$this->im = imagecreatefromjpeg($this->srcImg); 
break 1; 
case 1: 
$this->im = imagecreatefromgif($this->srcImg); 
break 1; 
default: 
die('原图片（'.$this->srcImg.'）格式不对，只支持PNG、JPEG、GIF。'); 
} 
} 
private function waterimginfo() { //获取水印图片的信息，并载入图片。 
$this->waterImg_info = getimagesize($this->waterImg); 
switch ($this->waterImg_info[2]) { 
case 3: 
$this->water_im = imagecreatefrompng($this->waterImg); 
break 1; 
case 2: 
$this->water_im = imagecreatefromjpeg($this->waterImg); 
break 1; 
case 1: 
$this->water_im = imagecreatefromgif($this->waterImg); 
break 1; 
default: 
die('水印图片（'.$this->srcImg.'）格式不对，只支持PNG、JPEG、GIF。'); 
} 
} 
private function waterpos() { //水印位置算法 
switch ($this->pos) { 
case 0: //随机位置 
$this->x = rand(0,$this->srcImg_info[0]-$this->waterImg_info[0]); 
$this->y = rand(0,$this->srcImg_info[1]-$this->waterImg_info[1]); 
break 1; 
case 1: //上左 
$this->x = 0; 
$this->y = 0; 
break 1; 
case 2: //上中 
$this->x = ($this->srcImg_info[0]-$this->waterImg_info[0])/2; 
$this->y = 0; 
break 1; 
case 3: //上右 
$this->x = $this->srcImg_info[0]-$this->waterImg_info[0]; 
$this->y = 0; 
break 1; 
case 4: //中左 
$this->x = 0; 
$this->y = ($this->srcImg_info[1]-$this->waterImg_info[1])/2; 
break 1; 
case 5: //中中 
$this->x = ($this->srcImg_info[0]-$this->waterImg_info[0])/2; 
$this->y = ($this->srcImg_info[1]-$this->waterImg_info[1])/2; 
break 1; 
case 6: //中右 
$this->x = $this->srcImg_info[0]-$this->waterImg_info[0]; 
$this->y = ($this->srcImg_info[1]-$this->waterImg_info[1])/2; 
break 1; 
case 7: //下左 
$this->x = 0; 
$this->y = $this->srcImg_info[1]-$this->waterImg_info[1]; 
break 1; 
case 8: //下中 
$this->x = ($this->srcImg_info[0]-$this->waterImg_info[0])/2; 
$this->y = $this->srcImg_info[1]-$this->waterImg_info[1]; 
break 1; 
default: //下右 
$this->x = $this->srcImg_info[0]-$this->waterImg_info[0]; 
$this->y = $this->srcImg_info[1]-$this->waterImg_info[1]; 
break 1; 
} 
} 
private function waterimg() { 
if ($this->srcImg_info[0] <= $this->waterImg_info[0] || $this->srcImg_info[1] <= $this->waterImg_info[1]){ 
die('水印比原图大！'); 
} 
$this->waterpos(); 
$cut = imagecreatetruecolor($this->waterImg_info[0],$this->waterImg_info[1]); 
imagecopy($cut,$this->im,0,0,$this->x,$this->y,$this->waterImg_info[0],$this->waterImg_info[1]); 
$pct = $this->transparent; 
imagecopy($cut,$this->water_im,0,0,0,0,$this->waterImg_info[0],$this->waterImg_info[1]); 
imagecopymerge($this->im,$cut,$this->x,$this->y,0,0,$this->waterImg_info[0],$this->waterImg_info[1],$pct); 
} 
function output() { 
$this->imginfo(); 
$this->waterimginfo(); 
$this->waterimg(); 
switch ($this->srcImg_info[2]) { 
case 3: 
imagepng($this->im,$this->srcImg); 
break 1; 
case 2: 
imagejpeg($this->im,$this->srcImg); 
break 1; 
case 1: 
imagegif($this->im,$this->srcImg); 
break 1; 
default: 
die('添加水印失败！'); 
break; 
} 
imagedestroy($this->im); 
imagedestroy($this->water_im); 
} 
} 

?> 