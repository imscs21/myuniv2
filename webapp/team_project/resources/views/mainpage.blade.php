<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<!--
	<link href="mainpage.css" rel="stylesheet" type="text/css" />
	-->
    {{ HTML::style("css/mainpage.css") }}
    @include("mobileview.init")
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	
	<script type="text/javascript">
	function initMoving(target, position, topLimit, btmLimit) {
		if (!target)
			return false;

		var obj = target;
		var initTop = position;
		var bottomLimit = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight) - btmLimit - obj.offsetHeight;
		var top = initTop;

		obj.style.position = 'absolute';

		if (typeof(window.pageYOffset) == 'number') {
			var getTop = function() {
				return window.pageYOffset;
			}
		} else if (typeof(document.documentElement.scrollTop) == 'number') {
			var getTop = function() {
				return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
			}
		} else {
			var getTop = function() {
				return 0;
			}
		}

		if (self.innerHeight) {
			var getHeight = function() {
				return self.innerHeight;
			}
		} else if(document.documentElement.clientHeight) {
			var getHeight = function() {
				return document.documentElement.clientHeight;
			}
		} else {
			var getHeight = function() {
				return 500;
			}
		}

		function move() {
			if (initTop > 0) {
				pos = getTop()-10;
			} else {
				pos = getTop() + getHeight() + initTop;
			}

			if (pos > bottomLimit)
				pos = bottomLimit;
			if (pos < topLimit)
				pos = topLimit;

			interval = top - pos;
			top = top - interval /5;
			obj.style.top = top + 'px';
			if(pos > getTop()){
				window.setTimeout(function () {
				move();
				}, 0);
			}else{
				window.setTimeout(function () {
				move();
				}, 25);
			}
		}

		function addEvent(obj, type, fn) {
			if (obj.addEventListener) {
				obj.addEventListener(type, fn, false);
			} else if (obj.attachEvent) {
				obj['e' + type + fn] = fn;
				obj[type + fn] = function() {
					obj['e' + type + fn](window.event);
				}
				obj.attachEvent('on' + type, obj[type + fn]);
			}
		}

		addEvent(window, 'scroll', function () {
			move();
		});
	}

	//---------------------------------------

			jQuery(document).ready(function ($) {

		  	setInterval(function () {
		        moveRight();
		    }, 3000);
			var slideCount = $('#slider ul li').length;
			var slideWidth = $('#slider ul li').width();
			var slideHeight = $('#slider ul li').height();
			var sliderUlWidth = slideCount * slideWidth;
			
			$('#slider').css({ width: slideWidth, height: slideHeight });
			
			$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
			
		    $('#slider ul li:last-child').prependTo('#slider ul');

		    function moveLeft() {
		        $('#slider ul').animate({
		            left: + slideWidth
		        }, 200, function () {
		            $('#slider ul li:last-child').prependTo('#slider ul');
		            $('#slider ul').css('left', '');
		        });
		    };

		    function moveRight() {
		        $('#slider ul').animate({
		            left: - slideWidth
		        }, 200, function () {
		            $('#slider ul li:first-child').appendTo('#slider ul');
		            $('#slider ul').css('left', '');
		        });
		    };

		    $('a.control_prev').click(function () {
		        moveLeft();
		    });

		    $('a.control_next').click(function () {
		        moveRight();
		    });

		});    
</script>

	<title>코딩교육</title>
</head>
<body>
	<div id="tim">
		<div class="header">
			<div class="wrap">
				<h1>
					<a href="mainpage.html">코딩교육</a>
				</h1>
				<div class="top">
					<ul class="rt">
						<li><a class="rtlink" href="#">Log In</a></li>
					</ul>
				</div>
				<div id="topmenu">
					<ul class="menu">
						<li><a class="menulink">html</a></li>
						<li><a class="menulink">css</a></li>
						<li><a class="menulink">javascript</a></li>
                        <li><p style="border-radius:50%;border-color:white;border-width:10px;width:50px;height:100%;" ></p></li>
						<li><a class="menulink">live coding</a></li>
						<li><a class="menulink">market</a></li>
						<li><a class="menulink">my page</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div id="slider">
	  <a href="#" class="control_next"></a>
	  <a href="#" class="control_prev"></a>
	  <ul>
	    <li><img class="imgad" src="{{asset($imgpath.'/html.jpg')}}"/></li>
	    <li><img class="imgad" src="{{asset($imgpath.'/css.jpg')}}"/></li>
	    <li><img class="imgad" src="{{asset($imgpath.'/js.png')}}"/></li>
	    <li><img class="imgad" src="{{asset($imgpath.'/php.jpg')}}"/></li>
	  </ul>  
	</div>
	<div class="wrap">
		<div id="head">
			내용1
		</div>
		<div id="head2">
			내용2
		</div>
	</div>
	<script type="text/javascript">
		var bool = true;                 //메뉴바 활성화 비활성화 (true면 활성화)
		if(bool == true)
			initMoving(document.getElementById("topmenu"), 100, 110, 100);
	</script>
	
</body>

</html>
