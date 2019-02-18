<?php
/**
 * 网页授权接口
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/19
 * Updatedate:2018/10/19
 * Website:http://www.cyanine.com.cn
 */
class Oauth
{
	/**
	 * 构造函数
	 */
	function __construct()
	{
		# code...
	}
	/**
	 * _Init 初始化
	 */
	public static function _Init()
	{
		# code...
	}
	/**
	 * 获取CODE
	 * @param  string $return_url 回调URL地址
	 */
	private static function GetCode($return_url)
	{
		$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.APPID.'&redirect_uri='.urlencode($return_url).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
		header('Location:'.$url);//跳转
		exit;
	}

	/**
	 * 获取网页授权ACCESS_TOKEN
	 * @param  string $return_url 回调URL地址 默认调用此方法的页面URL地址
	 * @return array              返回请求结果
	 */
	public static function GetAccessToken($return_url='')
	{
		$return_url=empty($return_url)?'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']:$return_url;
		if(!isset($_GET['code']))
			self::GetCode($return_url);
		$url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.APPID.'&secret='.APPSECRET.'&code='.$_GET['code'].'&grant_type=authorization_code';
		$re=WEB::GET($url);
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取网页授权ACCESS_TOKEN时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 更新ACCESS_TOKEN
	 * @param  string $refresh_token refresh_token
	 * @return array                 返回请求结果
	 */
	public static function RefreshAccessToken($refresh_token)
	{
		if(empty($refresh_token)) return false;
		$url='https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.APPID.'&grant_type=refresh_token&refresh_token='.$refresh_token;
		$re=WEB::GET($url);
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'更新ACCESS_TOKEN时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * Userinfo 拉取用户信息
	 * @param  string $accesstoken 网页授权ACCESSTOKEN
	 * @param  string $openid      用户openid
	 * @return array               返回请求结果
	 */
	public static function UserInfo($accesstoken,$openid)
	{
		if(empty($accesstoken) || empty($openid)) return false;
		$url='https://api.weixin.qq.com/sns/userinfo?access_token='.$accesstoken.'&openid='.$openid.'&lang=zh_CN';
		$re=WEB::GET($url);
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'摘取用户信息时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * Check_auth 验证ACCESSTOKEN是否有效
	 * @param  string $accesstoken 网页授权ACCESSTOKEN
	 * @param  string $openid      用户openid
	 * @return boole               成功返回TRUE
	 */
	public static function CheckAuth($accesstoken,$openid)
	{
		$url='https://api.weixin.qq.com/sns/auth?access_token='.$accesstoken.'&openid='.$openid;
		$re=WEB::GET($url);
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'验证ACCESSTOKEN是否有效时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}


	
}