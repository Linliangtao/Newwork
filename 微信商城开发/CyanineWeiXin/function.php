<?php
/**
 * AutoLoad 自动加载方法
 * @param string $ClassName 类名
 */
function AutoLoad($ClassName)
{
	$ClassFile=LIBS_PATH.strtolower($ClassName).'.lib.php';//组合类文件路径
	if(is_file($ClassFile)){//检查文件是否存在
		include_once $ClassFile;
		if(class_exists($ClassName)){//检查类是否存在
			// if(function_exists('_Init'))//检查_Init方法是否存在
				$ClassName::_Init();//执行
		}
	}
}

/**
 * 判断文件类型
 * @param  bin 	  $filebin 文件二制流
 * @return string 文件类型
 */
function GetFileType($filebin){
	if(empty($filebin)) return false;
	$bin=substr($filebin,0,2);//读取文件流前两位
	$strInfo = @unpack("C2c", $bin);//将文件流前两位进行无符号字符解包
	$typeCode = intval($strInfo['c1'].$strInfo['c2']);//组合并转为整数值
	switch ($typeCode) {
		case 7790:
			$fileType = 'exe';
			break;
		case 7784:
			$fileType = 'midi';
			break;
		case 8297:
			$fileType = 'rar';
			break;
		case 255216:
			$fileType = 'jpg';
			break;
		case 7173:
			$fileType = 'gif';
			break;
		case 6677:
			$fileType = 'bmp';
			break;
		case 13780:
			$fileType = 'png';
			break;
		default: 
			$fileType = 'unknown';
	}
	return $fileType;
}