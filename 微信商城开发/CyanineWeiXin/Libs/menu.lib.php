<?php
/**
 * 自定义菜单
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/09/28
 * Updatedate:2018/09/28
 * Website:http://www.cyanine.com.cn
 */
class Menu
{
	private static $url='https://api.weixin.qq.com/cgi-bin/menu/';//请求基础地址
	
	/**
	 * 构造函数
	 */
	function __construct()
	{
		# code...
	}
	/**
	 * _Init 初始化方法
	 */
	public static function _Init()
	{
		# code...
	}

	/**
	 * SetMenu 设置自定义菜单
	 * @param array $menulist 菜单数据
	 * @return string/boole 返回请求结果
	 */
	public static function SetMenu($menulist)
	{
		if(!is_array($menulist))
			die('发生意外：请设置正确的菜单数据');
		$url=self::$url.'create?access_token='.ACCESSTOKEN;//组合请求URL地址
		$menulist['button']=$menulist;//进行格式加工
		$menulist=json_encode($menulist,JSON_UNESCAPED_UNICODE);//将数组转化成JSON数据,加上不转码选项 注意：PHP版本必须是5.4及以上才可带选项
		$re=WEB::POST($url,$menulist);//发出请求
		if(!empty($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'设置自定义菜单时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * GetMenu 获取自定义菜单
	 * @return array/boole 返回请求结果
	 */
	public static function GetMenu()
	{
		$url=self::$url.'get?access_token='.ACCESSTOKEN;//组合请求URL地址
		$re=WEB::GET($url);
		if(!empty($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取自定义菜单时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * DelMenu 删除自定义菜单
	 * @return  string/boole 返回请求结果
	 */
	public static function DelMenu()
	{
		$url=self::$url.'delete?access_token='.ACCESSTOKEN;//组合请求URL地址
		$re=WEB::GET($url);
		if(!empty($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'删除自定义菜单时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}



	
}