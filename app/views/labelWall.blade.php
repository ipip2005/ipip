@if ($labels->count()>0)

<div class="col-xs-12">
	<div class="row margin-0">
		<div class="col-xs-12 text-left">
			<h2 class="soft-text">All Labels</h2>
		</div>
	</div>
	<div class="row margin-0">
		@foreach($labels as $label) <a
			href="/article-at-label?label_id=<?php echo $label->id?>"
			class="bigger text-center btn-lg btn-square z0 white-text
			col-xs-<?php echo 2+($label->article_count>=$ave)?>">
			{{$label->label_name.'('.$label->article_count.')';}} </a>
		<script>
		    function randomColor(){
			    var rmin = parseInt("44", 16), rmax = parseInt('CC',16);
			    var r = parseInt(Math.random()*(rmax-rmin)+rmin).toString(16);

			    var gmin = parseInt("44", 16), gmax = parseInt('CC',16);
			    var g = parseInt(Math.random()*(gmax-gmin)+gmin).toString(16);

			    var bmin = parseInt("44", 16), bmax = parseInt('EE',16);
			    var b = parseInt(Math.random()*(bmax-bmin)+bmin).toString(16);
			    return '#'+r+g+b;
		    }
			$('a:last').css("background-color",randomColor());
		</script>
		<!-- #4BAFF1 #74C974 -->
		@endforeach
	</div>
</div>
@endif
