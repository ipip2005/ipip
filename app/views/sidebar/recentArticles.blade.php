<div class="bg-info img-rounded sidebar-in">
	<h3 class="sidebar-title">Recent Articles</h3>
	@foreach($recentArticles as $article)
		<div class="row sidebar-item">
			<div class="col-xs-12">
				<label class="bg-primary img-rounded padding-5">
				{{$article->created_at.' '}}
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
