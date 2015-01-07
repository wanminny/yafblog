<?php 

/**
 * 
 *   操作数函数
 * 
 */


/**
 * 
 * 获取作者名称
 * @param string $post_author
 */
function getAuthor($post_author){

	 $m = new UsersModel();
	 
	 $r = $m->get_one(array('ID'=>$post_author),'display_name');
	 
	 return $r['display_name'];
}


/**
 * 
 * 获取栏目名称
 * @param unknown_type $post_id
 * @param bool $getid 
 */
function getCategory($post_id){

	$m = new CategoryModel();

	$data = $m->getCategory($post_id);
	
	return $data;
	
}
