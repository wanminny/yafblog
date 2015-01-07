<?php 

/**
 * @name  YafBlog默认控制器
 * @author LuJunJian<CmsSuper@163.com>
 */

defined('IN_YAFCMS')or exit('No permission resources.');

class PageController extends BaseControllers {


	public function indexAction() {
		
      
	
	    $Pageid = $this->getRequest()->getParam("id", 0);
	    
	    var_dump($Pageid);
		
        
       // $this->_view->assign('msg',$msg);
    
	}
	



}


?>