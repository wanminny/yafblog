<?php

/**
 * 
 *   系统配置文件注解
 * 
 */

return array(
   'site_name' => array(
                    'name'=>'博客名称',
                    'annotat'=>'一般不超过80个字符',
    ),      

   'site_desc' => array(
                    'name'=>'博客副标题',
                    'annotat'=>'用一句话简单介绍你的网站',
    ),      
	
   'site_keywords' => array(
                    'name'=>'关键词',
                    'annotat'=>'一般不超过100个字符',
    ),
	
   'descript'  =>   array(
                    'name'=>'博客介绍',
                    'annotat'=>'一般不超过200个字符'
    ),
	
   'domain'   =>  array(
                    'name'=>'博客域名',
                    'annotat'=>'请不要忘记域名后面的"/"，不然会出现路径错误的问题'
    ),
	
   'gzip'     =>array(
                    'name'=>'Gzip压缩',
                    'annotat'=>'是否Gzip压缩后输出,1:开启0:关闭'
    ),
	
   'charset'  => array(
                    'name'=>'页面编码',
                    'annotat'=>'参考:utf-8/gb2312'
    ),                  
   'timezone' => array(
                    'name'=>'网站时区',
                    'annotat'=>'（只对php 5.1以上版本有效），Etc/GMT-8 实际表示的是 GMT+8'
    ),                           
   'template' =>  array(
                    'name'=>'模板',
                    'annotat'=>'这里填写模板目录名称'
    ),             
	
   'admin_static_path'=> array(
                    'name'=>'文件路径',
                    'annotat'=>'后台静态文件存放路径'
    ), 
   'auth_key' => array(
                    'name'=>'密钥',
                    'annotat'=>'用来加密COOKIE'
    ), 
   'cookie_domain' => array(
                    'name'=>'Cookie 作用域',
                    'annotat'=>'一般留空即可'
    ),    
	
   'cookie_path' =>  array(
                    'name'=>'Cookie作用路径',
                    'annotat'=>'填写路径'
    ),                          
   'cookie_pre' => array(
                    'name'=>'Cookie前缀',
                    'annotat'=>'同一域名下安装多套系统时，请修改Cookie前缀'
    ),            
	
   'cookie_ttl' =>  array(
                    'name'=>'Cookie生命周期',
                    'annotat'=>'0 表示随浏览器进程'
    ),        

   //Session配置
   'session_storage' => array(
                    'name'=>'SESSION存储方式',
                    'annotat'=>'参考:files/memcache/mysql'
    ),     
	
   'session_ttl'  => array(
                    'name'=>'SESSION存活时间',
                    'annotat'=>'请根据需要设置'
    ),              
   'session_savepath' => array(
                    'name'=>'SESSION存放目录',
                    'annotat'=>'切记,要对该目录设置可写权限'
    ), 
   'session_n' => array(
                    'name'=>'SESSION文件存储',
                    'annotat'=>'文件分布的目录深度'
    ),   
	
   'memcache' => array(
                    'name'=>'memcache设置',
                    'annotat'=>'支持多台memcache服务器,多台服务器请用"|"隔开,例如:192.168.0.2:11211|127.0.0.1:11211'
    ),       
    'auto_load_function' => array(
                    'name'=>'自动加载',
                    'annotat'=>'是否自动加载函数文件'
    ),       
);