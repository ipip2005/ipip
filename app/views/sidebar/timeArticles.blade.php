<div class="bg-info img-rounded sidebar-in">
	<h3 class="sidebar-title soft-text">
		<i class="icon-time"></i>
		Time</h3>
	@foreach($times as $year=>$timeset)
		<div class="row sidebar-item">
			<div class="col-xs-12">
				<a href="javascript:toggleyear(<?php echo $year?>)" class="bg-primary padding-5">
				{{$year.'年'}}
				</a>
			</div>
			<div class="year" id="year<?php echo $year?>">
			@foreach($timeset as $time=>$value)
			<a href="/time?tid=<?php echo $year.'-'.$time?>" class="col-xs-7 col-xs-offset-4 bg-near-success padding-2 showed">
			     <b>{{intval($time).' 月'}}</b>
			</a>
			@endforeach
			</div>
			<div class="col-xs-12"><br></div>
		</div>
	@endforeach
</div>
