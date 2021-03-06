<!-- 配置文件 -->
<script type="text/javascript"
	src="/js/third-party/SyntaxHighlighter/shCore.js"></script>
<link rel="stylesheet"
	href="/js/third-party/SyntaxHighlighter/shCoreDefault.css"
	type="text/css" />
<script>
SyntaxHighlighter.all() //执行代码高亮
</script>
{{HTML::script('/js/ueditor.config.js')}}
<!-- 编辑器源码文件 -->
{{HTML::script('/js/ueditor.all.min.js')}}
<script type="text/javascript">
	var uet = UE.getEditor('container-title',{
        initialFrameHeight : 30,
        saveInterval : 10000,
        maximumWords : 1000,
        elementPathEnabled : false,
       	textarea : 'title',
       	topOffset : 32,
        toolbars: [
                   [
                       'subscript', //下标
                       'superscript', //上标
                       'pasteplain',
                       '|', //分隔线
                       'time', //时间
                       'date', //日期
                       '|', //分隔线
                       'insertcode', //代码语言
                       'fontfamily', //字体
                       'fontsize', //字号
                       '|', //分隔线
                       'emotion', //表情
                       'spechars', //特殊字符
                       '|', //分隔线
                       'forecolor', //字体颜色
                       'backcolor', //背景色
                   ]
               ]
    });
    var ue = UE.getEditor('container-content',{
    	topOffset : 42,
        initialFrameHeight : 600,
        saveInterval : 10000,
        maximumWords : 100000,
        textarea : 'content',
        allowDivTransToP:false,
        maxUndoCount : 50,
        maxInputCount : 1,
    });
</script>

<div class="row">
	<div class="col-xs-12">
		<h1 class="admin-text">Article</h1>
	</div>
</div>
<!-- 加载编辑器的容器 -->
<div class="row">
	<div class="editor-wrap">
		{{ Form::open(array('url' => 'admin/article')) }}
		<pre class="bg-primary">title</pre>
		<script id="container-title" name="title" type="text/plain">{{Session::get('title')}}</script>
		<div class="col-xs-12">
			<div class="row">
				@if(Session::has('error')) <span
					class="col-xs-12 btn-lg bg-danger center-text">
					{{Session::get('error')}} </span> <br> @endif
				@if(Session::has('success')) <span
					class="col-xs-12 btn-lg bg-success center-text">
					{{Session::get('success')}} </span> <br> @endif
			</div>
		</div>

		@if($errors->has()) @foreach ($errors->all() as $message)
		<pre class="col-xs-12 btn-lg bg-danger center-text">{{$message}}</pre>
		@endforeach @endif @if(Session::has('failure'))
		<pre class="col-xs-12 btn-lg bg-danger center-text">{{Session::get('failure')}}</pre>
		@endif
		<pre class="bg-primary">content</pre>

		<script id="container-content" name="content" type="text/plain">{{Session::get('content')}}</script>
		{{ Form::submit('POST',['class'=>'btn btn-primary col-xs-1']) }} <input
			Type="button" name="save"
			class="btn btn-primary col-xs-1 col-xs-offset-10" value="SAVE"
			onclick="save_article()"> {{ Form::close() }}
	</div>
</div>
