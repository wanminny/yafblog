<?php 
/**
 *  BaseController.php 控制器基类
 *
 * @copyright		   (C) 2013-2013 YAFCMS
 * @license		       http://www.yafcms.com/license/
 * @author             Lujunjian <YafCms@163.com>
 * @lastmodify			2014-1-19
 */

class BaseControllers extends  Yaf_Controller_Abstract{
	
	
	public $temp_path = '';  //模板路径
	
	public function init() {
		
		//自定义模板加载
		$this->temp_path = APPLICATION_PATH.'/template/'.load_config('system','template');
		$this->setViewpath($this->temp_path);
		$view = $this->initView();
	}
	
	
	/**
	 * 
	 * 渲染一个视图模板, 并直接输出给请求端
	 * @param unknown_type $c 
	 * @param unknown_type $a 
	 */
	public function display($c,$a){
	     $this->getView()->display($this->temp_path . "/{$c}/{$a}.phtml"); 
	     return $this;
	}
	
	
	/**
	 * 
	 * 为视图引擎分配一个模板变量, 在视图模板中可以直接通过${$name}获取模板变量值
	 * @param unknown_type $params
	 */
	public function assign($params){
	     $this->getView()->assign($params);
	     return $this;
	}
	

	
}