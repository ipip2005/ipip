{{HTML::script('/js/ueditor.config.js')}}
<!-- 编辑器源码文件 -->
{{HTML::script('/js/ueditor.all.min.js')}}
<div class="article-wrap">
	<div class="col-xs-12 article-main">
		<div class="row article-title">
			<div class="col-xs-12">
				<div id='title'>{{$article->title}}</div>
			</div>
		</div>

		<div class="row article-labels">
			@foreach($mylabels as $label)
			<a href="/article-at-label?label_id=<?php echo $label->id?>" class="col-xs-4 col-md-2 text-center">
				<p class="bg-info img-rounded">{{{$label->label_name}}}</p>
			</a>
			@endforeach
		</div>

		<div class="row">
			<div class="col-xs-12 article-divider"></div>
		</div>
		@if (Auth::check())
		<div class="row article-control">
			<div class="col-xs-3"></div>
			<button class="btn btn-primary col-xs-2 margin-5"
				onclick="window.location.href='/article/edit?aid=<?php echo $article->id?>'">
				Edit</button>
			<button class="btn btn-primary col-xs-2 margin-5" data-toggle="modal"
				data-target="#modal-delete">Delete</button>
			<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog"
				aria-hidden="true" aria-labelledby="myModalLabel">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Delete</h4>
						</div>
						<div class="modal-body">
							<p>are you sure ?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary"
								onclick="window.location.href='/article/delete?aid=<?php echo $article->id?>'">Confirm
								Delete</button>
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-primary col-xs-2 margin-5">Hide</button>
			<button class="btn btn-primary col-xs-2 margin-5" data-toggle="modal" data-target="#modal-label">Label</button>
			<div class="modal fade" id="modal-label" tabindex="-1"
					role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Adding labels for this article</h4>
							</div>
							{{Form::open(array('url'=>'article/update-labels'))}}
							<div class="modal-body">
								@foreach($labels as $label)
								<div class="checkbox">
									<label>
										<input type="checkbox" name="<?php echo $label->label_name?>"
											<?php
											if (in_array($label->id, $article->labels()->getRelatedIds()))echo 
												'checked = "true"'; 
											?>"> {{$label->label_name}} 
									</label>
								</div>
								@endforeach
							</div>
							<div class="modal-footer">
								<a type="button" class="btn btn-default"
									data-dismiss="modal">Close</a>
								<input type="submit" class="btn btn-primary" value='Confirm'>
							</div>
							<input type="hidden" name="article_id" value="<?php echo $article->id?>">
							{{Form::close() }}
						</div>
					</div>
				</div>
		</div>
		@endif
		<div class="row article-content">
			<div class="col-xs-12">
				<div id='content'>{{$article->content}}</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 article-divider"></div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<fieldset>
					<legend>Leave a Comment</legend>
						{{Form::open(array('url'=>'article/comment'))}}
						<div class="row">
							{{Form::text('commenter-name',Input::old('username'),['placeholder'=>'Your name', 'class'=>'btn btn-lg img-rounded col-xs-3 col-xs-offset-1'])}}
							{{Form::text('commenter-contact-information',Input::old('contact-information'),
								['placeholder'=>'email address or something','class'=>'btn btn-lg img-rounded col-xs-6 col-xs-offset-1'])}}
						</div>
						<div class="row">
							{{Form::textarea('comment-content',Input::old('comment-content'),
								['id'=>'comment-content', 'placeholder'=>'print anything you want!   not empty', 'class'=>'btn btn-lg img-rounded col-xs-12 comment-area'])}}
						</div>
						<div class="row">
							<div class="col-xs-6 text-center">
								<a href="javascript:render()" class="btn btn-lg btn-info">
									Render an editor
								</a>
							</div>
							<div class="col-xs-6 text-center">
								<button class="btn btn-lg btn-primary">
									Send
								</button>
							</div>
						</div>
						{{Form::close()}}
						<div class="row height-5">
						</div>
				</fieldset>
			</div>
		</div>
	</div>
</div>