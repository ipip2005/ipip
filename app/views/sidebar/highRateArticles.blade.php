<div class="bg-info img-rounded sidebar-in">
	<h3 class="sidebar-title">Order By Total Visits</h3>
	@foreach($highRateArticles as $article)
		<div class="row sidebar-item">
			<div class="col-xs-12">
				<label class="bg-primary img-rounded">
				{{$article->read_count}}
				</label>
			</div>
			<div class="col-xs-12">
				<a href="/article/show?aid=<?php echo $article->id?>">
					{{$article->title}}
				</a>
			</div>
		</div>
	@endforeach
</div>
