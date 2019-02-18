<?php
/**
 * 模板消息接口
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/19
 * Updatedate:2018/10/19
 * Website:http://www.cyanine.com.cn
 */
class Template
{	
	private static $baseurl='https://api.weixin.qq.com/cgi-bin/template/';//接口的基础URL地址
	
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
	 * set_industry 设置模板消息所属行业
	 * @param array $industry 行业数组array('industry_id1'=>1,'industry_id2'=>5);
	 * 所属行业，每个月只能更改一次
	 * @return  array/boole 返回请求结果
	 */
	public static function SetIndustry($industry)
	{
		if(empty($industry) || !is_array($industry)) return false;
		$url=self::$baseurl.'api_set_industry?access_token='.ACCESSTOKEN;
		$data=json_encode($industry);//将数组转成JSON数据包
		$re=WEB::POST($url,$data);//发送请求
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'设置模板消息的所属行业时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * get_industry 获取模板消息所属行业
	 * @return array 反回请求结果
	 */
	public static function GetIndustry()
	{
		$url=self::$baseurl.'get_industry?access_token='.ACCESSTOKEN;
		$re=WEB::GET($url);
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取模板消息所属行业时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * get_template_id 将模板库里的模板添加到公众号并获取模板消息的模板ID
	 * @param  string $templateid 模板库里的模板编号
	 * @return string/boole        返回请求结果
	 */
	public static function GetTemplateId($templateid)
	{
		if(empty($templateid)) return false;
		$url=self::$baseurl.'api_add_template?access_token='.ACCESSTOKEN;
		$data=array(
			'template_id_short'=>$templateid
		);
		$data=json_encode($data);//将数组转成JSON数据包
		$re=WEB::POST($url,$data);//发送请求
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取模板ID时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re['template_id'];
	}

	/**
	 * 获取模板列表
	 * @return array 返回请求结果
	 */
	public static function GetAllTemplate()
	{
		$url=self::$baseurl.'get_all_private_template?access_token='.ACCESSTOKEN;
		$re=WEB::GET($url);//发送请求
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取模板列表时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 删除模板
	 * @param  string $templateid 模板ID
	 * @return boole              成功返回true
	 */
	public static function DelTemplate($templateid)
	{	
		if(empty($templateid)) return false;
		$url=self::$baseurl.'del_private_template?access_token='.ACCESSTOKEN;
		$data=array(
			'template_id'=>$templateid
		);
		$data=json_encode($data);//将数组转成JSON数据包
		$re=WEB::POST($url,$data);//发送请求
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'删除模板时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 发送模板消息
	 * @param  string $touser     接收人
	 * @param  string $templateid 模板ID
	 * @param  array  $data       模板数据
	 * @param  string $link        模板URL
	 * @param  string $appid      小程序的APPID
	 * @param  string $pagepath   小程序的页面路径
	 * @return string             msgid
	 */
	public static function Send($touser,$templateid,$data,$link='',$appid='',$pagepath='')
	{
		if(empty($touser) || empty($templateid) || empty($data) || !is_array($data)) return false;
		$url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.ACCESSTOKEN;
		$data=array(
			'touser'=>$touser,
			'template_id'=>$templateid,
			'data'=>$data
		);
		if(!empty($link))
			$data['url']=$link;//设置URL
		if(!empty($appid)){
			$data['miniprogram']=array(
				'appid'=>$appid
			);
			if(!empty($pagepath))
				$data['miniprogram']['pagepath']=$pagepath;
		}
		$data=json_encode($data,JSON_UNESCAPED_UNICODE);//将数组转换成JSON数据包
		$re=WEB::POST($url,$data);//发送请求
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'发送模板消息时发生错误('.$re['errcode'].$re['errmsg'].')');
		return $re['msgid'];
	}
	

	
}