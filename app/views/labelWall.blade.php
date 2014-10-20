@if ($labels->count()>0)

<div class="col-xs-12">
	<div class="row margin-0">
		<div class="col-xs-12 text-left">
			<h2 class="soft-text">All Labels</h2>
		</div>
	</div>
	<div class="row margin-0">
		<?php static $line_sum=0;?>
		@foreach($labels as $label) <a
		    rel="nofollow"
			href="/article-at-label?label_id=<?php echo $label->id?>"
			class="bigger text-center btn-lg btn-square z0 white-text
			col-xs-<?php if ($line_sum==10 || $line_sum==9) {echo 12-$line_sum;$line_sum=0;} else
				if ($line_sum==8){echo 2;$line_sum=$line_sum+2;}else{ 
				$num=2+($label->article_count>=$ave);$line_sum=$line_sum+$num;echo $num;}?> not-break">
			<b>{{$label->label_name.'('.$label->article_count.')';}}</b> </a>
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
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- ad1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-1111817816732851"
     data-ad-slot="3960458927"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>