function bookmarksite(title, url){
	 if (document.all)
         window.external.AddFavorite(url, title);
         else if (window.sidebar)
         window.sidebar.addPanel(title, url, "");
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
	if (scrollTop > header_height - bar_height - 8){
		header.style.position = "fixed";
		header.style.top = "" + (bar_height - header_height + 8) + "px";
		main.style.paddingTop = header_height + "px";
		$('.shouldhideonscroll').hide(1000);
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
	var sUserAgent = navigator.userAgent.toLowerCase();  
    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";  
    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";  
    var bIsMidp = sUserAgent.match(/midp/i) == "midp";  
    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";  
    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";  
    var bIsAndroid = sUserAgent.match(/android/i) == "android";  
    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";  
    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";  
    if (!(bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) ){  
    	add_event();
    } else{
    	var header = document.getElementById('main-header');
    	var main = document.getElementById('main');
    	var header_height = header.offsetHeight;
    	var bar_height = document.getElementById('navbar').offsetHeight;
    	header.style.position = "fixed";
		header.style.top = "" + (bar_height - header_height + 8) + "px";
		main.style.paddingTop = bar_height + "px";
    }
    $('.article-content img').height('auto');
    $('.article-content img').css("opacity", "0.8")
    $('.article-content img').mouseenter(function(){$(this).fadeTo(500, 1)});
    $('.article-content img').mouseleave(function(){$(this).fadeTo(100, 0.8)});
    $('.article-content img').click(function(){
    	var src = $(this).attr('src');
    	$('#pic-modal .modal-dialog').css("max-width", "90%");
    	$('#pic-modal .modal-dialog').html("<img src='"+src+"' style='max-width:100%; height:auto'/>");
    	$('#pic-modal .modal-dialog img').click(function(){
    		$('#pic-modal').modal('hide');
    	})
    	$('#pic-modal').modal('show');
    });
}
function activeContact(){
	$('#contact-modal .modal-dialog').css("margin-top", "10%");
	$('#contact-modal').modal('show');
}
function countVisit(article_id){
	$.ajax({url:'/article/visit?article_id='+article_id, type:'get', async:false});
}
function add_event(){
	$(window).bind("scroll", function(){window_onscroll()});
}
function render(){
	var editor = UE.getEditor('comment-content', {
		initialFrameWidth:'100%',
		initialFrameHeight: 500,
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
                       'spechars' //特殊字符
                   ]
               ],
        initialStyle:'p{line-height:1em; font-family: 微软雅黑; font-size:20px;}'
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
function removeSession(){
	$.ajax({url:'/article/remove-session',type:'get',async:false});
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
function toggleHidingButton(article_id){
	var text = $.ajax({'url':'/article/toggle?article_id='+article_id,type:'get',async:false});
	$('button#hiding').html(text.responseText);
}