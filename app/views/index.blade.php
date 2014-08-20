@foreach($articles as $article)
	<article class="article">
		<header class="article-header">
			<h1 class="article-title">
				{{link_to_route('article.show',$article->title,$article->id)}}
			</h1>
			<div class="clearfix">
				<span class="left date">{{explode(' ',$article->created_at)[0]}}</span>
				<span class="right label">{{$article->comment_count}} comments </span>
			</div>
		</header>
		<div class="article-content">
			<p>{{$article->content}}</p>
		</div>
		<footer class="article-footer">
			<hr>
		</footer>
	</article>
@endforeach
{{$articles->links()}}
