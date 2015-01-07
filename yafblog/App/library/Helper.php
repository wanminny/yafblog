<?php

class Helper{


    /**
	 * 设置 cookie
	 * @param string $var     变量名
	 * @param string $value   变量值
	 * @param int $time    过期时间
	 */
	public static function set_cookie($var, $value = '', $time = 0) {
		
		$time = $time > 0 ? $time : ($value == '' ? SYS_TIME - 3600 : 0);
		$s    = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
		$var  = load_config('system','cookie_pre').$var;

		$_COOKIE[$var] = $value;
	    
		if (is_array($value)) {
			foreach($value as $k=>$v) {
				setcookie($var.'['.$k.']', sys_auth($v, 'ENCODE'), $time, load_config('system','cookie_path'), load_config('system','cookie_domain'), $s);
			}
		} else {
			setcookie($var, sys_auth($value, 'ENCODE'), $time, load_config('system','cookie_path'), load_config('system','cookie_domain'), $s);
		}
		
	}
	

	/**
	 * 获取通过 set_cookie 设置的 cookie 变量 
	 * @param string $var 变量名
	 * @param string $default 默认值 
	 * @return mixed 成功则返回cookie 值，否则返回 false
	 */
	public static function get_cookie($var, $default = '') {
		$var = load_config('system','cookie_pre').$var;
		$value = isset($_COOKIE[$var]) ? sys_auth($_COOKIE[$var], 'DECODE') : $default;

		if(in_array($var,array('_userid','siteid'))) {
			$value = intval($value);
		} elseif($var=='_usename') {
			$value = safe_replace($value);
		}
		return $value;
	}
	
}