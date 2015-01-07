<?php

class LinksModel extends BaseModels{

	public function __construct() {
		
		$this->db_config = Yaf_Application::app()->getConfig()->db->toArray();
		$this->db_setting = 'default';
		$this->table_name = 'links';
		parent::__construct();
	}
	

}

?>