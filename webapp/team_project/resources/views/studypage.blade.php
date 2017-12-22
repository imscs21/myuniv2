<!DOCTYPE html>
<head>
{{HTML::style('css/mainpage.css')}}
{{HTML::style('css/studypage.css')}}
{{HTML::style('css/slider.css')}}

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
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
				pos = getTop()-8;
			} else {
				pos = getTop() + getHeight() + initTop;
			}

			if(target == sidebar)
				bottomLimit = getTop() - 120;
			
			if (pos > bottomLimit)
				pos = bottomLimit;
			if (pos < topLimit)
				pos = topLimit;

			interval = top - pos;
			if(target == topmenu){
				top = top - interval /50;
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
			else if(target == sidebar){
				top = top - interval /500;
				obj.style.top = top + 'px';
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
</script>

	<title>CHAP</title>
</head>
<body>
	<div id="tim">
		<div class="header">
			<div class="wrap">
				<h1>
					<a href="mainpage.html"><img src="chap.png"/></a>
				</h1>
				<div class="top">
					<ul class="rt">
						<li><a class="rtlink" href="#">Log In</a></li>
					</ul>
				</div>
				<div id="topmenu">
					<ul class="menu">
						<li class="firstmenu"><a class="menulink firstmenu" href="studypage.html">html</a></li>
						<li><a class="menulink" href="studypage.html">css</a></li>
						<li><a class="menulink" href="studypage.html">javascript</a></li>
						<li><a class="menulink" href="studypage.html">php</a></li>
						<li><a class="menulink" href="marketpage.html">market</a></li>
						<li class="lastmenu"><a class="menulink lastmenu">my page</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="wrap">
		<div id="sidebar">
			<div class="contable">
				목차
			</div>
			내용
		</div>
		<div id="article">
			내용
		</div>
	</div>
	<script type="text/javascript">
		var bool = true;                 //메뉴바 활성화 비활성화 (true면 활성화)
		if(bool == true){
			initMoving(document.getElementById("topmenu"), 100, 110, 0); 
			initMoving(document.getElementById("sidebar"), 10, 0, 350); 
		}
	</script>
</body>

</html>
