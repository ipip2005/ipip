<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    @section('title')
        <title>{{{$title}}}</title> 
    @show
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/custom.css') }}
    {{ HTML::style('css/font-awesome.css') }}
     <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	{{ HTML::script('./js/bootstrap.min.js') }}
</head>
<body onload="on_load()">
<div class="wrap">
	<header id="main-header" class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="blog-title">
						<h1>
							<a href="/">ipip's blog</a>
						</h1>
						<label><h2>A Level 1 Light Mage</h2></label>
					</div>
				</div>
			</div>
		</div>
		
		<div id="navbar" class="link">
			<ul class="nav">
				<li class="active">
					<a href="/" target="_top">
						<i class="icon-home icon-2x myicon"></i>
						Home
					</a>
				</li>
				<li class="shouldhideonscroll">
					<a href="https://github.com/ipip2005" target="_blank">
						<i class="icon-github icon-2x myicon"></i>
						My-GitHub
					</a>
				</li>
				<li class="shouldhideonscroll">
					<a href="http://blog.csdn.net/ipip2005" target="_blank">
						<i class="icon-sign-blank icon-2x myicon"></i>
						My-CSND
					</a>
				</li>
				<li class="shouldhideonscroll">
					<a href="javascript:void(0)" id="ele9" class="tigger" target="_blank">
						<i class="icon-user icon-2x myicon"></i>
						Contact-Me
					</a>
				</li>
				<li class="shouldhideonscroll">
					<a href="javascript:bookmarksite('ipip\'s blog','http://ipipblog')">
						<i class="icon-star-empty icon-2x myicon"></i>
						Add-as-Favorite
					</a>
				</li>
				@if(Auth::check())
				<li>
					<a href="/admin/dash-board">
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
				<div class="col-xs-12">
					<div class="footer-text">
						<p class="text-center">
							对博客或者博文有任何的疑惑，你可以发送邮件给
							<a href="mailto:supersingerman@126.com">supersingerman@126.com</a>
							, 我会尽快回复你。
						</p>
						<p class="text-center">感谢您对ipip的支持。</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

</div>
{{ HTML::script('./js/custom.js') }}
{{ HTML::script('./js/popuplayer.js') }}
<div class="popupLayer" id="popup-layer">
	<div id="blk9" class="blk" style="opacity: 1;">
		<div class="head"><div class="head-right"></div></div>
		<div class="main">
			<div class="title">
				<h2>Leave a easy MESSAGE here</h2>
				<a href="javascript:void(0)" id="close9" class="closeBtn">X</a>
			</div>
			{{ Form::open(array('url'=>'comment/message')) }}
        		<fieldset class="fieldset">
                	{{ Form::textarea('message',Input::old('message'),['rows'=>5, 'cols'=>75]) }}
            		{{ Form::submit('send',['class'=>'btn btn-primary']) }}
        		</fieldset>
        	{{ Form::close() }}
		</div>
    	<div class="foot"><div class="foot-right"></div></div>
	</div>
</div>
<script>
    	$(document).ready(contactboard());
</script>
</body>
</html>