<?php
/**
 * 系统参数配置文件
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/27
 * Updatedate:2018/10/27
 * Website:http://www.cyanine.com.cn
 */

/**
 * 版本
 */
define('VERSION', '1.1');
define('VERSION_DATE', '2018/09/28');

/**
 * 系统设置
 */
defined('DEBUG') or define('DEBUG', FALSE);//是否启用调试模式,生产环境请设置为FALSE
defined('LOG_PATH') or define('LOG_PATH', HOME_PATH.'log/');//日志目录
defined('LOG_FILE_SIZE') or define('LOG_FILE_SIZE', 2097152);//单个日志文件大小2Mb
defined('ACCESS_TOKEN_FILE') or define('ACCESS_TOKEN_FILE', '.accesstoken');//ACCESS_TOKEN文件名
defined('ACCESS_TOKEN_EXPIRE') or define('ACCESS_TOKEN_EXPIRE', 7000);//ACCESS_TOKEN有效时间，单位秒




/**
 * 微信开发者配置
 */
define('APPID', 'wx50d0c682b07c59b7');//微信公从号APPID
define('APPSECRET', '9beb24beeb34cfb2e9720e9ef4c198a3');//微信公从号APPSECRET
define('TOKEN', 'WeiXin_25');//微信公从号TOKEN
define('ENCODING_KEY', '');//信息加密码密钥

