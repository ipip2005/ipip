<div>
	<h3>Recent Articles</h3>
	<ul>
	@foreach($recentArticles as $article)
		<li>{{link_to_route('article.show',$article->title,$article->id)}}</li>
	@endforeach
	</ul>
</div>
