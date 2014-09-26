<div class="bg-info img-rounded sidebar-in">
	<h3 class="sidebar-title fire-text">
		<i class="icon-fire"></i>
		Hot</h3>
	@foreach($high as $num => $data)
	<?php
		$id = $data[0];
		$count = $data[1]; 
		$article = Article::find($id)
	?>
	@if(Auth::check() || !$article->hidden)
	<div>
		<div class="row sidebar-item">
			<div class="col-xs-12">
				<label class="bg-primary padding-5">
				<i class="icon-group icon-2x"></i> {{$count}}
				</label>
			</div>
			<div class="col-xs-12">
				<a href="/article/show?aid=<?php echo $id?>">
					{{$article->title}}
				</a>
			</div>
			<div class="col-xs-12"><br></div>
		</div>
	</div>
	@endif
	@endforeach
</div>
