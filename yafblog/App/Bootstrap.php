<?php

/**
 * 
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同.
 * @author Lujunjian<CmsSuper@163.com>
 *
 */

class Bootstrap extends Yaf_Bootstrap_Abstract{
	
    protected $config;
	
	//全局定义
	public function _initGlobal(){
		
        define('IN_YAFCMS', true);
		
		//主机协议
		define('SITE_PROTOCOL', isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://');
		
		//当前访问的主机名
		define('SITE_URL', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''));
		
		//来源
		define('HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
		
		//系统开始时间
		define('SYS_START_TIME', microtime());

		//导入全局函数
        Yaf_Loader::import(APPLICATION_PATH.'/Common/functions.php');    

        //注册自定义错误
        //register_shutdown_function("_rare_shutdown_catch_error");     
                
        //是否开启自动加载函数
        if(load_config('system','auto_load_function')) auto_load_func();
        
        //设置本地时差
        function_exists('date_default_timezone_set') && date_default_timezone_set(load_config('system','timezone'));
        
        //定义字符集
        define('CHARSET', load_config('system','charset'));
         
        //输出页面字符集
        header('Content-type: text/html; charset='.CHARSET);
        
        //定义系统时间
        define('SYS_TIME', time());
        
        //定义域名
        define('APP_PATH',load_config('system','domain'));
             
        //文件访问路径
        define('UPLOAD_FILE_URL',APP_PATH.'uploads/'.date('Y',time()).'/'.date('m',time()).'/');
        
        //上传文件存放路径
        define('UPLOAD_FILE_PATH','../../../../uploads/'.date('Y',time()).'/'.date('m',time()));
        
        //定义主题静态文件路径
	
        define('STATIC_TEMPLATE_PATCH', APP_PATH.'template/'.load_config('system','template').'/_statics/');        
    
		//加载主题扩展
		$temp_path = APPLICATION_PATH.'/template/'.load_config('system','template');
		if( is_dir($temp_path.'/_autoload/') ){
		
		    $auto_funcs = glob($temp_path.'/_autoload/*.php');
			
			if(!empty($auto_funcs) && is_array($auto_funcs)) {
				
				foreach($auto_funcs as $func_path) {
					include $func_path;
				}
				
			}
		      
		}
	
		
        //后台模块静态文件路径
        define('ADMIN_STATIC_PATH',load_config('system','admin_static_path'));
  
        
        //是否开启gzip压缩
		if(load_config('system','gzip') && function_exists('ob_gzhandler')) {
			ob_start('ob_gzhandler');
		} else {
			ob_start();	
		}
	}
	

	//注册配置信息
    public function _initConfig() {
		$this->config = Yaf_Application::app()->getConfig()->toArray();
		//注册配置
		Yaf_Registry::set('config', $this->config);
	}

	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
				
		//测试插件
		$demo = new DemoPlugin();

		$dispatcher->registerPlugin($demo);
		
	}

	
	
	
	//在这里注册自己的路由协议,默认使用简单路由
	public function _initRoute(Yaf_Dispatcher $dispatcher) {
            

		//通过派遣器得到 默认 的路由器(默认路由器是:Yaf_Router;默认路由协议是:Yaf_Rout_Static)
        $router = $dispatcher->getRouter();
		
        $arrroutes = array(
		
		                'show' => new Yaf_Route_Regex(
						
									'#show-([0-9]+).html#',
									array(
											'module' => 'index',
											'controller' => 'index',
											'action' => 'show'),
									array(
											 1 => 'id'
										)
									),
									
					   'category' => new Yaf_Route_Regex(
						
								   '#category-([0-9]+).html#',
									array(
											'module' => 'index',
											'controller' => 'index',
											'action' => 'category'),
									array(
											1 => 'id'
										)
									),
					    'page' => new Yaf_Route_Regex(
						
								   '#page-([0-9]+).html#',
									array(
											'module' => 'index',
											'controller' => 'index',
											'action' => 'page'),
									array(
											1 => 'id'
										)
									)
		);
        

        foreach($arrroutes as $key=>$routes){
		
		    $router->addRoute($key,$routes);
		
		}		 
      
	}

	
   //在这里注册自己的view控制器，例如smarty,firekylin
	public function _initView(Yaf_Dispatcher $dispatcher){
		
			//$smarty = new Smarty_Adapter(null, $this->config->smarty);
			//$smarty->registerFunction('function', 'truncate', array('Tools', 'truncate'));
			//$dispatcher->setView($smarty);
			
	}
	

	public function _initNamespaces(){
		
        // Yaf_Loader::getInstance()->registerLocalNameSpace(array("Zend"));
    
    }

}
