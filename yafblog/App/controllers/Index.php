<?php

/**
 * @copyright Copyright(c) 2014 yafblog.com
 * @file Index.php
 * @author Lujunjian <hackmyth@163.com>
 * @date 2014-03-27
 * @version 0.0.1
 * 
 */

defined('IN_YAFCMS')or exit('No permission resources.');

class IndexController extends BaseControllers {
	
	public function indexAction() {	
	
		$PostM = new PostsModel();
		$page  = isset($_GET['page']) ? intval($_GET['page']):1;
	    $data = $PostM->listinfo(array('post_type'=>'post','post_status'=>'publish'),'ID desc',$page,10);
	    
	    $this->assign(array('postModel'=>$PostM));

        //获取栏目信息
        $Category = $PostM->getCategory($data['data']);
		
	    if(isset($data['data']) && count($data['data']) > 0){
	        $this->assign(array('data' => $data['data']))
	             ->assign(array('pages' => $data['page']))  
	             ->assign(array('cat_info' => $Category )); 
	    }
		
	}
	
	
    public function categoryAction(){
    	
	    $PostM = new PostsModel();
	    $page  = isset($_GET['page']) ? intval($_GET['page']):1;
		$term_id = intval($this->getRequest()->getParam("id", 0));
		
		$this->assign(array('postModel'=>$PostM));
	
		if($term_id){
			$arrPostid = $PostM->getCatPost($term_id);
	    	if(count($arrPostid) > 0){
			
	    		$where = "post_type = 'post' and post_status = 'publish' and ID in(".implode(',', $arrPostid).")";
	    	    $data = $PostM->listinfo($where,'post_date desc',$page,10); 

			    //获取栏目信息
                $Category = $PostM->getCategory($data['data']);
				
	    	    $this->assign(array('data' => $data['data']))
			         ->assign(array('pages' => $data['page']))
                     ->assign(array('cat_info' => $Category )); 					 
	    	}
		}
    }
    
       
	public function showAction() {
	    
		$id = intval($this->getRequest()->getParam("id", 0));
	    $PostM = new PostsModel();    
		$this->assign(array('postModel'=>$PostM));

		if($id){

			$data = $PostM->get_one(array('ID'=>$id,'post_type'=>'post','post_status'=>'publish'));
			if($data){
		     
			    //获取栏目信息
                $Category = $PostM->getCategory($data,true);
		
			    $this->assign(array('r' => $data))
			          ->assign(array('postModel'=>$PostM))
					  ->assign(array('cat_info' => $Category )); 	
			}
		}
	}

	
	public function pageAction(){
		$id = intval($this->getRequest()->getParam("id", 0));
		if($id){
			$PostM = new PostsModel();    
			$data = $PostM->get_one(array('ID'=>$id));
			$this->assign(array('r' => $data))
			     ->assign(array('postModel'=>$PostM))
			     ->assign(array('id'=>$id));
		}
		
	}

}
