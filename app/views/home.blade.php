<div class="col-xs-8">
	<div class="row">
		{{$content}}
	</div>
</div>
<div class="col-xs-3 col-xs-offset-1">
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