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
</head>
<body>
<div class="wrap">

	<header>
		<div class="logo">
			<a href="/" target="_TOP">
				<img src="/i/my_pic.jpg" alt="ipip" class="logoimg">
			</a>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="blog-title">
						<h1>
							<a href="/">ipip's blog</a>
						</h1>
						<h2>A Level 1 Light Mage</h2>
					</div>
				</div>
			</div>
		</div>
		
		<div class="link">
			<ul class="nav">
				<li class="active">
					<a href="/" target="_top">
						<i class="icon-home icon-2x myicon"></i>
						Home
					</a>
				</li>
				<li>
					<a href="https://github.com/ipip2005" target="_blank">
						<i class="icon-github icon-2x myicon"></i>
						My-GitHub
					</a>
				</li>
				<li>
					<a href="http://blog.csdn.net/ipip2005" target="_blank">
						<i class="icon-sign-blank icon-2x myicon"></i>
						My-CSND
					</a>
				</li>
				<li>
					<a href="javascript:bookmarksite('ipip\'s blog',http://ipipblog)">
						<i class="icon-star-empty icon-2x myicon"></i>
						Add-as-Favorite
					</a>
				</li>
			</ul>
		</div>
	</header>
	<main class="container-fluid">
		{{$main}}
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
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
{{ HTML::script('./js/bootstrap.min.js') }}
{{ HTML::script('./js/custom.js') }}
</body>
</html>