<?php
include_once 'weixinapi.php';//引入Cyanine微信微信公众号API入口文件

//获取网页授权访问凭证
$re=Oauth::GetAccessToken();
//拉取用户信息
$us=Oauth::UserInfo($re['access_token'],$re['openid']);
print_r($us);