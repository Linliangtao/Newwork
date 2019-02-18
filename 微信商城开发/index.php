<?php
/**
 * 微信公众号开发者URL入口文件
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/28
 * Updatedate:2018/10/28
 */
define('DEBUG', TRUE);//是否启用调试模式,生产环境请设置为FALSE
include_once 'CyanineWeiXin/run.php';//Cyanine微信框架入口
$data=WeiXin::Run();//运行消息处理中心并返回请求数据数组
Log::WriteLog(json_encode($data));

//可以做相应业务流程
if(is_array($data) && empty($data)){//是数组并且不为空
	switch ($data['msgtype']) {
		//事件
		case 'event':
			$data['event']=strtolower($data['event']);//将事件名称转成小写
			switch ($data['event']) {
				//关注
				case 'subscribe':
					//扫二维码关注
					if(isset($data['eventkey']) && isset($data['ticket'])){
						echo Response::Text($data['fromusername'],$data['tousername'],'扫二维码关注');
					}else{//普通关注
						echo Response::Text($data['fromusername'],$data['tousername'],'普通关注');
					}
					break;
				//取消关注
				case 'unsubscribe':
					echo Response::Text($data['fromusername'],$data['tousername'],'取消关注');
					break;
				//扫描二维码
				case 'scan':
					echo Response::Text($data['fromusername'],$data['tousername'],'扫二维码');
					break;
				//地理位置
				case 'location':
					echo Response::Text($data['fromusername'],$data['tousername'],'地理位置');
					break;
				//自定义菜单里的点击事件
				case 'click':
					echo Response::Text($data['fromusername'],$data['tousername'],'自定义菜单点击事件');
					break;
				//自定义菜单里的链接跳转事件
				case 'view':
					echo Response::Text($data['fromusername'],$data['tousername'],'自定义菜单链接跳转事件');
					break;
				//模板消息的推送事件
				case 'templatesendjobfinish':
					echo Response::Text($data['fromusername'],$data['tousername'],'模板消息推送事件');
					break;
				//未知事件类型
				default:
					echo Response::Text($data['fromusername'],$data['tousername'],'未知事件类型');
					break;
			}
			break;
		//普通消息
		//文本消息
		case 'text':
			echo Response::Text($data['fromusername'],$data['tousername'],'收到文本消息');
			break;
		//图像消息
		case 'image':
			echo Response::Text($data['fromusername'],$data['tousername'],'收到图像消息');
			break;
		//语音消息
		case 'voice':
			echo Response::Text($data['fromusername'],$data['tousername'],'收到语音消息');
			break;
		//视频消息
		case 'video':
			echo Response::Text($data['fromusername'],$data['tousername'],'收到视频消息');
			break;
		//小视频消息
		case 'shortvideo':
			echo Response::Text($data['fromusername'],$data['tousername'],'收到小视频消息');
			break;
		//位置消息
		case 'location':
			echo Response::Text($data['fromusername'],$data['tousername'],'收到位置消息');
			break;
		//链接消息
		case 'link':
			echo Response::Text($data['fromusername'],$data['tousername'],'收到链接消息');
			break;
		//未知消息类型
		default:
			echo Response::Text($data['fromusername'],$data['tousername'],'收到未知消息类型');
			break;
	}
}
	


/**
 * 保存日志
 */
if(DEBUG)
	Log::Save();//保存日志

// // 新增临时素材
// $filename=realpath('1.jpg');
// $fn=Media::upload($filename);
// print_r($fn);


// //获取临时素材
// $mid='YKPt-SeJaRhhMt1fX5v-Zpu5pFlB81zgwnV8w5i_lL-ZDIxvDbcQu-Lxp0nupoK9';
// $fn=Media::download($mid);
// if(is_array($fn))
// 	print_r($fn);
// else{
// 	header('Content-type: image/'.GetFileType($fn));
// 	echo $fn;
// }
// exit;



// // 新增图文图片 
// $filename=realpath('1.jpg');
// if($filename)
// 	$mids=Material::uploadimg($filename);
// print_r($mids);
// //url=http://mmbiz.qpic.cn/mmbiz_jpg/7xyuUmuw1HvTcicsUibEgaDt8AGEwgCwDeXw0QFzDpXpOSxJ8qCgpyhoKWQJUvc8BLurbcJQRsNZvayqkJUgCfPg/0
// exit;



// // 新增其它素材
// $filename=realpath('1.jpg');
// $mids=Material::upload($filename);
// print_r($mids);
// //[media_id] => FeTZTSZzvCB2mj4joiEWpKOTiozejBEk9Lb5cE_AJOE [url] => http://mmbiz.qpic.cn/mmbiz_jpg/7xyuUmuw1HvTcicsUibEgaDt8AGEwgCwDeXw0QFzDpXpOSxJ8qCgpyhoKWQJUvc8BLurbcJQRsNZvayqkJUgCfPg/0?wx_fmt=jpeg
// exit;



// // 获取其它素材
// $mid='FeTZTSZzvCB2mj4joiEWpKOTiozejBEk9Lb5cE_AJOE';
// $fn=Material::download($mid);
// if(is_array($fn))
// 	print_r($fn);
// else{
// 	header('Content-type: image/'.GetFileType($fn));
// 	echo $fn;
// }
// exit;

// // 获取素材总数
// $fn=Material::getcount();
// print_r($fn);
// exit;



// // 获取素材列表
// $fn=Material::getlist();
// print_r($fn);
// exit;








//设置模板消息的行业
// $re=Template::Set_industry(array('industry_id1'=>1,'industry_id2'=>5));
// print_r($re);

//获取模板消息行业
// $re=Template::Get_industry();
// print_r($re);

//获取模板ID
// $re=Template::Get_template_id('TM00015');
// print_r($re);
// exit;


//获取模板列表
// $re=Template::Get_all_template();
// print_r($re);


// $data=array(
// 	'first'=>array(
// 		'value'=>'测试',
// 		'color'=>'#173177'
// 	),
// 	'orderMoneySum'=>array(
// 		'value'=>'￥500.00',
// 		'color'=>'#173177'
// 	),
// 	'orderProductName'=>array(
// 		'value'=>'手机',
// 		'color'=>'#173177'
// 	),
// 	'Remark'=>array(
// 		'value'=>'备注',
// 		'color'=>'#173177'
// 	)Template
// );
// echo Template::Send('op7iI04B52Bc4crFQi79Qis1SkFQ','A0ZnHi2lsLF64_u_Z6TqlQrvXmFYdo7cGos9K9mvByw',$data);




//下面为测试接口代码

//测试自定义菜单接口
// $menulist=array(
// 	array(
// 		'type'=>'click',
// 		'name'=>'菜单一',
// 		'key'=>'M001'
// 	),
// 	array(
// 		'type'=>'view',
// 		'name'=>'菜单二',
// 		'url'=>'http://m.baidu.com'
// 	),
// 	array(
// 		'type'=>'click',
// 		'name'=>'菜单三',
// 		'key'=>'M002'
// 	)
// );
// echo Menu::Setmenu($menulist);


// $ms=Menu::Getmenu();
// print_r($ms);

//if(Menu::Delmenu()===true)
//	echo '删除自定义菜单成功';

