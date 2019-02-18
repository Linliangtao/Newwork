<?php
/**
 * 处理微信公众号AccessToken
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/09/21
 * Updatedate:2018/09/21
 * Website:http://www.cyanine.com.cn
 */
class AccessToken
{
	/**
	 * 构造函数
	 */
	function __construct()
	{
		# code...
	}
	/**
	 * Init 初始化
	 * @param string $conf 参数
	 */
	public static function _Init()
	{
		self::CheckEx();//检查AccessToken是否过期
	}

	/**
	 * AccessToken 向微信服务器获取AccessToken
	 * @return array 数组
	 */
	private static function AccessToken()
	{
		$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET;//请求的URL
		$at=WEB::GET($url);//通过GET的方式向微信服务器发出请求
		if($ats['errcode'])//如果有错误代码，证明请求有错误
			Error::Msg(ErrorMsg::ERROR_GET_ACCESSTOKEN,ErrorMsg::ERROR_GET_ACCESSTOKEN_TEXT);//获取ACCESS_TOKEN失败
		return $at;
	}

	/**
	 * WriteAccessToken 将AccessToken写入文件
	 */
	private static function WriteAccessToken()
	{
		$at=self::AccessToken();//获取微信公众号AccessToken
		$ats=array();//创建一个空的数组
		$ats['AccessToken']=$at['access_token'];//把AccessToken存进数组
		$ats['ExTime']=time()+ACCESS_TOKEN_EXPIRE;//设置有效期
		file_put_contents(ACCESS_TOKEN_FILE, json_encode($ats),LOCK_EX);
	}

	/**
	 * CheckEx 检查AccessToken是否过期，过期自己更新AccessToken
	 */
	private static function CheckEx()
	{
		$at=file_get_contents(ACCESS_TOKEN_FILE);//读取AccessToken文件
		if(empty($at)){//判断是否为空
			self::WriteAccessToken();//写入AccessToken
		}else{//不为空,判断是否已过期
			$at=json_decode($at,true);//将JSON数据包转成数组
			if (time()>=$at['ExTime']) {//已经过期
				self::WriteAccessToken();//写入AccessToken
			}
		}
	}

	/**
	 * Get 返回AccessToken
	 * @return string 微信公众号AccessToken
	 */
	public static function Get()
	{
		$at=file_get_contents(ACCESS_TOKEN_FILE);//读取AccessToken
		$at=json_decode($at,true);//将JSON数据包转成数组
		return $at['AccessToken'];//返回AccessToken
	}
}