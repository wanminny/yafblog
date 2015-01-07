/*
  
     YafBlog 0.0.1 login.js
	 author : Lujunjian <HackMyth@163.com>
*/

$(function(){
	
	$('.code').click(function(){
		$('.code_diy').show();
	});
	
	$('.submit').click(function(){
	
		var username = $('input[name=username]').val();
		var password = $('input[name=password]').val();
		var code     = $('input[name=code]').val();
		
		$.post('/Admin/login/index',{username:username,password:password,code:code},function(data){
			
			if(data.code == 200){
				
				window.location.href="/"+Admin.module+"/index/index";
				
			}else{	
		     	msg_error(data.msg);
			}
		},'json');
	});
	
	
	var msg_error = function(msg){
		$('.error_msg').show();
		$('.error_msg .msg').text(msg);
		$('.error_msg').animate({left: '0%',opacity: 'show'},100).animate({left: '30%',opacity: 'show'},100).animate({left: '20%',opacity: 'show'},100);
	}
	
});