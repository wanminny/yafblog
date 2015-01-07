<?php

   /**
	*
	*  版本信息和开发人员
	*
	*/
   
    $arrjson = array();
    
    $arrjson['version'] = '0.1.2';

    //开发人员列表
    $arrjson['dev'] = array(
	
						array(
							'nickname'=>'Jiankers',
							'site'=>'http://www.weibo.com/jiankers',
							'Avatar'=>'http://0.gravatar.com/avatar/4e84843ebff0918d72ade21c6ee7b1e4?s=60',
							'position'=>'开发领头人'
						),
						
						
				   
					);
    
    echo json_encode($arrjson);



?>