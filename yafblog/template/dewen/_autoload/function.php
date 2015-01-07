<?php

//dewen主题函数文件

if( !function_exists('get_one_image') ){
     
    //提取博文中第一张图片	
	function get_one_image($str){
		preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$str,$match);
        return isset($match[1])?$match[1]:false;
	}

}
