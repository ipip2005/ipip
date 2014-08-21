<div>
	<h3>Recent Articles</h3>
	<ul>
	@foreach($recentArticles as $article)
		<a href="/article/show?aid=<?php echo $article->id?>">
			{{$article->title}}
		</a>
	@endforeach
	</ul>
</div>
