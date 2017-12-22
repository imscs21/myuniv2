<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utp-8">

    {{HTML::style('css/mainpage3.css')}}
    {{HTML::style('css/studypage3.css')}}
    {{HTML::style('css/slider3.css')}}
    {{HTML::style('css/nav_mainpage.css')}}
	{{HTML::style('css/flex_layout.css')}}
	{{HTML::style('css/fluid_layout.css')}}
	{{HTML::style('css/show_hidden.css')}}

	{{HTML::script('js/jquery-3.2.1.min.js')}}
	{{HTML::script('js/responsiveslides.min.js')}}

	<title>CHAP</title>
</head>
<body>
	<header>
			<div class="wrap">
				<h1 class="hidden-xsm hidden-sm">
					<a href="mainpage3"><img src="{{asset($imgpath.'/chap.png')}}"/></a>
				</h1>
				<div class="top">
					<ul class="rt hidden-xsm hidden-sm">
						<li><a class="rtlink"></a></li>
					</ul>
				</div>
	    		@include("mpgnav_mainpage")
			</div>
		</header>

<!-- 여기부턴 하고싶은대로-->
	<div class="wrap">
		<div id="sidebar">
			<div class="contable"> <!--수정은 안했는데 아마도 목차부분은 내가 marketpage에 한것처럼 화면이 768인가 그거 미만일때는 메뉴바안에 넣을거같아 marketpage안에 내정보있는거 참고하면될듯 -->
				목차
			</div>
			<div class="sidecont">
				<ul>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
					<li>1</li>
				</ul>
			</div>
		</div>
		<article>
			내용
		</article>
	</div>

	<!--맨 위로 자동 스크롤 아이콘-->
	<div id=topAutoScroll>
		<img src="{{asset($imgpath.'/topAutoScroll.png')}}">
	</div>
	<script>
			$("#topAutoScroll").click(function() {
				$('html, body').animate({scrollTop:0}, 'slow');
				return false;
			});
	</script>
</body>

</html>