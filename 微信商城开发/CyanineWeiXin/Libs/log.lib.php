<?php
/**
 * 日志类
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/27
 * Updatedate:2018/10/27
 * Website:http://www.cyanine.com.cn
 */
class Log
{
	const ERR       = 'ERR';  	// 一般错误: 一般性错误
	const INFO      = 'INFO';  	// 信息: 程序输出信息
	const DEBUG     = 'DEBUG';  // 调试: 调试信息

	// 日志信息
    private static $loginfos=array();
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
	 * 记录日志
	 * @param string $msg   日志信息
	 * @param string $level 日志等级
	 */
	public static function Record($msg,$level=self::ERR)
	{
		if(empty($msg)) return ;
		self::$loginfos[] =  "[".date('Y/m/d H:i:s')."] {$level}: {$msg}\r\n";
	}

	/**
	 * 保存日志
	 * @param string $logfile 保存文件的文件名及路径
	 */
	public static function Save($logfile='')
	{
		if(empty(self::$loginfos)) return false;
		$msg=implode('',self::$loginfos);
     	self::WriteLog($msg,$logfile);//写入日志
	}

	/**
	 * 将日志写入文件
	 * @param string $msg     		要写入的信息
	 * @param string $logfile 		要写入的文件名及路径
	 */
	public static function WriteLog($msg,$logfile='')
	{
		if(empty($logfile))
     		$logfile=LOG_PATH.date('Y_m_d').'.log';//保存路径

     	$now=date('Y-m-d H:i:s');//当前时间
     	$logdir = dirname($logfile);//日志目录
        if (!is_dir($logdir)) {
            mkdir($logdir, 0775, true);
        }
        if($msg){
	        //检测日志文件大小，超过配置大小则备份日志文件重新生成
	        if(is_file($logfile) && floor(LOG_FILE_SIZE) <= filesize($logfile))
	              rename($logfile,dirname($logfile).'/'.basename($logfile,'.log').'_'.time().'.log');
	        error_log("[{$now}] ".$_SERVER['REMOTE_ADDR'].' '.$_SERVER['REQUEST_URI']."\r\n{$msg}\r\n", 3,$logfile);//记录入日志文件
        }
	}


}