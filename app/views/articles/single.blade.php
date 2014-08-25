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
			<div class="col-xs-4">
			</div>
			<div class="col-xs-2">
				<button class="btn btn-primary"  
					onclick="window.location.href='/article/edit?aid=<?php echo $article->id?>'">
				编辑
				</button>
			</div>
			<div class="col-xs-2">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-delete">
				删除
				</button>
				<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete</h4>
							</div>
							<div class="modal-body">
								<p> are you sure ?</p>
							</div>
							<div class="modal-footer">
        						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        						<button type="button" class="btn btn-primary" onclick="window.location.href='/article/delete?aid=<?php echo $article->id?>'">Confirm Delete</button>
      						</div>
      					</div>
					</div>
				</div>
			</div>
			<div class="col-xs-2">
				<button class="btn btn-primary">
				隐藏
				</button>
			</div>
			<div class="col-xs-2">
				<button class="btn btn-primary">
				呵呵
				</button>
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