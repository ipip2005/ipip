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
	} else{
		header.style.position = "relative";
		header.style.top = "0px";
		main.style.paddingTop = "0px";
	}
}
