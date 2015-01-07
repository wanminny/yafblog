<?php

/**
 * 
 * 文章栏目关联表
 * @author Administrator
 *
 */
class TermRelationModel extends BaseModels{

	public function __construct() {
		
		$this->db_config = Yaf_Application::app()->getConfig()->db->toArray();
		$this->db_setting = 'default';
		$this->table_name = 'term_relationships';
		parent::__construct();
	}
	
	
}

?>