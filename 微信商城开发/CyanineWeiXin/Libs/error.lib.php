<?php
/**
 * 错误处理类
 * Author:Qpeng
 * Email:15484276@qq.com
 * Createdate:2018/10/27
 * Updatedate:2018/10/27
 * Website:http://www.cyanine.com.cn
 */
class Error
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
	 * @return [type]
	 */
	public static function _Init()
	{
		# code...
	}

	/**
	 * 显示错误信息
	 * @param [type] $code   系统错误代码
	 * @param string $errmsg 系统错误信息
	 * @param string $ordermsg 其它信息
	 */
	public static function Msg($code,$errmsg='',$ordermsg='')
	{
		$Msg = array('errcode' => $code, 'errmsg' => $errmsg);
		$MsgStr = '<font style="font-size:38px; font-weight:bold"><font style="font-size:72px;">( ´•︵•` )</font>出错啦！</font><br /><br />';
		$MsgStr .= 'Code: '.$Msg['errcode'];
		$MsgStr .= empty($Msg['errmsg'])?$MsgStr:' ErrorMsg: '.$Msg['errmsg'];
		$MsgStr .= empty($ordermsg)?$MsgStr:'<br />'.$ordermsg;
		exit($MsgStr);
	}
	
	
}