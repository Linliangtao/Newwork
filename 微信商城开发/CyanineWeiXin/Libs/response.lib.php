<?php
/**
 * 处理微信的消息
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/12
 * Updatedate:2018/10/12
 * Website:http://www.cyanine.com.cn
 */
class Response
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
	 * 处理文本消息
	 * @param  string $tousername   接收者
	 * @param  string $fromusername 发送者
	 * @param  string $content      消息内容
	 * @return xml XML数据包
	 */
	public static function Text($tousername,$fromusername,$content)
	{
		//文本消息XML数据包模板
		$tempstr="<xml><ToUserName><![CDATA[%s]]></ToUserName> <FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime> <MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
		//将模板的相应内容填写好，并返回XML数据包
		return sprintf($tempstr,$tousername,$fromusername,time(),$content);
	}

	/**
	 * 处理图片消息
	 * @param  string $tousername   接收者
	 * @param  string $fromusername 发送者
	 * @param  string $mediaid      媒体ID
	 * @return xml XML数据包
	 */
	public static function Image($tousername,$fromusername,$mediaid)
	{
		//图片消息XML数据包模板
		$tempstr="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[image]]></MsgType><Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>";
		//将模板的各项内容填好并返回XML数据包
		return sprintf($tempstr,$tousername,$fromusername,time(),$mediaid);
	}

	/**
	 * 处理语音消息
	 * @param  string $tousername   接收者
	 * @param  string $fromusername 发送者
	 * @param  string $mediaid      媒体ID
	 * @return xml XML数据包
	 */
	public static function Voice($tousername,$fromusername,$mediaid)
	{	
		//语音消息的XML数据包模板
		$tempstr="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[voice]]></MsgType><Voice><MediaId><![CDATA[%s]]></MediaId></Voice></xml>";
		//将模板相应的项目填好并返回XML数据包
		return sprintf($tempstr,$tousername,$fromusername,time(),$mediaid);
	}

	/**
	 * 处理视频消息
	 * @param  string $tousername   接收者
	 * @param  string $fromusername 发送者
	 * @param  string $mediaid      媒体ID
	 * @param  string $title        标题
	 * @param  string $description  描述
	 * @return xml XML数据包
	 */
	public static function Video($tousername,$fromusername,$mediaid,$title='',$description='')
	{	
		//视频消息XML数据包模板
		$tempstr="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[%s]]></MediaId><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description></Video></xml>";
		//将模板各项信息填好并返回XML数据包
		return sprintf($tousername,$fromusername,time(),$mediaid,$title,$description);
	}

	/**
	 * 处理音乐消息
	 * @param  string $tousername   接收者
	 * @param  string $fromusername 发送者
	 * @param  string $mediaid      媒体ID
	 * @param  string $title        标题
	 * @param  string $description  描述
	 * @param  string $musicurl     音乐链接
	 * @param  string $hmusicurl    高质量音乐链接
	 * @return xml XML数据包
	 */
	public static function Music($tousername,$fromusername,$mediaid,$title='',$description='',$musicurl='',$hmusicurl='')
	{
		//音乐消息XML数据包模板
		$tempstr="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[music]]></MsgType><Music><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><MusicUrl><![CDATA[%s]]></MusicUrl><HQMusicUrl><![CDATA[%s]]></HQMusicUrl><ThumbMediaId><![CDATA[%s]]></ThumbMediaId></Music></xml>";
		//将模板相应的项目进行填好并返回XML数据包
		return sprintf($tempstr,$tousername,$fromusername,time(),$title,$description,$musicurl,$hmusicurl,$mediaid);
	}

	/**
	 * 处理图文消息
	 * @param  string $tousername   接收者
	 * @param  string $fromusername 发送者
	 * @param  string $title        标题
	 * @param  string $description  描述
	 * @param  string $picurl       图片地址
	 * @param  string $url          链接
	 * @return xml XML数据包
	 */
	public static function News($tousername,$fromusername,$title,$description,$picurl,$url)
	{
		//图片消息XML数据包模板
		$tempstr="<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>1</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>";
		//将模板对应项目填好并返回XML数据包
		return sprintf($tempstr,$tousername,$fromusername,time(),$title,$description,$picurl,$url);
	}
	

	
}