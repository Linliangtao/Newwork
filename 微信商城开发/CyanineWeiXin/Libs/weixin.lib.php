<?php
/**
 * 处理微信服务器发送过来的消息并分发
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/09/30
 * Updatedate:2018/09/30
 * Website:http://www.cyanine.com.cn
 */
class WeiXin
{	
	private static $request=array();//用来保存微信服务器发送过来的请求
	/**
	 * 构造函数
	 */
	function __construct()
	{
		# code...
	}
	/**
	 * _Init  初始化方法
	 */
	public static function _Init()
	{
		//接收XML数据包
		$xml=file_get_contents('php://input');
		$xml=(array)simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA);//加载数据包并强制转换成数组
		//将数据的键名转换成小写
		$xml=array_change_key_case($xml,CASE_LOWER);
		self::$request=$xml;
	}

	/**
	 * Run 运行处理中心
	 * @return array|string 返回获取请求数据（xml转成数组后的数据）/指定键值的值
	 */
	public static function Run($key='')
	{
		/**
		 * 微信验证开发者地址有效性
		 */
		if(isset($_GET['echostr']))//进行验证
			self::VerifyUrl($_GET['echostr']);
		return empty($key)?self::$request:strtolower(self::$request[strtolower($key)]);
	}

	/**
     * 微信验证开发者地址有效性
     */
    private static function VerifyUrl($echostr)
    {
    	error_reporting(0);//禁止显示错误信息
		$signature=$_GET['signature'];//签名
		$timestamp=$_GET['timestamp'];//时间
		$nonce=$_GET['nonce'];//随机数
		$tarr=array(TOKEN,$timestamp,$nonce);//把token,timestamp,nonce三个变量放进数据
		sort($tarr,SORT_STRING);//进行字典排序
		$tstr=implode($tarr);//拼接成一个字符串
		$tstr=sha1($tstr);//将字符串进行sha1加密码，得到签名字符串
		if($tstr==$signature)
			echo $echostr;
		exit;
    }
    /**
	 * 获取微信服务器IP地址列表
	 * @return array 返回请求内容
	 * array(
	 * 	'ip_list'=>array(
	 * 		0=>'xxx',
	 * 		1=>'xxx',
	 * 		3=>'xxx'
	 * 	)
	 * )
	 */
	public static function GetIP(){
        $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.ACCESSTOKEN;
        $re = WEB::GET($url);
        if(isset($re['errcode']))
        	Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取微信服务器IP地址列表时出现错误('.$re['errcode'].$re['errmsg'].')');
        return $re;
    }
}