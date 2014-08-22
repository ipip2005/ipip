<div class="article-wrap">
	<div class="col-xs-12 article-main">
		<div class="row article-title">
			<div class="col-xs-12">
				<div id='title'>{{$article->title}}</div>
			</div>
		</div>
		
		<div class="row article-labels">
			@foreach($labels as $label)
			<div class="col-xs-2 col-md-1">
				<p class="bg-primary">
					{{{$label->label_name}}}
				</p>
			</div>
			@endforeach 
		</div>
		
		<div class="row">
			<div class="col-xs-12 article-divider">
			</div>
		</div>
		@if (Auth::check())
		<div class="row article-control">
			<div class="col-xs-8">
			</div>
			<div class="col-xs-1">
				<a class="bg-info">
				编辑
				</a>
			</div>
			<div class="col-xs-1">
				<a class="bg-info">
				删除
				</a>
			</div>
			<div class="col-xs-1">
				<a class="bg-info">
				隐藏
				</a>
			</div>
			<div class="col-xs-1">
				<a class="bg-info">
				呵呵
				</a>
			</div>
		</div>
		@endif
		<div class="row article-content">
			<div class="col-xs-12">
				<div id='content'>{{$article->content}}</div>
			</div>
		</div>
	</div>
</div>