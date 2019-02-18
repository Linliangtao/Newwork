<?php
/**
 * 初始化/开发者地址验证
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/09/30
 * Updatedate:2018/09/30
 * Website:http://www.cyanine.com.cn
 */

/**
 * 是否启用调试模式
 */
if(DEBUG){
	ini_set('display_errors',1);
	error_reporting(E_ERROR);
}else{
	ini_set('display_errors',0);
	error_reporting(0);
}
/**
 * 加载公共方法文件
 */
include_once 'function.php';
/**
 * 检查微信开发者配置参数
 */
if(empty(APPID)) Error::Msg(ErrorMsg::ERROR_APPID,ErrorMsg::ERROR_APPID_TEXT);
if(empty(APPSECRET)) Error::Msg(ErrorMsg::ERROR_APPSECRET,ErrorMsg::ERROR_APPSECRET_TEXT);
if(empty(TOKEN)) Error::Msg(ErrorMsg::ERROR_TOKEN,ErrorMsg::ERROR_TOKEN_TEXT);
/**
 * 注册自动加载方法
 */
spl_autoload_register('AutoLoad');

/**
 * 记录错误
 */
if(DEBUG)
	Log::Record('==========开始记录==========',Log::DEBUG);