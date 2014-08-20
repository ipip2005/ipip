<div class="span8">
	<div class="row">
		{{$content}}
	</div>
</div>
<div class="span4">
	<div class="row">
		<aside class="sidebar">
		@include('sidebar/recentArticles')
		</aside>
	</div>
	<div class="row">
		<aside class="sidebar">
		@include('sidebar/highRateArticles')
		</aside>
	</div>
</div>