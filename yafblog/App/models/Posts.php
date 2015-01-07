<?php

class PostsModel extends BaseModels{

	public function __construct() {
		
		$this->db_config = Yaf_Application::app()->getConfig()->db->toArray();
		$this->db_setting = 'default';
		$this->db_tablepre= 'wp_';
		$this->table_name = 'posts';
		parent::__construct();
	}
	
	
	/**
	 * 
	 * 
	 * 获取指定栏目下所有文章id
	 * @param unknown_type $term_id
	 */
	public function getCatPost($term_id){
	
	    $trem = new TermRelationModel();
		$data = $trem->select(array('term_taxonomy_id'=>$term_id));
		$arrPost = array();
		foreach ($data as $r){
			$arrPost[] = $r['object_id'];
		}

        return $arrPost;
	}
	
	public function getCategory($post_data,$get_one = false){
	
		//获取栏目信息		
		$cat_in_id = array();
		$Category = array();
		
		if(!$get_one){
		
			foreach($post_data as $post){
			
				 $cat_in_id[] = $post['ID'];	 
			
			}
		
		}else{
		    $cat_in_id[] = $post_data['ID'];	
		}
		
		$m = new CategoryModel();
		$cat_info = $m->getCategory($cat_in_id);
		
		foreach($cat_info as $key=>$val){	
			 $Category[$val['object_id']][] = array('name'=>$val['name'],'term_id'=>$val['term_id']); 
		}
		
		return $Category;
	}
	
}

?>