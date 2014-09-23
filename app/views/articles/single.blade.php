<!-- 配置文件 -->
<script type="text/javascript"
	src="/js/third-party/SyntaxHighlighter/shCore.js"></script>
<link rel="stylesheet"
	href="/js/third-party/SyntaxHighlighter/shCoreDefault.css"
	type="text/css" />
<script>
SyntaxHighlighter.all() //执行代码高亮
</script>
<!-- modal dialog for creating a dialog when click on the picture
  -- it should be autofit-width -->
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
	id="pic-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>


<div class="article-wrap">
	<div class="col-xs-12 article-main">
		<div class="row article-title">
			<div class="col-xs-12 text-center">
				<h1 id='title'>{{$article->title}}</h1>
			</div>
		</div>

		<div class="row article-labels">
			@foreach($mylabels as $label) <a
				href="/article-at-label?label_id=<?php echo $label->id?>"
				class="col-xs-4 col-md-2 text-center bigger inline">
				<p class="bg-info img-rounded soft-text">{{$label->label_name}}</p>
			</a> @endforeach
		</div>
		
		<div class="row">
			<div class="col-xs-12 article-divider"></div>
		</div>
		<div class="right-text">
			<div class="col-xs-6 text-left">
				<span class="bg-default img-rounded padding-5 soft-text"><i
					class="icon-tag"></i> created at {{$article->created_at}}</span>
			</div>
			<div class="col-xs-6 text-right">
				<span class="bg-default img-rounded padding-5 soft-text"> <i
					class="icon-group"></i> <?php
					$count = Redis::get ( $article->id );
					if ($count == '')
						echo '0';
					else
						echo $count;
					?> visits 
					<i class="icon-pencil"></i> last updated at
					{{$article->updated_at}}
				</span>
			</div>
		</div>
		@if (Auth::check())
		<div class="row article-control">
			<div class="col-xs-3"></div>
			<button class="btn btn-primary col-xs-2 margin-5"
				onclick="removeSession();
					window.location.href='/article/edit?aid=<?php echo $article->id?>';">
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
			<button class="btn btn-primary col-xs-2 margin-5"
				onclick="toggleHidingButton({{$article->id}})" id='hiding'>
				@if($article->hidden) Show 
				@else Hide 
				@endif
			</button>
			<button class="btn btn-primary col-xs-2 margin-5" data-toggle="modal"
				data-target="#modal-label">Label</button>
			<div class="modal fade" id="modal-label" tabindex="-1" role="dialog"
				aria-hidden="true" aria-labelledby="myModalLabel">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Adding labels for this article</h4>
						</div>
						{{Form::open(array('url'=>'article/update-labels'))}}
						<div class="modal-body">
							@foreach($labels as $label)
							<div class="checkbox">
								<label> <input type="checkbox" name="<?php echo $label->id?>"<?php
								if (in_array ( $label->id, $article->labels ()->getRelatedIds () ))
									echo 'checked = "true"';
								?>"> {{$label->label_name}}
								</label>
							</div>
							@endforeach
						</div>
						<div class="modal-footer">
							<a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
							<input type="submit" class="btn btn-primary" value='Confirm'>
						</div>
						<input type="hidden" name="article_id"
							value="<?php echo $article->id?>"> {{Form::close() }}
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
		<div class="row fb-articles soft-text">
			<div>
				@if(isset($b_article))
				<b class="col-xs-1 padding-2">Last:</b>
				<a href="/article/show?aid=<?php echo $b_article->id?>" class="inline">
					
					<b class="col-xs-5 text-center">&nbsp;&nbsp;&nbsp;&nbsp;{{$b_article->title}}</b>
				</a>
				@else
				<p class="col-xs-5">Already oldest</p>
				{{$b_article}}
				@endif
			</div>
			<div>
				@if(isset($f_article))
				<b class="col-xs-1 padding-2">Next:</b>
				<a href="/article/show?aid=<?php echo $f_article->id?>" class="inline">
					
					<b class="col-xs-5 text-center">&nbsp;&nbsp;&nbsp;&nbsp;{{$f_article->title}}</b>
				</a>
				@else
				<p class="col-xs-5">Already newest</p>
				@endif
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a></div>
			<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","renren","tieba","douban","t163","youdao","ty","fbook","twi","copy","print"],"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["tsina","renren","weixin","sqq"],"viewText":"分享到：","viewSize":"16"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
		</div>
		<div class="row">
			<div class="col-xs-12 article-divider"></div>
		</div>
		@if($article->comment_count>0)
		<div class="row">
			<div class="col-xs-12 article-comments">
				<div class="row">
					<h3 class="col-xs-12 soft-text">Comments:</h3>
				</div>
				@foreach($article->comments as $comment) <a
					id="<?php echo $comment->id?>" name="<?php echo $comment->id?>"></a>
				<div class="row">
					<br>
				</div>
				<div class="comment-wrap btn-default img-rounded row" tabIndex="-1"
					onfocus="toggleHiddenComment({{$comment->id}})"
					onblur="toggleHiddenComment({{$comment->id}})">
					<h4 class="col-xs-6">
						<p class="btn-info img-rounded padding-5">name:
							<?php
							if ($comment->commenter == '')
								echo 'no_name_' . $comment->id;
							else
								echo $comment->commenter;
							?>
						
						
						
						<p>
					
					</h4>
					<h4 class="col-xs-6">
						<p class="btn-info img-rounded padding-5">c-i:<?php
						if ($comment->email == '')
							echo 'none';
						else
							echo $comment->email;
						?></p>
					</h4>

					<h3 class="col-xs-12">{{$comment->comment}}</h3>
					<div class="col-xs-12 text-right">
						<p class="soft-text">{{$comment->created_at}}</p>
					</div>
					<div class="col-xs-12 right-text margin-5">
						@if(Auth::check()) <a
							href="/comment/delete?cid=<?php echo $comment->id?>"
							class="btn btn-danger" id="hidden<?php echo $comment->id?>"
							style="display: none;">delete</a> @endif <a
							onclick="javascript:reply('<?php
							if ($comment->commenter == '')
								echo 'no_name_' . $comment->id;
							else
								echo $comment->commenter;
							?>')"
							href="#leave-comment" class="btn btn-primary">reply</a>
					</div>
				</div>
				<div class="row">
					<br>
				</div>
				@endforeach
			</div>
		</div>
		@endif
		<div class="row">
			<a id="leave-comment" name="leave-comment"></a>
			<div class="col-xs-12">
				<fieldset>
					<legend class="soft-text">Leave a Comment:</legend>
					{{Form::open(array('url'=>'article/comment', 'id'=>'form'))}}
					<div class="row">
						{{Form::text('commenter-name',Input::old('username'),
						['placeholder'=>'Your name', 'class'=>'btn-lg img-rounded col-xs-3
						col-xs-offset-1'])}}
						{{Form::text('commenter-contact-information',Input::old('contact-information'),
						['placeholder'=>'email address or something','class'=>'btn-lg
						img-rounded col-xs-6 col-xs-offset-1'])}}</div>
					<div class="row">
						<br>
					</div>
					<div class="row">
						{{Form::textarea('comment-content',Input::old('comment-content'),
						['id'=>'comment-content', 'placeholder'=>' print anything you want! not empty', 'class'=>'btn-lg img-rounded col-xs-12
						comment-area left-text'])}}</div>
					<div class="row">
						<br> @if($errors->has()) @foreach ($errors->all() as $message)
						<pre class="col-xs-12 btn-lg bg-danger center-text">{{$message}}</pre>
						@endforeach @endif @if(Session::has('failure'))
						<pre class="col-xs-12 btn-lg bg-danger center-text">{{Session::get('failure')}}</pre>
						@endif
					</div>

					<div class="row">
						<div class="col-xs-6 text-center">
							<a onclick="javascript:render()" class="btn btn-lg btn-info"
								id="render">Render Editor</a>
						</div>
						<div class="col-xs-6 text-center">
							<button class="btn btn-lg btn-primary" id="send">Send</button>
							<a href="javascript:void(0)" class="btn btn-lg btn-danger"
								id='cancel' style="display: none;" onclick="cancelSend()">Cancel</a>
							<button class="btn btn-lg btn-primary" id='sure'
								style="display: none;">Sure</button>
							<p class="bg-danger" id="suretext"></p>
						</div>
					</div>
					{{Form::hidden('article_id',$article->id)}}
					{{Form::close()}}
					<div class="row height-5"></div>
					<script>$(function(){
						$("form#form").bind("submit", function(){
							return checkCommentNotEmpty();
						});
						});
					</script>
				</fieldset>
			</div>
		</div>
	</div>
</div>
<script>$(function(){
	countVisit({{$article->id}})});
</script>
{{HTML::script('/js/ueditor.config.js')}}
<!-- 编辑器源码文件 -->
{{HTML::script('/js/ueditor.all.min.js')}}
