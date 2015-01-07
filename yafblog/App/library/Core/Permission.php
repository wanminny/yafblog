<?php



defined('IN_YAFCMS') or exit('No permission resources.');

//设置session存储方式
$session_storage = 'Session_'.load_config('system','session_storage');
new $session_storage();


/**
 * 
 * 权限管理
 * @author Administrator
 *
 */
class Core_Permission extends BaseControllers  {

	
	public function init(){
		// self::checkAdminModule();
	    // self::checkLoginStatus();
	}

	
	/**
	 * 
	 * 检查是否登录
	 */
    final public function checkLoginStatus(){
  
 
		
		
		if(in_array($this->getRequest()->getControllerName(), array('Login'))){
		    return true;	
		}
		
		$userid = Helper::get_cookie('USER_ID');
	
		if(!isset($_SESSION['USER_ID']) || !$_SESSION['USER_ID'] || $userid != $_SESSION['USER_ID']){
				
			header('Location:/'.ucfirst(ADMIN_NAME).'/login/index');
				
		}
    } 
    
    /**
     * 
     * 检查后台模块名称是否更改
     * 
     */
    final public function checkAdminModule(){
          
    	  $config = Yaf_Registry::get('config');
    	  
    	  $modelName2 = $config['application']['directory'] . '/modules/'.ucfirst(ADMIN_NAME);
    	  
    	  if(ucfirst(ADMIN_NAME) !== $this->getModuleName()){
    	  	
    	  		//自定义模板加载
		       $config = Yaf_Registry::get('config');
		       
		       $modelName1 = $config['application']['directory'] . '/modules/' . $this->getModuleName(); 
		       
		       //重命名模块目录
    	  	   if(@rename($modelName1,$modelName2)){
    	  
    	  	   	   exit('模块目录修改成功,请到conf/yafblog.ini文件中,
    	  	   	   将相应的模块名修改成新的模块名,然后点击<a href="/'.ucfirst(ADMIN_NAME).'/login/index">此处</a>则成功修改!');
    	  	        
    	  	   }else{
    	  	   	
    	  	   	   exit('没有权限修改后台模块路径,请手动修改!');
    	  	   }
    	  	
    	  }
    	  
    }


}


?>