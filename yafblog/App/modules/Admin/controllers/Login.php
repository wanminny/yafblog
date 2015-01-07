<?php
/**
 * 处理登录控制器
 * @author Lujunjian <YafCms@163.com>
 * @copyright 2013-2013 www.yafcms.com
 */
class LoginController extends Core_Permission{
	
	public function indexAction(){
	
		if($_POST){
	
		   $username = isset($_POST['username']) && !empty($_POST['username']) ? trim($_POST['username']) : return_json('用户名不能为空!',-3);
		   $password = isset($_POST['password']) && !empty($_POST['password']) ? trim($_POST['password']) : return_json('密码不能为空!',-4);
		   $code     = isset($_POST['code']) && !empty($_POST['code']) ? trim($_POST['code']) : return_json('验证码不能为空!',-5);
		   
		   
		   //检查验证码
		   if($code != Helper::get_cookie('login_code')){
		         return_json('验证码错误!',-6);
		   }
		   
		   //查询帐号
		   $userM = new UsersModel();
		   $r = $userM->get_one(array('user_login'=>$username));
		  // var_dump($r);
		   if(!$r){
		    	return_json('密码错误!',-2);
		   }
		   
		   //使用Portable PHP password hashing framework加密   
		   $Yaf_hasher = new Util_PasswordHash(8, TRUE);
		   
		   if(!$Yaf_hasher->CheckPassword($password,$r['user_pass'])){
		   	     return_json('密码错误!',-2);
		   }else{
		  	     
		   	
		 // echo 88;
		   	     Helper::set_cookie('USER_ID',$r['ID']);

		   	     $_SESSION['USER_ID'] = $r['ID'];
		   	      
		   	     $_SESSION['USER_NAME'] = $r['user_login']; 
				
				//echo Helper::get_cookie('login_code');
		   	  return_json('登录成功!',200);exit;
			//	$this->getView()
			//echo '<script>document.location.href="http://blog.com/admin/index/index"</script>';
		   }
		   
		   return FALSE;
		}
	
	
		
	}

	/**
	 * 
	 * 生成验证码
	 */
	public function checkcodeAction(){

			$checkcode =new Util_ImageCode();
			
			if (isset($_GET['code_len']) && intval($_GET['code_len'])){	
		     	$checkcode->code_len = intval($_GET['code_len']);
			}
			
			if ($checkcode->code_len > 8 || $checkcode->code_len < 2) {
				$checkcode->code_len = 4;
			}
			
			if (isset($_GET['font_size']) && intval($_GET['font_size'])){ 
				$checkcode->font_size = intval($_GET['font_size']);
			}
			
			
			if (isset($_GET['width']) && intval($_GET['width'])){ 
				$checkcode->width = intval($_GET['width']);
			}
			
			
			if ($checkcode->width <= 0) {
				$checkcode->width = 130;
			}
			
			if (isset($_GET['height']) && intval($_GET['height'])){ 
				 $checkcode->height = intval($_GET['height']);
			}
	
			if ($checkcode->height <= 0) {
				$checkcode->height = 50;
			}
			
			$max_width = $checkcode->code_len * 28;
			$max_height = $checkcode->font_size * 2;
			
			if($checkcode->width > $max_width){
				$checkcode->width = $max_width;
			} 
			
			if($checkcode->height > $max_height){
				$checkcode->height = $max_height;
			}
			
			if (isset($_GET['font_color']) && trim(urldecode($_GET['font_color'])) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($_GET['font_color'])))) {
				$checkcode->font_color = trim(urldecode($_GET['font_color']));
			}
			
			if (isset($_GET['background']) && trim(urldecode($_GET['background'])) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($_GET['background'])))){
				$checkcode->background = trim(urldecode($_GET['background']));
			}
			
			$checkcode->doimage();
			
			Helper::set_cookie('login_code',$checkcode->get_code());
			
			return false;
	}
	
	/**
	 * 
	 * 注销登录
	 */
	public function logoutAction(){
	
		 Helper::set_cookie('USER_ID','',time()-1);

   	     unset($_SESSION['USER_ID']);
   	     unset($_SESSION['USER_NAME']);  
   	      
   	     show_msg('退出成功!','/'.ADMIN_NAME.'/login/index');
   	     
		 return false;
	}
}