<?php
/**
 * 微信公众号API入口文件
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/09/21
 * Updatedate:2018/09/21
 */
define('DEBUG', TRUE);//是否启用调试模式,生产环境请设置为FALSE
include_once 'CyanineWeiXin/run.php';//Cyanine微信框架入口
defined('ACCESSTOKEN') or define('ACCESSTOKEN',AccessToken::Get());//获取AccessToken
