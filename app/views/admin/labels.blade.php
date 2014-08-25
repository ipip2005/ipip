<div class="col-xs-2">
	
	<div class="row admin-row">
		<div class="col-xs-12">
			<a href="/admin/dash-board">
				<img alt="Post" src="/i/back.png" class="admin-img img-rounded fan-img">
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
			<a href="/admin/label-manage">
				<img alt="Post" src="/i/label.jpg" class="admin-img img-rounded fan-img">
			</a>
		</div>
	</div>
	<div class="row">
		<a href="/admin/label-manage">
			<h3 class="admin-text">Manage labels</h3>
		</a>
	</div>
</div>
<div class="col-xs-10">
	<div class="row">
		<div class="col-xs-12 label-title">
			<h1>
				已有标签<a href="javascript:void(0)" class="inline">{{count($labels)}}</a>
				个
			</h1>
		</div>
	</div>
	<div class="row">
		@if(is_array($labels))
		@foreach($labels as $label)
			<button class="col-xs-2 btn btn-primary">
				{{$label->label_name}}
			</button>
		@endforeach
		@endif
		<a id="pop-a" href="javascript:void(0)" type="button" class="col-xs-1 btn btn-info bs-docs-popover" data-toggle="popover" title="Adding new Label"
			data-content="here" data-placement="bottom" data-trigger="focus" aria-describedby="popover-a">
			<i class="icon-plus"></i>
		</a>
		<div class="popover fade left in" role="tooltip" id="popover-a" style="top: 21451px; left: -165px; display: block;">
			<div class="arrow">
			</div>
			<h3 class="popover-title" style="display: none;">
			</h3>
			<div class="popover-content">Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</div>
		</div>
	</div>
</div>
