/*
  
     YafBlog 0.0.1 main.js
	 
*/

$(function(){
	
	//全屏阅读
	$('.full-screen a').toggle(function(){
		
		$(this).text('[ 正常阅读 ]');
	   
	    $('#header').hide();
		$('#nav').hide();
		$('#footer').hide();
		$('.sidebar').hide();
		
		$('body').css("background-color","#333");		
		
	},function(){
		
		$(this).text('[ 全屏阅读 ]');
		$('#header').show();
		$('#nav').show();
		$('#footer').show();
		$('.sidebar').show();
		$('body').css("background-color","#fff");	
	});
	
});