<?php
/**
 * 用户管理类
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/27
 * Updatedate:2018/10/27
 * Website:http://www.cyanine.com.cn
 */
class UserManage
{
	private static $BaseUrl='https://api.weixin.qq.com/cgi-bin/';
	/**
	 * 构造函数
	 */
	function __construct()
	{
		# code...
	}
	/**
	 * 初始化
	 */
	public static function _Init()
	{
		# code...
	}

	//*******************************用户标签管理***************************
	/**
	 * 创建标签
	 * @param string $tagname 标签名称 30个字符内
	 * @return  bool/array 返回请求结果
	 * array(
	 * 	'tag'=>array(
	 * 		'id'=>xxx,//标签ID
	 * 		'name'=>'xxx'//标签名称
	 * 	)
	 * )
	 */
	public static function CreateTag($tagname)
	{
		if(empty($tagname)) return false;
		$url = $BaseUrl.'tags/create?access_token='.ACCESSTOKEN;
		$data = array('tag'=>array('name'=>$tagname));
		$re=WEB::POST($url,json_encode($data));
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'创建标签时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 获取已创建的标签
	 * @return  array 返回请求结果 
	 * array(
	 * 	'tags'=>array(
	 * 		array(
	 * 			'id'=>'xxx',//标签ID
	 * 			'name'=>'xxx',//标签名称
	 * 			'count'=>'xxx'//标签下的粉线数
	 * 		),
	 * 		array(
	 * 			'id'=>'xxx',
	 * 			'name'=>'xxx',
	 * 			'count'=>'xxx'
	 * 		)
	 * 	)
	 * )
	 */
	public static function GetTage()
	{
		$url = $BaseUrl.'tags/get?access_token='.ACCESSTOKEN;
		$re = WEB::GET($url);
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取已创建标签时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 编辑标签
	 * @param string $id      标签ID
	 * @param string $tagname 标签名称
	 * @return bool 返回请求结果 成功：true|失败：false
	 */
	public static function Upload($id,$tagname)
	{
		if(empty($id) || empty($tagname)) return false;
		$url = $BaseUrl.'tags/update?access_token='.ACCESSTOKEN;
		$data = array(array('tag'=>array('id'=>$id,'name'=>$tagname)));
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'编辑标签时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 删除标签
	 * @param string $id 标签ID
	 * @return bool 返回请求结果 成功：true|失败：false
	 */
	public static function Delete($id)
	{
		if(empty($id)) return false;
		$url = $BaseUrl.'tags/delete?access_token='.ACCESSTOKEN;
		$data = array('tag'=>array('id'=>$id));
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'删除标签时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 获取标签下粉丝列表
	 * @param string $id         标签ID
	 * @param string $nextopenid 从这个openid开始拉取,空为第一个openid开始拉取
	 * @return bool/array 返回请求结果 失败:false|
	 * array(
	 * 	'count'=>'xx',//本次获取的粉丝数
	 * 	'data'=>array(//粉丝列表
	 * 		'openid'=array(
	 * 			0=>'xxxx',
	 * 			1=>'xxxx',
	 * 			n=>'xxxx'
	 * 		),
	 * 	),
	 * 	'next_openid'=>'xxx'//拉取列表的最后一个用户openid
	 * );
	 */
	public static function GetTagUsers($id,$nextopenid='')
	{
		if(empty($id)) return false;
		$url = $BaseUrl.'user/tag/get?access_token='.ACCESSTOKEN;
		$data = array('tagid'=>$id,'next_openid'=>$nextopenid);
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取标签下粉丝列表时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 批量为用户打标签
	 * 标签功能目前支持公众号为用户打上最多20个标签。
	 * 每次传入的openid列表个数不能超过50个
	 * @param array  $openidlist 用户openid列表 array(0=>'xxx',1=>'xxx')
	 * @param string $tagid      标签ID
	 * @return bool 返回请求结果 成功:true|失败:false
	 */
	public static function CreateUsersTag($openidlist=array(),$tagid)
	{
		if(empty($openidlist) || !is_array($openidlist) || empty($tagid)) return false;
		$url = $BaseUrl.'tags/members/batchtagging?access_token='.ACCESSTOKEN;
		$data = array('openid_list' =>$openidlist ,'tagid'=>$tagid );
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'批量为用户打标签时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 批量为用户取消标签
	 * 标签功能目前支持公众号为用户打上最多20个标签。
	 * 每次传入的openid列表个数不能超过50个
	 * @param array  $openidlist 用户openid列表 array(0=>'xxx',1=>'xxx')
	 * @param string $tagid      标签ID
	 * @return bool 返回请求结果 成功:true|失败:false
	 */
	public static function DeleteUsersTag($openidlist=array(),$tagid)
	{
		if(empty($openidlist) || !is_array($openidlist) || empty($tagid)) return false;
		$url = $BaseUrl.'tags/members/batchuntagging?access_token='.ACCESSTOKEN;
		$data = array('openid_list' =>$openidlist ,'tagid'=>$tagid );
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'批量为用户取消标签时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 获取用户身上的标签列表
	 * @param string $openid 用户openid
	 * @return bool/array 返回请求结果 失败:false|
	 * array(
	 * 	'tagid_list'=>array(//标签列表
 * 			0=>'xxxx',
 * 			1=>'xxxx',
 * 			n=>'xxxx'
	 * 	)
	 * );
	 */
	public static function GetUserTag($openid)
	{
		if(empty($openid)) return false;
		$url = $BaseUrl.'tags/getidlist?access_token='.ACCESSTOKEN;
		$data = array('openid'=>$openid);
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取标签下粉丝列表时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	//*******************************设置用户备注名***************************
	/**
	 * 更新用户备注名
	 * @param string $openid 用户openid
	 * @param string $remark 备注名称
	 * @return bool 返回请求结果 成功:true|失败:false
	 */
	public static function UploadRemark($openid,$remark)
	{
		if (empty($openid) || empty($remark)) return false;
		$url = $BaseUrl.'tags/members/batchuntagging?access_token='.ACCESSTOKEN;
		$data = array('openid' =>$openid ,'remark'=>$remark );
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'更新用户备注名时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	//*******************用户管理***********************
	
	/**
	 * 获取用户基本信息（包括UnionID机制）
	 * @param string $openid 用户openid
	 * @param string $lang   语言
	 * @return bool/array 返回请求结果 失败:false|
	 * array(
	 * 	'subscribe'=>x,//用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。
	 * 	'openid'=>xxx,//用户的标识，对当前公众号唯一
	 * 	'nickname'=>xxx,//用户的昵称
	 * 	'sex'=>xx,//用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
	 * 	'city'=>xxx,//用户所在城市
	 * 	'country'=>xxx,//用户所在国家
	 * 	'province'=>xxx,//用户所在省份
	 * 	'language'=>xxx,//用户的语言，简体中文为zh_CN
	 * 	'headimgurl'=>xxx,//用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。
	 * 	'subscribe_time'=>xxx,//用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间
	 * 	'unionid'=>xxx,//只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。
	 * 	'remark'=>xxx,//公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
	 * 	'groupid'=>xxx,//用户所在的分组ID（兼容旧的用户分组接口）
	 * 	'tagid_list'=>array(0=>xxx,1=>xxx,n=>xxx),//用户被打上的标签ID列表
	 * 	'subscribe_scene'=>xxx,//返回用户关注的渠道来源，ADD_SCENE_SEARCH 公众号搜索，ADD_SCENE_ACCOUNT_MIGRATION 公众号迁移，ADD_SCENE_PROFILE_CARD 名片分享，ADD_SCENE_QR_CODE 扫描二维码，ADD_SCENEPROFILE LINK 图文页内名称点击，ADD_SCENE_PROFILE_ITEM 图文页右上角菜单，ADD_SCENE_PAID 支付后关注，ADD_SCENE_OTHERS 其他
	 * 	'qr_scene'=>xxx,//二维码扫码场景（开发者自定义）
	 * 	'qr_scene_str'=>xxx//二维码扫码场景描述（开发者自定义）
	 * );
	 */
	public static function GetUserInfo($openid,$lang='zh_CN')
	{
		if(empty($openid)) return false;
		$url = $BaseUrl.'user/info?access_token='.ACCESSTOKEN.'&openid='.$openid.'&lang='.$lang;
		$re = WEB::GET($url);
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取用户基本信息时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 批量获取用户基本信息（包括UnionID机制）
	 * 开发者可通过该接口来批量获取用户基本信息。最多支持一次拉取100条。
	 * @param array  $openidlist 用户openid
	 * array(
     * 		'user_list'=>array(
     *      	array(
     *          	'openid'=>xxx,//用户openid
     *          	'lang'=>xx//国家地区语言版本，zh_CN 简体，zh_TW 繁体，en 英语，默认为zh-CN
     *          ),
     *      )
     * )
	 * @param string $lang   	 语言
	 * @return bool/array 返回请求结果 失败:false|
	 * array(
	 * 	'user_info_list'=>array(
	 * 		array(
	 * 			'subscribe'=>x,//用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。
	 * 	 		'openid'=>xxx,//用户的标识，对当前公众号唯一
	 * 	  		'nickname'=>xxx,//用户的昵称
	 * 	   		'sex'=>xx,//用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
	 * 	     	'city'=>xxx,//用户所在城市
	 * 	      	'country'=>xxx,//用户所在国家
	 * 	       	'province'=>xxx,//用户所在省份
	 * 	        'language'=>xxx,//用户的语言，简体中文为zh_CN
	 * 	        'headimgurl'=>xxx,//用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。
	 * 	        'subscribe_time'=>xxx,//用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间
	 * 	        'unionid'=>xxx,//只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。
	 * 	        'remark'=>xxx,//公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
	 * 	        'groupid'=>xxx,//用户所在的分组ID（兼容旧的用户分组接口）
	 * 	        'tagid_list'=>array(0=>xxx,1=>xxx,n=>xxx),//用户被打上的标签ID列表
	 * 	        'subscribe_scene'=>xxx,//返回用户关注的渠道来源，ADD_SCENE_SEARCH 公众号搜索，ADD_SCENE_ACCOUNT_MIGRATION 公众号迁移，ADD_SCENE_PROFILE_CARD 名片分享，ADD_SCENE_QR_CODE 扫描二维码，ADD_SCENEPROFILE LINK 图文页内名称点击，ADD_SCENE_PROFILE_ITEM 图文页右上角菜单，ADD_SCENE_PAID 支付后关注，ADD_SCENE_OTHERS 其他
	 * 	        'qr_scene'=>xxx,//二维码扫码场景（开发者自定义）
	 * 	        'qr_scene_str'=>xxx//二维码扫码场景描述（开发者自定义）
	 * 	    ),
	 * 	    array(
	 * 	    	'subscribe'=>0,//没关注的
	 * 	    	'openid'=>xxx//用户的标识，对当前公众号唯一
	 * 	    )
	 * );
	 */
	public static function GetUsersInfo($openidlist)
	{
		if(empty($openidlist) || !is_array($openidlist)) return false;
		$url = $BaseUrl.'user/info/batchget?access_token='.ACCESSTOKEN;
		$data = array('user_list' =>$openidlist );
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'批量获取用户基本信息时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 获取用户列表
	 * @param string $nextopenid 第一个拉取的OPENID，不填默认从头开始拉取
	 * @return array 返回请求结果 
	 * array(
	 * 	'total'=>xx,//关注该公众账号的总用户数
	 * 	'count'=>xx,//拉取的OPENID个数，最大值为10000
	 * 	'data'=>array(//列表数据，OPENID的列表
	 * 		'openid'=>array(
	 * 			o=>xxx,
	 * 			1=>xxx,
	 * 			n=>xxx
	 * 		)
	 * 	),
	 * 	'next_openid'=>xxx//拉取列表的最后一个用户的OPENID
	 * )
	 */
	public static function GetUsersList($nextopenid='')
	{
		$url = $BaseUrl.'user/get?access_token='.ACCESSTOKEN.'&next_openid='.$nextopenid;
		$re = WEB::GET($url);
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取用户列表时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 获取公众号黑名单列表
	 * @param string $beginopen 从这个openid开始拉取，空为从第一个openid开始
	 * @return array 返回请求结果
	 * array(
	 * 	'total'=>xxx,//总数量
	 * 	'count'=>xxx,//本次拉取的数量
	 * 	'data'=>array(//openid列表
	 * 		'openid'=>array(
	 * 			0=>xxx,
	 * 			1=>xxx,
	 * 			n=>xxx
	 * 		)
	 * 	),
	 * 	'next_openid'=>xxx//本次拉取的最后一个openid
	 * )
	 */
	public static function GetBlackList($beginopen='')
	{
		$url = $BaseUrl.'tags/members/getblacklist?access_token='.ACCESSTOKEN;
		$data = array('begin_openid' =>$beginopen );
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']))
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'获取公众号黑名单列表时出现错误('.$re['errcode'].$re['errmsg'].')');
		return $re;
	}

	/**
	 * 批量拉黑用户
	 * @param array $openidlist 用户openid列表
	 * array(
	 * 		0=>xxx,
	 * 		1=>xxx,
	 * 		n=>xxx
	 * 	)
	 * @return bool 返回请求结果 成功:true|失败:false
	 */
	public static function SetBlack($openidlist=array())
	{
		if(empty($openidlist) || !is_array($openidlist)) return false;
		$url = $BaseUrl.'tags/members/batchblacklist?access_token='.ACCESSTOKEN;
		$data = array('openid_list' =>$openidlist );
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'更新用户备注名时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}

	/**
	 * 批量取消拉黑用户
	 * @param array $openidlist 用户openid列表
	 * array(
	 * 		0=>xxx,
	 * 		1=>xxx,
	 * 		n=>xxx
	 * 	)
	 * @return bool 返回请求结果 成功:true|失败:false
	 */
	public static function CleanBlack($openidlist=array())
	{
		if(empty($openidlist) || !is_array($openidlist)) return false;
		$url = $BaseUrl.'tags/members/batchunblacklist?access_token='.ACCESSTOKEN;
		$data = array('openid_list' =>$openidlist );
		$re = WEB::POST($url,json_encode($data));
		if(isset($re['errcode']) && $re['errcode']!=0)
			Error::Msg(ErrorMsg::ERROR_WEIXIN_API,ErrorMsg::ERROR_WEIXIN_API_TEXT,'更新用户备注名时出现错误('.$re['errcode'].$re['errmsg'].')');
		return true;
	}
}