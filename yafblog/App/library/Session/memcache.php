<?php

/**
 *  session memcache 存储类
 *
 * @copyright			(C) 2013-2013 YAFCMS
 * @license		       http://www.yafcms.com/license/
 * @author             Lujunjian <YafCms@163.com>
 * @lastmodify			2014-1-19
 */

class Session_memcache {
	var $lifetime = 180000;
	static $db;
	var $table;
	
    public function __construct() {
    	session_set_save_handler(array(&$this,"open"), 
                         array(&$this,"close"), 
                         array(&$this,"read"), 
                         array(&$this,"write"), 
                         array(&$this,"destroy"), 
                         array(&$this,"gc")); 
    	session_start();
    }
/**
 * session_set_save_handler  open方法
 * @param $save_path
 * @param $session_name
 * @return true
 */
    public function open($save_path, $session_name) {

    	if(!extension_loaded('memcache')){show_msg('没有安装memcache扩展');}
    	
    	self::$db = new Memcache();

		$memcache = load_config('system','memcache');

		$server_list = explode('|',$memcache);
		
		foreach ($server_list as $val){
			
		    $mem = explode(':', $val);
		    
		    self::$db->addServer($mem[0],$mem[1]);
		}
		
		return true;
    }
    
/**
 * session_set_save_handler  close方法
 * @return bool
 */
    public function close() {
		return self::$db->close();
    } 
/**
 * 读取session_id
 * session_set_save_handler  read方法
 * @return string 读取session_id
 */
    public function read($id) {
		$r = self::$db->get($id);
		return $r ? $r : '';
    } 
/**
 * 写入session_id 的值
 * 
 * @param $id session
 * @param $data 值
 * @return mixed query 执行结果
 */
    public function write($id, $data) {
		return self::$db->set($id, $data,MEMCACHE_COMPRESSED,$this->lifetime);
    }
/** 
 * 删除指定的session_id
 * 
 * @param $id session
 * @return bool
 */
    public function destroy($id) {
		return self::$db->delete($id);
    }
/**
 * 删除过期的 session
 * 
 * @param $maxlifetime 存活期时间
 * @return bool
 */
   public function gc($maxlifetime) {
		return true;
    }
}
?>
