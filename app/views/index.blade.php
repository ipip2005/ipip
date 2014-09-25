<div class="col-xs-7">
{{$articles->links()}}
</div>
<div class="col-xs-5 padding-top-30 search">
{{ Form::open(['url' => 'search','method'=>'get']) }}
	<div class="row">
		{{ Form::text('search',Input::old('search'),['placeholder'=>'Search in blog...', 'class'=>'img-rounded col-xs-9']) }}
		<button type="submit" class="btn btn-info img-circle col-xs-1 col-xs-offset-1 padding-2"><i class="icon-search"></i></button>
	</div>
{{ Form::close() }}
</div>
<div class="col-xs-12 divider img-rounded">
</div>
@foreach($articles as $article)
	<article class="article col-xs-12 padding-0">
		<header class="article-header row bg-success">
			<h2 class="article-title col-xs-12">
				<a href="/article/show?aid=<?php echo $article->id?>">
					{{$article->title}}
				</a>
			</h2>
			
			<div class="col-xs-6">
				<span class="soft-text"><i class="icon-pencil"></i> {{$article->comment_count}} comments </span>
			</div>
			<div class="col-xs-6 align-right">
				<span class="soft-text">
					@if(Auth::check() && $article->hidden)
					<div class="inline fire-text">HIDDEN</div>
					@endif
					<i class="icon-group"></i> <?php
					$count = Redis::get($article->id);
					if ($count == '') echo '0'; else echo $count; 
				?> visits <i class="icon-tag"></i> created_at: {{$article->created_at}}</span>
			</div>
			@if(count($article->labels()->get())>0)
				@foreach($article->labels as $label)
				<a
				href="/article-at-label?label_id=<?php echo $label->id?>"
				class="col-xs-4 col-md-2 text-center bigger inline">
				<p class="bg-custom img-rounded soft-text">{{$label->label_name}}</p>
				</a>
				
				@endforeach	
		
			@endif
		</header>
		
	</article>
@endforeach
<div class="col-xs-12">
{{$articles->links()}}
</div>
<script>
	$(document).ready(function(){
		$('.article-header').mouseenter(function(){
			$(this).css({
				"box-shadow":"6px 6px 6px rgba(0,0,0,0.25)",
			});
			$(this).removeClass('bg-success');
			$(this).addClass("bg-near-success");
		});
		$('.article-header').mouseleave(function(){
			$(this).css({
				"box-shadow":"1px 1px 1px rgba(0,0,0,0.25)",
			});
			$(this).removeClass("bg-near-success");
			$(this).addClass('bg-success');
		});
	});
</script>
