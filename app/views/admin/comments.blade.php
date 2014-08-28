<div class="col-xs-2">

	<div class="row admin-row">
		<div class="col-xs-12">
			<a href="/admin/dash-board"> <img alt="Post" src="/i/back.png"
				class="admin-img img-rounded fan-img">
			</a>
		</div>
	</div>
	<div class="row">
		<a href="/admin/dash-board">
			<h3 class="admin-text">Back</h3>
		</a>
	</div>

	<div class="row admin-row">
		<div class="col-xs-12">
			<a href="/admin/comment-manage"> <img alt="Post" src="/i/comment.jpg"
				class="admin-img img-rounded fan-img">
			</a>
		</div>
	</div>
	<div class="row">
		<a href="/admin/comment-manage">
			<h3 class="admin-text">Manage comments</h3>
		</a>
	</div>
</div>
<div class="col-xs-10">
	<div class="row">
		<div class="col-xs-12 label-title">
			<h1 class="bg-info">
				<a href="javascript:void(0)" class="inline">{{count($comments)}}</a>
				Comments And<a href="javascript:void(0)" class="inline" id="new"> {{Comment::where('checked', '=', 'false')->count()}}</a>
				New
			</h1>
		</div>
	</div>
	@if(count($comments)>0)
	<div class="row">
		<div class="col-xs-12 article-comments">
			@foreach($comments as $comment)
			<div class="row">
				<br>
			</div>
			<div class="comment-wrap btn-default row" tabIndex="-1">
				<h4 class="col-xs-6">
					<p class="btn-info img-rounded padding-5"><?php
							if ($comment->commenter == '')
								echo 'no_name';
							else
								echo $comment->commenter;
							?><p>
				</h4>
				<h4 class="col-xs-6">
					<p class="btn-info img-rounded padding-5"><?php
						if ($comment->email == '')
							echo 'none';
						else
							echo $comment->email;
						?></p>
				</h4>

				<h3 class="col-xs-12">{{$comment->comment}}</h3>
				<h4 class="bg-info inline col-xs-7 col-xs-offset-1 img-rounded">
				<?php
					if ($comment->article_id!='') echo Article::find($comment->article_id)->title;else
						echo 'From Message Board' 
				?></h4>
				<div class="col-xs-4 text-right">
					<p class="soft-text">{{$comment->created_at}}</p>
				</div>
				<div class="col-xs-12">
					<div class="row margin-5">
						<div class="col-xs-2 col-md-1">
							<div class="inline">
								<a href="/comment/delete?cid=<?php echo $comment->id?>"
									class="btn btn-danger">delete</a>
							</div>
						</div>
						
						<div class="col-xs-10 col-md-11 text-right">
							@if(!$comment->checked)
							<div class="inline" id="comment<?php echo $comment->id?>">
								<h4 class="bg-danger inline padding-5 img-rounded">not checked</h4>
								<button class="btn btn-primary" onclick="checkComment({{$comment->id}})">Set it Checked</button>
							</div>
					
							@endif 
							@if($comment->article_id!='')
							<a
								href="/article/show?aid=<?php echo $comment->article_id.'#'.$comment->id?>"
								class="btn btn-primary" onclick="checkComment({{$comment->id}})">GO</a>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<br>
			</div>
			@endforeach
		</div>
	</div>
	@endif
</div>