function bookmarksite(title, url){
	 if (document.all)
         window.external.AddFavorite(url, title);
         else if (window.sidebar)
         window.sidebar.addPanel(title, url, "");
}
function contactboard(){
	 var t = new PopupLayer({trigger:"#ele9", popupBlk:"#blk9", closeBtn:"#close9",
		 userOverlay:true, useFx:true, offsets:{x:0, y:-41}});
	 t.doEffects = function(way){
		 if(way == "open"){
		        this.popupLayer.css({opacity:0.3}).show(400,function(){
		            this.popupLayer.animate({
		                left:($(document).width() - this.popupLayer.width())/2,
		                top:(document.documentElement.clientHeight -
		                    this.popupLayer.height())/2 + $(document).scrollTop(),
		                opacity:0.8
		            },1000,function(){this.popupLayer.css("opacity",1)}.binding(this));
		        }.binding(this));
		    }
		    else{
		        this.popupLayer.animate({
		            left:this.trigger.offset().left,
		            top:this.trigger.offset().top,
		            opacity:0.1
		        },{duration:500,complete:function(){
		            this.popupLayer.css("opacity",1);this.popupLayer.hide()}.binding(this)});
		    }
	 }
}
function save_article(){
	var title = UE.getEditor('container-title').getContent();
	var content = UE.getEditor('container-content').getContent();
	$.ajax({url:"/article/save", type:'post', async:false, data: {'title':title, 'content':content}});
}

function window_onscroll(){
	var scrollTop = document.documentElement.scrollTop;
	if (!scrollTop){
		scrollTop = document.body.scrollTop;
	}
	var header = document.getElementById('main-header');
	var main = document.getElementById('main');
	var header_height = header.offsetHeight;
	var bar_height = document.getElementById('navbar').offsetHeight;
	var debug = document.getElementById('debug');
	if (scrollTop > header_height - bar_height - 8){
		header.style.position = "fixed";
		header.style.top = "" + (bar_height - header_height + 8) + "px";
		main.style.paddingTop = header_height + "px";
		$('.shouldhideonscroll').hide(500);
	} else{
		header.style.position = "relative";
		header.style.top = "0px";
		$('.shouldhideonscroll').show(500);
		main.style.paddingTop = "0px";
	}
	var hiddenbox = $('#hiddenbox');
	if (scrollTop > 600){
		hiddenbox.show(500);
	} else {
		hiddenbox.hide(500);
	}
}
function on_load(){
	add_event();
}
function countVisit(article_id){
	$.ajax({url:'/article/visit?article_id='+article_id, type:'get', async:false});
}
function add_event(){
	window.addEventListener('scroll', window_onscroll, false);
}
function render(){
	var editor = UE.getEditor('comment-content',{
		initialFrameWidth:'100%',
		initialFrameHeight: 500,
		initialStyle:'p{line-height:1em; font-family: 微软雅黑; font-size:20px;}',
		toolbars: [
                   [
                       'source',
                       'undo',
					   'redo',
                       'subscript', //下标
                       'superscript', //上标
                       '|', //分隔线
                       'bold',
                       'fontfamily',
                       'fontsize', //字号
                       'forecolor', //字体颜色
                       'insertcode',
                       'link',
                       'time', //时间
                       'date', //日期
                       '|', //分隔线
                       'emotion', //表情
                       'spechars', //特殊字符
                   ]
               ],
	});
	var a = document.getElementById("render");
	a.innerHTML="Cancel Render";
	a.onclick = function(){
		this.innerHTML="Render Editor";
		this.onclick=render;
		editor.destroy();
		var textarea = document.getElementById('comment-content');
		textarea.style.width="98%";
	}
}
function toggleHiddenComment(comment_id){
	$('#hidden'+comment_id).toggle(500);
}

function reply(commenter){
	var a = document.getElementById("render");
	if (a.innerHTML == 'Render Editor'){
		var textarea = document.getElementById('comment-content');
		textarea.value += "@"+commenter+'\n';
	} else{
		UE.getEditor('comment-content').setContent('<a href="javascript:void(0)">@'+commenter+'</a>', true);
	}
}
function checkComment(comment_id){
	$.ajax({url:"/comment/check?cid="+comment_id});
	$('div#comment'+comment_id).remove();
	$('a#new').text(parseInt($('a#new').text())-1);
}
function scrollToTop(){
	$("html,body").animate({scrollTop:0});
}
function changeButtons(){
	$('button#send').hide(300);
	$('p#suretext').show(500);
	$('a#cancel').show(500);
	$('button#sure').show(500);
	$('form#form').unbind();
}
function checkCommentNotEmpty(){
	if ($("input[name='commenter-name']").val()=='') {
		$('p#suretext').html('Sure not leaving a name?');
		changeButtons();
		return false;
	}
	if ($("input[name='commenter-contact-information']").val()=='') {
		$('p#suretext').html('Sure not leaving a contact information?');
		changeButtons();
		return false;
	}
}
function cancelSend(){
	$("form#form").bind("submit", function(){
		return checkCommentNotEmpty();
	});
	$('button#send').show(300);
	$('p#suretext').hide(500);
	$('a#cancel').hide(500);
	$('button#sure').hide(500);
}