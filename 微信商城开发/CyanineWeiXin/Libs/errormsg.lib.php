<?php
/**
 * 错误代码/信息常量
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/27
 * Updatedate:2018/10/27
 * Website:http://www.cyanine.com.cn
 */
class ErrorMsg
{	
	/**
	 * 构造函数
	 */
	function __construct()
	{
		# code...
	}
	/**
	 * 初始化
	 * @return [type] [description]
	 */
	public static function _Init()
	{
		# code...
	}
	
	/**
	 * 系统错误 100-199
	 */
	const ERROR_SYSTEM = 100;
	const ERROR_SYSTEM_TEXT = '系统错误';
	
	const ERROR_APPID = 110;
	const ERROR_APPID_TEXT = '请设置微信APPID';
	const ERROR_APPSECRET = 111;
	const ERROR_APPSECRET_TEXT = '请设置微信APPSECRET';
	const ERROR_TOKEN = 112;
	const ERROR_TOKEN_TEXT = '请设置微信TOKEN';



	/**
	 * 微信接口错误 200-299
	 */
	const ERROR_WEIXIN_API = 200;
	const ERROR_WEIXIN_API_TEXT = '微信API接口调用错误';
	const ERROR_SIGN = 201;
	const ERROR_SIGN_TEXT = '签名错误';
	const ERROR_GET_ACCESSTOKEN = 202;
	const ERROR_GET_ACCESSTOKEN_TEXT = '获取ACCESSTOKEN失败';



	


	
	
}