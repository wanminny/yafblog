<?php

/**
 * 
 * 分类副表
 * @author Lujunjian <CmsSuper@163.com>
 *
 */
class TermTaxonomyModel extends BaseModels{

	public function __construct() {
		
		$this->db_config = Yaf_Application::app()->getConfig()->db->toArray();
		$this->db_setting = 'default';
		$this->table_name = 'term_taxonomy';
		parent::__construct();
	}
	


}

?>