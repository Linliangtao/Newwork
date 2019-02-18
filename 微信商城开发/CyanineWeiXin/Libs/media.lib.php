<?php
/**
 * 临时素材接口
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/26
 * Updatedate:2018/10/26
 * Website:http://www.cyanine.com.cn
 */
class Media
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
	 * 新增临时素材
	 * @param  string $filename 文件名及路径（需要完整的）
	 * @param  string $type     媒体文件类型，分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）
	 * @return array/bool           返回请求
	 */
	public static function Upload($filename,$type='image'){
		if(empty($filename)) return false;
		$url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.ACCESSTOKEN.'&type='.$type;
		$data=array();
		$data['media']=WEB::ADDFILE($filename);
		$re=WEB::POST($url,$data,TRUE,FALSE);//不进行URL转码
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'新增临时素材时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 下载临时素材
	 * @param  string $mid mediaid
	 * @param  bool   $isvideo 是否为视频素材
	 * @return array  返回请求结果        
	 */
	public static function Download($mid,$isvideo=false)
	{
		if(empty($mid)) return false;
		$url=$isvideo?'http://':'https://';
		$url.='api.weixin.qq.com/cgi-bin/media/get?access_token='.ACCESSTOKEN.'&media_id='.$mid;
		$res=WEB::GET($url,false);
		$re=json_decode($res,true);
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'下载临时素材时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $isvideo?$re:$res;
	}

	
}