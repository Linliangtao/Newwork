<?php
/**
 * WEB工具
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/09/28
 * Updatedate:2018/10/26
 * Website:http://www.cyanine.com.cn
 */
class WEB
{
	private static $_ch;//用来存curl对象
	
	/**
	 * 构造函数
	 */
	function __construct()
	{
		# code...
	}
	/**
	 * Init 初始化
	 */
	public static function _Init()
	{
		self::$_ch=curl_init();//初始化curl
		curl_setopt(self::$_ch, CURLOPT_RETURNTRANSFER, true);//显示请求信息
		curl_setopt(self::$_ch, CURLOPT_HEADER, false);//不显示请求的头部信息
		curl_setopt(self::$_ch, CURLOPT_TIMEOUT, 30);//设置最长响应时间，单位：秒

	}

	/**
	 * Exec 执行curl
	 * @return string 返回请求的结果
	 */
	private static function Exec()
	{
		$re=curl_exec(self::$_ch);//执行curl
		$errno=curl_errno(self::$_ch);//获取错误代码
		if($errno>0)
			Error::Msg(ErrorMsg::ERROR_SYSTEM,ErrorMsg::ERROR_SYSTEM_TEXT,'发生意外('.curl_error(self::$_ch).')');
		return $re;//返回请求的结果
	}

	/**
	 * Close 释放curl对象（句柄）
	 */
	private static function Close()
	{
		if(is_resource(self::$_ch))
			curl_close($_ch);//释放对象
	}

	/**
	 * GET 使用GET方式请求
	 * @param string $url 			请求的地址
	 * @param bool   $decode_json 	是否返回json数据包
	 * @return  array 返回请求结果
	 */
	public static function GET($url,$decode_json=true)
	{
		if(empty($url))
			Error::Msg(ErrorMsg::ERROR_SYSTEM,ErrorMsg::ERROR_SYSTEM_TEXT,'发生意外：请设置正确的URL地址');
		curl_setopt(self::$_ch, CURLOPT_URL, $url);//设置请求的URL
		curl_setopt(self::$_ch, CURLOPT_SSL_VERIFYPEER, false);//禁用证书
		curl_setopt(self::$_ch, CURLOPT_SSL_VERIFYHOST, false);//禁用证书
		curl_setopt(self::$_ch, CURLOPT_SSLVERSION, 1);//禁用证书
		$re=self::Exec();//执行
		self::Close();//释放
		return $decode_json?json_decode($re,true):$re;//返回请求结果
	}

	/**
	 * POST 使用POST方式请求
	 * @param string $url    请求的地址
	 * @param string/array $params 请求的参数
	 * @param bool $decode_json 是否返回json数据包
	 * @param bool $is_urlcode 是否进行URL编码
	 * @return string 返回请求结果
	 */
	public static function POST($url,$params,$decode_json=true,$is_urlcode=true)
	{
		if(empty($url))
			Error::Msg(ErrorMsg::ERROR_SYSTEM,ErrorMsg::ERROR_SYSTEM_TEXT,'发生意外：请设置正确的URL地址');
		if (is_array($params)) {
            foreach ($params as $key => $val) {  
				if($is_urlcode){
                    $eckey = urlencode($key);
                }else{
                    $eckey = $key;
                }
				if ($eckey != $key) {  
					unset($params[$key]);  
				}
                if($is_urlcode){
                    $params[$eckey] = urlencode($val);
                }else{
                    $params[$eckey] = $val;
                }

            }
        }
		curl_setopt(self::$_ch, CURLOPT_URL, $url);//设置请求的地址
		curl_setopt(self::$_ch, CURLOPT_POST, true);//设置请求方式为POST
		curl_setopt(self::$_ch, CURLOPT_POSTFIELDS, $params);//设置请求的参数
		curl_setopt(self::$_ch, CURLOPT_SSL_VERIFYPEER, FALSE);//禁用证书
		curl_setopt(self::$_ch, CURLOPT_SSL_VERIFYHOST, FALSE);//禁用证书
		curl_setopt(self::$_ch, CURLOPT_SSLVERSION, 1);//禁用证书
		$re=self::Exec();//执行
		self::Close();//释放
		return $decode_json?json_decode($re,true):$re;//返回请求结果
	}

	/**
	 * 添加文件
	 * @param   string $filename 文件路径+文件名(完整的)
	 * @return  array  文件信息
	 */
	public static function ADDFILE($filename)
	{
		if(class_exists('CURLFile')){
			$fn = new CURLFile($filename);
		}else
			Error::Msg(ErrorMsg::ERROR_SYSTEM,ErrorMsg::ERROR_SYSTEM_TEXT,'URL地CURLFile不可用，请使用其它方式上传');
		return $fn;
	}



	
}