<?php
/**
 * 永久素材接口
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/26
 * Updatedate:2018/10/26
 * Website:http://www.cyanine.com.cn
 */
class Material
{	
	private static $BaseUrl='https://api.weixin.qq.com/cgi-bin/material/';//基本URL

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
	 * 新增永久图文素材
	 * @param array $data 图文消息{
	 *	"articles": [{
	 *	"title": TITLE,//标题
	 *	"thumb_media_id": THUMB_MEDIA_ID,// 图文消息的封面图片素材id（必须是永久mediaID）
	 *	"author": AUTHOR,//作者
	 *	"digest": DIGEST,//图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空。如果本字段为没有填写，则默认抓取正文前64个字。
	 *	"show_cover_pic": SHOW_COVER_PIC(0 / 1),//是否显示封面，0为false，即不显示，1为true，即显示
	 *	"content": CONTENT,//图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS,涉及图片url必须来源 "上传图文消息内的图片获取URL"接口获取。外部图片url将被过滤。
	 *	"content_source_url": CONTENT_SOURCE_URL //图文消息的原文地址，即点击“阅读原文”后的URL
	 *	},
	 *	//若新增的是多图文素材，则此处应还有几段articles结构
	 *	]
	 *	}
	 * @return array/bool 返回请求内容 
	 */
	public static function Add($data=array())
	{
		if(empty($data)) return false;
		$url=self::$BaseUrl.'add_news?access_token='.ACCESSTOKEN;
		$data=json_encode($data);
		$re=WEB::POST($url,$data);
		if(isset($re['errcode']))
			die('新增永久图文素材时出现错误'.$re['errcode'].$re['errmsg']);
		return $re;
	}

	/**
	 * 上传图文消息内的图片获取URL
	 * @param  String $filename 文件路径+文件名(完整的)
	 * @return array/bool       返回请求内容
	 */
	public static function Uploadimg($filename)
	{
		if(empty($filename)) return false;
		$url='https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token='.ACCESSTOKEN;
		$filename=WEB::ADDFILE($filename);
		$data=array();
		$data['media']=$filename;
		$re=WEB::POST($url,$data,TRUE,FALSE);//不进行URL转码
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'上传图文消息内的图片获取URL时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 新增其他类型永久素材
	* @param  string $filename 文件路径+文件名(完整的)
	 * @param  string $type     素材的类型 媒体文件类型，分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）
	 * @param  string $title       视频素材的标题
	 * @param  string $description 视频素材的描述
	 * @return array/bool          返回请求内容
	 */
	public static function Upload($filename,$type='image',$title='',$description='')
	{
		if(empty($filename)) return false;
		$url=self::$BaseUrl.'add_material?access_token='.ACCESSTOKEN.'&type='.$type;
		$filename=WEB::ADDFILE($filename);
		$data=array();
		$data['media']=$filename;
		if($type=='video'){
			$vis=array();
			$vis['title']=$title;
			$vis['introduction']=$description;
			$data['description']=json_encode($vis);
		}
		$re=WEB::POST($url,$data,TRUE,FALSE);//不进行URL转码
		if($re['errcode'])
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'新增其他类型永久素材时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 获取永久素材
	 * @param  string $mid mediaid
	 * @return array/bool  返回请求内容
	 */
	public static function Download($mid)
	{
		if(empty($mid)) return false;
		$url=self::$BaseUrl.'get_material?access_token='.ACCESSTOKEN;
		$data=array();
		$data['media_id']=$mid;
		$data=json_encode($data);
		$res=WEB::POST($url,$data,FALSE);//不转json数据包
		$re=json_decode($res,true);
		if(is_array($re)){
			if(isset($re['errcode']))
				Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取永久素材时出现错误('.$re['errcode'].$re['errmsg'].')');
			return $re;
		}
		return $res;
	}

	/**
	 * 删除永久素材
	 * @param  string $mid mediaid
	 * @return bool  返回请求内容
	 */
	public static function Delete($mid)
	{
		if(empty($mid)) return false;
		$url=self::$BaseUrl.'del_material?access_token='.ACCESSTOKEN;
		$data=array();
		$data['media_id']=$mid;
		$data=json_encode($data);
		$re=WEB::POST($url,$data);
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'删除永久素材时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 修改永久图文素材
	 * @param  string $mid mediaid
	 * @param  array  $infos 修改信息数组
	 * {
	 *     "title": TITLE,//标题
	 *     "thumb_media_id": THUMB_MEDIA_ID,//图文消息的封面图片素材id（必须是永久mediaID）
	 *     "author": AUTHOR,//作者
	 *     "digest": DIGEST,//图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空
	 *     "show_cover_pic": SHOW_COVER_PIC(0 / 1),//是否显示封面，0为false，即不显示，1为true，即显示
	 *     "content": CONTENT,//图文消息的具体内容，支持HTML标签，必须少于2万字符，小于1M，且此处会去除JS
	 *     "content_source_url": CONTENT_SOURCE_URL //图文消息的原文地址，即点击“阅读原文”后的URL
	 *  }
	 * @param  string $index 索引值 默认为0
	 * @return bool        请求返回结果
	 */
	public static function Modify($mid,$infos,$index=0)
	{
		if(empty($mid) || empty($infos)) return false;
		$url=self::$BaseUrl.'update_news?access_token='.ACCESSTOKEN;
		$data=array();
		$data['media_id']=$mid;
		$data['index']=$index;
		$data['articles']=$infos;
		$data=json_encode($data);
		$re=WEB::POST($url,$data);
		if(isset($re['errcode']) && $er['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'修改永久图文素材时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 获取素材总数
	 * @return array 返回请求结果
	 */
	public static function GetCount()
	{
		$url=self::$BaseUrl.'get_materialcount?access_token='.ACCESSTOKEN;
		$re=WEB::GET($url);
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取素材总数时出错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 获取素材列表
	 * @param  string  $type   素材类型，图片（image）、视频（video）、语音 （voice）、图文（news）
	 * @param  integer $offset 偏移量
	 * @param  integer $count  每次请求的数量
	 * @return array           返回请求结果
	 */
	public static function GetList($type='image',$offset=0,$count=10)
	{
		$url=self::$BaseUrl.'batchget_material?access_token='.ACCESSTOKEN;
		$data=array();
		$data['type']=$type;
		$data['offset']=$offset;
		$data['count']=$count;
		$data=json_encode($data);
		$re=WEB::POST($url,$data);
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取素材列表时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}
}