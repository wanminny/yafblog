<?php 

class Session_files {
    function __construct() {
		$path = load_config('system', 'session_n') > 0 ? load_config('system', 'session_n').';'.load_config('system', 'session_savepath')  : load_config('system', 'session_savepath');
		ini_set('session.save_handler', 'files');
		session_save_path($path);
		session_start();
    }
}


?>