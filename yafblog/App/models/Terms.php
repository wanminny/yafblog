<?php

/**
 * 
 * 分类主表
 * @author Lujunjian <CmsSuper@163.com>
 *
 */
class TermsModel extends BaseModels{

	public function __construct() {
		
		$this->db_config = Yaf_Application::app()->getConfig()->db->toArray();
		$this->db_setting = 'default';
		$this->table_name = 'terms';
		parent::__construct();
	}
	


}

?>