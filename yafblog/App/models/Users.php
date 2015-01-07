<?php

class UsersModel extends BaseModels{

	public function __construct() {
		
		$this->db_config = Yaf_Application::app()->getConfig()->db->toArray();
		$this->db_setting = 'default';
		$this->table_name = 'users';
		parent::__construct();
	}
	

}

?>