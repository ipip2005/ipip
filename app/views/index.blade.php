@foreach($articles as $article)
	<article class="article col-xs-12">
		<header class="article-header row img-rounded bg-success">
			<h1 class="article-title col-xs-12">
				<a href="/article/show?aid=<?php echo $article->id?>">
					{{$article->title}}
				</a>
			</h1>
			<div class="col-xs-6">
				<span class="soft-text">{{$article->comment_count}} comments </span>
			</div>
			<div class="col-xs-6 align-right">
				<span class="soft-text">created_at: {{$article->created_at}}</span>
			</div>
		</header>
		<footer class="article-footer">
			<hr>
		</footer>
	</article>
@endforeach
{{$articles->links()}}
