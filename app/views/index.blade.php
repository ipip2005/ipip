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
			@if(count($article->labels()->get())>0)
				<?php $a=0?>
				@foreach($article->labels as $label)
				<a href="/article-at-label?label_id=<?php echo $label->id?>"
					class="col-xs-3 img-rounded text-center <?php		
					if (($a+$a/4)%2 == 0) echo 'btn-primary'; else
						echo'btn-info'; 
					$a = $a + 1;
					?>">
					{{$label->label_name}}
				</a>	
				@endforeach	
		
			@endif
		</header>
		<footer class="article-footer">
			<hr>
		</footer>
	</article>
@endforeach
{{$articles->links()}}
