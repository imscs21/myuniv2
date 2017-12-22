<!DOCTYPE html>
<html>
<head lang="{{ app()->getLocale() }}">
<title>@yield('title')</title>
@include("mobileview.init")
{{HTML::style('css/mainpage2.css')}}
{{HTML::style('css/flex_layout.css')}}
{{HTML::style('css/fluid_layout.css')}}
{{HTML::style('css/show_hidden.css')}}
<style>
.fluid-layout > div{
    background-color: deepskyblue;
}
.fluid-layout > div:first-child{
    background-color: deeppink;
    color:white;
}
</style>
</head>
<body>
<!--
<p id="bl" class="btns_layout">
@if(Session::get("logininfo"))
<a href="./logout"><button>Log out</button></a>
@else
<a href="./login/github"><button>Log in</button></a>
@endif
</p>
-->
<header class="hidden-xsm hidden-sm">
<img src="https://images.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="logo image"/>
<h1>Jr. CHAP</h1>
</header>
@include("mpgnav")
<section>
    <div id="slides">
        <img class="imgad" src="{{asset($imgpath.'/html.jpg')}}"/>
	    <img class="imgad" src="{{asset($imgpath.'/css.jpg')}}"/>
	    <img class="imgad" src="{{asset($imgpath.'/js.png')}}"/>
	    <img class="imgad" src="{{asset($imgpath.'/php.jpg')}}"/>
	 <a href="#" class="slidesjs-previous slidesjs-navigation">이전</a><!--이전버튼-->
     <a href="#" class="slidesjs-next slidesjs-navigation">다음</a><!--다음버튼-->
    </div>
    <div class="fluid-layout" >
        <div style="padding-bottom:15px;" class="fluid-item-xlg-6 fluid-item-lg-6 fluid-item-md-6 fluid-item-sm-12 fluid-item-xsm-12">
            <?php if( Session::has("logininfo") ){ ?>
            <p><img class="account-image" src='{{Session::get("logininfo")["avatar"]}}'/>
             <a href="./logout" style="float:right"><button>Log out</button></a>
            <p style="padding-left:5px;">{{Session::get("logininfo")["name"]}}님<div><a><button>내강의실</button></a></div></p> </p>
           <button class="btn"></button>
            <?php } else { ?>
            <form class="loginform" method="post" action="./login/normal">
            {{ csrf_field() }}
                <label for="loginid">아이디</label>
                <input  type="text" name="loginid" placeholder="아이디" tabindex="1" ></input>
                <label for="loginpw">비밀번호</label>
                <input type="password" name="loginpw" placeholder="비밀번호" tabindex="2"></input>
                <input type="submit" value="Login" tabindex="3" />
            </form>
            <div class="divider"><hr/><p>OR</p></div>
                <a class="btn-oauth-github" href="./login/github">Login with Github</a>
            <?php } ?>
        </div>
        <div style="height:100%" class="fluid-item-xlg-6 fluid-item-lg-6 fluid-item-md-6 fluid-item-sm-12 fluid-item-xsm-12" >
        <table class="tbl">
        <thead><tr><th>제목</th><th style="width:20%;">날짜</th><th width="50px"><a href="./notice">더보기</a></th></tr><thead>
        <tbody>
        <?php for($i=1;$i<=5;$i++){ ?>
        <tr><td>test<?=$i?></td><td colspan=2><?= date("y/n/j",time())?></td></tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>
</section>
<footer>
하위 사이트의 간략정보를 적는 footer
</footer>
{{--HTML::script('http://code.jquery.com/jquery-latest.min.js')--}}

{{--HTML::script('https://cdnjs.cloudflare.com/ajax/libs/slidesjs/3.0/jquery.slides.min.js')--}}
{{HTML::script('js/jquery-3.2.1.min.js')}}
{{HTML::script('js/jquery.slides.min.js')}}

<script>
 $(function(){
      $("#slides").slidesjs({
        width: 1000,
        height: 528,
         navigation: {
      active: true,
      effect: "slide"
    },
    play: {
				active: true, //플레이 스탑버튼 사용유무(버튼변경불가)
				effect: "slide",//효과 slide, fade
				interval: 3000,//밀리세컨드 단위 5000 이면 5초
				auto: true, //시작시 자동 재생 사용유무
				swap: true, //플레이스 스탑버튼 둘다보임 false, 하나로 보임 true
				pauseOnHover: false,//마우스 올렸을때 슬라이드 멈춤할껀지 말껀지
				restartDelay: 2500//마우스 올렸다가 벗어 났을때 재 작동 시간 밀리세컨드 단위
				//css slidesjs-play, slidesjs-stop 이부분을 이용해서 커스터마이징 가능함
			},
    effect: {
				slide: {
				// 슬라이드 효과
					speed: 700
					// 0.2초만에 바뀜
				},
				fade: {
				// 페이드 효과
					speed: 500,
					// 0.3초만에 바뀜
					crossfade: true
					// 다음이미지와 겹쳐서 나타남 유무
				}
			},

      });
    });
</script>
<?php 
echo $injectionJsMsg!=null? 'true':'false';
if($injectionJsMsg!=null){
		?>
		<script>
			<?php echo htmlspecialchars_decode($injectionJsMsg,ENT_QUOTES) ?>
		</script>
		<?php
	} ?>
</body>
</html>