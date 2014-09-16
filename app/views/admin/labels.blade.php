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
			<h1 class="bg-info">
				<a href="javascript:void(0)" class="inline">{{count($labels)}}</a>
				Labels
			</h1>
		</div>
	</div>
	<div class="row">
		@foreach($labels as $label)
			<a href="/article-at-label?label_id=<?php echo $label->id?>"
				class="col-xs-2 btn btn-lg margin-5 <?php
				STATIC $a = 0;
				if ($a == 0) echo 'btn-primary'; else
					echo'btn-info'; 
				$a = 1-$a;
				?>">
				{{$label->label_name.'('.count($label->articles()->get()).')'}}
			</a>
		@endforeach
		<a tabindex="0" class="btn btn-lg btn-danger bs-docs-popover col-xs-2 margin-5" data-toggle="popover" 
			data-placement="bottom" data-container="body" data-trigger="click" title="Create a new label" data-content="
			<form method='get' action='/label/create/'>
				<div class='content-wrap'>
					<div class='content-container'>
						<div class='row padding-5'>
							<input type='text' name='label_name' placeholder='new label name' class='col-xs-12 img-rounded'>	
						</div>
						<div class='row padding-5'>
							<input type='text' name='father_label_name' placeholder='father`s name if exists' class='col-xs-12 img-rounded'>	
						</div>
						<div class='row padding-5'>
							<input type='submit' class='btn btn-primary' value='ok' class='col-xs-12'>
						</div>
					
					</div>
				</div>
			</form>
			">
			<i class="icon-plus"></i>
		</a>
		<a tabindex="0" class="btn btn-lg btn-danger bs-docs-popover col-xs-2 margin-5" data-toggle="popover" 
			data-placement="bottom" data-container="body" data-trigger="click" title="Delete a label" data-content="
			<form method='get' action='/label/delete/'>
				<div class='content-wrap'>
					<div class='content-container'>
						<div class='row padding-5'>
							<input type='text' name='label_name' placeholder='label name' class='col-xs-12 img-rounded'>	
						</div>
						<div class='row padding-5'>
							<input type='submit' class='btn btn-primary' value='ok' class='col-xs-12'>
						</div>
					
					</div>
				</div>
			</form>
			">
			<i class="icon-minus"></i>
		</a>
		<script>
			$(function () 
			      { $("[data-toggle='popover']").popover({html : true});
			      });
      	</script>

	</div>
	<div class="row">
		@if($errors->has())
			@foreach ($errors->all() as $message)
				<span class="col-xs-12 btn-lg bg-warning center-text">
					{{$message}}
				</span>
				<br>
			@endforeach
		@endif
		@if(Session::has('error'))
			<span class="col-xs-12 btn-lg bg-danger center-text">
					{{Session::get('error')}}
			</span>
			<br>
		@endif
		@if(Session::has('success'))
			<span class="col-xs-12 btn-lg bg-success center-text">
					{{Session::get('success')}}
			</span>
			<br>
		@endif
	</div>
</div>
