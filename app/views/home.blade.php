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
	{{ Form::open(['url' => 'search','method'=>'get']) }}
	<div class="row">
		<aside class="col-xs-12">
			<div class="row">
				{{ Form::text('search',Input::old('search'),['placeholder'=>'Search in blog...', 'class'=>'img-rounded col-xs-8']) }}
				{{ Form::submit('Search',['class'=>'btn img-rounded col-xs-2']) }}
			</div>
		</aside>
	</div>
	{{ Form::close() }}
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