<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="baidu-site-verification" content="khsljLdhkV" /> 
    <meta name="baidu_union_verify" content="0b542825c3c4160744bfb71de0aec40b">
    <meta name="keywords" content="ipip">
    <meta name="keywords" content="ipip2005">
    <meta name="keywords" content="ipip's blog">
    <meta name="keywords" content="个人博客">
    <meta name="keywords" content="技术交流">
    <meta name="description" content="ipip的个人博客，记录生活和工作的点点滴滴，欢迎来交流、吐槽，或者听歌">
    @section('title')
        <title>{{{$title}}}</title> 
    @show  
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/custom.css') }}
    {{ HTML::style('css/font-awesome.css') }}
     <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	{{ HTML::script('./js/bootstrap.min.js') }}
	
</head>
<body onload="on_load()" class="bg-white">
<div class="wrap">
	
	<header id="main-header" class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="blog-title">
						<h1>
							<a href="http://ipipblog.net">ipip's blog</a>
						</h1>
						<label><h2>A Level 1 Light Mage</h2></label>
					</div>
				</div>
			</div>
		</div>
		
		<div id="navbar" class="link">
			<ul class="nav">
				
				<li class="shouldhideonscroll hidden-xs">
					<a href="https://github.com/ipip2005" target="_blank">
						<i class="icon-github icon-2x myicon"></i>
						My-GitHub
					</a>
				</li>
				<li class="shouldhideonscroll hidden-xs">
					<a href="http://blog.csdn.net/ipip2005" target="_blank">
						<i class="icon-sign-blank icon-2x myicon"></i>
						My-CSND
					</a>
				</li>
				<li class="shouldhideonscroll hidden-sm hidden-xs">
					<a href="javascript:activeContact()" target="_blank">
						<i class="icon-user icon-2x myicon"></i>
						Contact-Me
					</a>
				</li>
				<li class="shouldhideonscroll hidden-sm hidden-xs">
					<a href="javascript:bookmarksite('ipip\'s blog','http://ipipblog')">
						<i class="icon-star-empty icon-2x myicon"></i>
						Add-as-Favorite
					</a>
				</li>
				<li class="active">
					<a href="/" target="_top">
						<i class="icon-home icon-2x myicon"></i>
						Home
					</a>
				</li>
				@if(Auth::check())
				<li>
					<a href="http://ipipblog.net/admin/dash-board">
						<i class="icon-leaf icon-2x myicon"></i>
						Dash-Board
					</a>
				</li>
				@endif
			</ul>
		</div>
	</header>
	<main id="main" class="container-fluid master-main">
		<div class="row">
		 	{{$main}}
		</div>
	</main>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<div class="footer-text">
						<p class="text-center">
							对博客或者博文有任何的疑惑，你可以发送邮件给
							<a href="mailto:supersingerman@126.com">supersingerman@126.com</a>
							, 我会尽快回复你。
						</p>
						<div class="text-center">
							<p class="text-center inline">转载请注明<a href="http://ipipblog.net">ipipblog.net</a>,感谢您对ipip的支持。</p>
						<script type="text/javascript" src="http://js.tongji.linezing.com/3513977/tongji.js"></script>
						<noscript><a href="http://www.linezing.com"><img src="http://img.tongji.linezing.com/3513977/tongji.gif"/></a></noscript>
						<a href="http://www.miitbeian.gov.cn/"> 浙ICP备14032327号</a>
						</div>
						
					</div>
				</div>
				<div class="col-xs-1">
					<a class="footer-image" href="http://ipipblog.net">
						<img src="/i/qrcode.png" alt="qrcode" title="qrcode"/>
					</a>
				</div>
			</div>
		</div>
	</footer>
</div>

</div>
{{ HTML::script('./js/custom.js') }}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
	id="contact-modal">
	<div class="modal-dialog text-center">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Leave an easy MESSAGE to Me</h2>
			</div>
			<div class="modal-body">
				{{ Form::open(array('url'=>'comment/message')) }}
        		<fieldset class="fieldset">
                	{{ Form::textarea('message',Input::old('message'),['rows'=>6, 'cols'=>75]) }}
            		{{ Form::submit('send',['class'=>'btn btn-primary']) }}
        		</fieldset>
        		{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
</body>
</html>
