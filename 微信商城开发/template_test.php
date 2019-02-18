<?php
include_once 'weixinapi.php';//引入Cyanine微信微信公众号API入口文件

//模板内容
//{{title.DATA}} 会员ID：{{mid.DATA}} 绑定手机：{{mno.DATA}} {{remark.DATA}}

$data=array(
	'title'=>array(
		'value'=>'测试，哈哈带链接的',
		'color'=>'#173177'
	),
	'mid'=>array(
		'value'=>'￥8880.00',
		'color'=>'#173177'
	),
	'mno'=>array(
		'value'=>'13560359101',
		'color'=>'#173177'
	),
	'remark'=>array(
		'value'=>'备注内容',
		'color'=>'#173177'
	)
);
echo Template::Send('op7iI04B52Bc4crFQi79Qis1SkFQ','qaHCmjClnY7vILeatENiPiF2I_CelW2A50D2AOnuyWc',$data,'http://jpl.wcity.cn');