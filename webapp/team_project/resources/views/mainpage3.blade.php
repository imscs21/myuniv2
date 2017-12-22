<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utp-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
    {{HTML::style('css/mainpage3.css')}}
    {{HTML::style('css/slider3.css')}}
    {{HTML::style('css/nav_mainpage.css')}}
	{{HTML::style('css/flex_layout.css')}}
	{{HTML::style('css/fluid_layout.css')}}
	{{HTML::style('css/show_hidden.css')}}

	{{HTML::script('js/jquery-3.2.1.min.js')}}
	{{HTML::script('js/responsiveslides.min.js')}}

	<script>
    $(function () {
    	$("#slider2").responsiveSlides({
        	auto: true,
        	pager: true,
        	speed: 300
      	});
    });

    //------------------------
    (function() {
    var hidden = "hidden";
 
    // Standards:
    if (hidden in document)
        document.addEventListener("visibilitychange", onchange);
    else if ((hidden = "mozHidden") in document)
        document.addEventListener("mozvisibilitychange", onchange);
    else if ((hidden = "webkitHidden") in document)
        document.addEventListener("webkitvisibilitychange", onchange);
    else if ((hidden = "msHidden") in document)
        document.addEventListener("msvisibilitychange", onchange);
    // IE 9 and lower:
    else if ('onfocusin' in document)
        document.onfocusin = document.onfocusout = onchange;
    // All others:
    else
        window.onpageshow = window.onpagehide 
            = window.onfocus = window.onblur = onchange;
 
    function onchange (evt) {
        var v = 'sg-tab-bust-visible', h = 'sg-tab-bust-hidden',
            evtMap = { 
                focus:v, focusin:v, pageshow:v, blur:h, focusout:h, pagehide:h 
            };
 
        evt = evt || window.event;
        if (evt.type in evtMap)
            document.body.className = evtMap[evt.type];
        else        
            document.body.className = this[hidden] ? "sg-tab-bust-hidden" : "sg-tab-bust-visible";
    }
	})();


 	</script>

	<title>CHAP</title>
</head>
<body>
	<header>
		<!--<div class="wrap">
        
			<h1 class="hidden-xsm hidden-sm">
				<a href="mainpage3"><img src="{{asset($imgpath.'/chap.png')}}"/></a>
			</h1>
			<div class="top">
				<ul class="rt hidden-xsm hidden-sm">
					<li><a class="rtlink"></a></li>
				</ul>
			</div>
            -->
			@include("mpgnav_mainpage")
		
	</header>

	<section class="wrap">
        <div class="mainimg-container">
            <div class="mainimg-render-text">
            <!--&lt; /&gt;-->
            <span class="animated-cursor"></span>
            </div>
            <img id="mainimg" src="{{asset($imgpath.'/e6.jpg')}}">
        </div>

    	<div class=" flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal  flex-layout-xlg flex-layout-xlg-horizontal" style="width:100%;">
            <div style="height:100%" class="flex-item-md-lv1 flex-item-lg-lv1 flex-item-xlg-lv1">
            <!--
            class="fluid-item-xlg-6 fluid-item-lg-6 fluid-item-md-6 fluid-item-sm-12 fluid-item-xsm-12" >
            -->
                <ul class="rslides" id="slider2">
                    <li><a><img src="{{asset($imgpath.'/html.jpg')}}"/></a></li>
                    <li><a><img src="{{asset($imgpath.'/css.jpg')}}"/></a></li>
                    <li><a><img src="{{asset($imgpath.'/js.png')}}"/></a></li>
                    <li><a><img src="{{asset($imgpath.'/php.jpg')}}"/></a></li>
                </ul> 
            </div>
            <div style="padding-bottom:30px;" class="flex-item-md-lv1 flex-item-lg-lv1 flex-item-xlg-lv1" id="loginpart">
                <?php if( Session::has("logininfo") ){ ?>
                <img style="margin-left: 10px;" class="account-image" src='{{Session::get("logininfo")["avatar"]}}'/>
                <div >
                <!--<a href="./logout" style="float:right"><button>Log out</button></a>-->
                <!--apply below===========================================-->
                        <div id="textid">
                            환영합니다!</br>
                            <span ></span>{{Session::get("logininfo")["name"]}}님</span>
                        </div>

                    <div style="text-align:right;">
                        <a><button id="myroom">내강의실</button></a>
                        <a href="./logout"><button id="myroom">Log out</button></a>
                    </div>
                        
                 </div>
                <!--end===================================================-->
                
                <?php } else { ?>
                <form class="loginform" method="post" action="./login/normal">
                {{ csrf_field() }}
                	<input type="submit" value="로그인" tabindex="3" />
                    <input  type="text" name="loginid" placeholder=" 아이디" tabindex="1" ></input>
                    <input type="password" name="loginpw" placeholder=" 비밀번호" tabindex="2"></input>
                </form>
                <div class="divider"><hr/><p>OR</p></div>
                    <a class="btn-oauth-github" href="./login/github">Login with Github</a>
                <?php } ?>
            </div>
        </div>

	</section>
    <div>
    <a href="./user/api/all">test</a>
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