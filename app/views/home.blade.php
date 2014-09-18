<div class="col-xs-1 col-md-1">
	<div class="hiddenbox" id="hiddenbox" style="display:none">
		<button class="btn btn-primary img-rounded to-top padding-5" onclick="scrollToTop()">
			<i class="icon-chevron-up"></i>
		</button>
	</div>
</div>
<div class="col-xs-11 col-md-9 home-wrap">
	<div class="row">
		{{$content}}
	</div>
</div>
<div class="col-xs-11 col-xs-offset-1 col-md-2 col-md-offset-0">
    <div class="row">
    	<aside class="col-xs-12">
    		<script type="text/javascript">document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E%3Cscript charset="utf-8" src="http://rp.baidu.com/rp3w/3w.js?sid=9570093733661031698') + '&t=' + (Math.ceil(new Date()/3600000)) + unescape('"%3E%3C/script%3E'));</script>
    	</aside>
    </div>
	<div class="row">
		<aside class="sidebar col-xs-12">
		@include('sidebar/recentArticles')
		</aside>
	</div>
	<div class="row">
		<aside class="sidebar col-xs-12">
		@include('sidebar/highRateArticles')
		</aside>
	</div>
	
	
</div>