<?php

/**
 * 
 * 栏目模型
 * @author Lujunjian <YafCms@163.com>
 *
 */


class CategoryModel extends BaseModels{

	public function __construct() {
		
		$this->db_config = Yaf_Application::app()->getConfig()->db->toArray();
		$this->db_setting = 'default';
		$this->db_tablepre = 'wp_';
		parent::__construct();

	}
	
	
	/**
	 * 
	 * 获取栏目
	 * @param unknown_type $post_id
	 */
	public function getCategory($post_id = '',$where ='',$limit = ''){
      
		
		
		//取指定栏目数据
		if($post_id){

	
		    if(is_array($post_id)){
			
				$sql = 'select * from '.$this->db_tablepre.'term_relationships as a left join '.$this->db_tablepre.'terms as b on a.term_taxonomy_id = b.term_id where a.object_id in('.implode(',',$post_id).')';
			
			}else{
			
				$sql = 'select * from '.$this->db_tablepre.'term_relationships as a left join '.$this->db_tablepre.'terms as b on a.term_taxonomy_id = b.term_id where a.object_id='.$post_id;
			}

			
		}else{
			
			$sql = 'select * from '.$this->db_tablepre.'terms';		
			
		
			if($limit){
				
				$sql = $sql.' '.$limit;		
			
			}
			
			return $this->CategoryList($where);
			
		}
	
        $this->query($sql);
        
        $data = $this->fetch_array();
		
        return $data;
	}
	
	

	public function CategoryList($where = ''){
		
		
		$sql = 'select * from '.$this->db_tablepre.'terms a left join '.$this->db_tablepre.'term_taxonomy b on a.term_id = b.term_id where b.taxonomy  = \'category\'';
    
		if($where){	
	        $sql = $sql.' and '.$where;		
		}
		
	    $this->query($sql);
        
        $data = $this->fetch_array();
		
        return $data;
        
	}

	
	
}

?>