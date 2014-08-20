<div>
	<h3>Order By Total Visits</h3>
	<ul>
	@foreach($highRateArticles as $article)
		<li>{{link_to_route('article.show',$article->title,$article->id)}}</li>
	@endforeach
	</ul>
</div>
