<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    {{HTML::style('css/mainpage3.css')}}
    {{HTML::style('css/marketpage.css')}}
    {{HTML::style('css/nav_marketpage.css')}}
	{{HTML::style('css/flex_layout.css')}}
	{{HTML::style('css/fluid_layout.css')}}
	{{HTML::style('css/show_hidden.css')}}

	{{HTML::script('js/jquery-3.2.1.min.js')}}
	{{HTML::script('js/responsiveslides.min.js')}}

<script type="text/javascript">

	function submitWin(form){ 
		window.open('',form.target,'width=800,height=700,scrollbars=yes'); 
		return true; 
	} 
</script>

<script>
	$(document).ready(function(){
		$('.checkallhtml').click(function(){
			$('.achtml').prop('checked', this.checked);
		});
	});
	$(document).ready(function(){
		$('.checkallcss').click(function(){
			$('.accss').prop('checked', this.checked);
		});
	});
	$(document).ready(function(){
		$('.checkalljs').click(function(){
			$('.acjs').prop('checked', this.checked);
		});
	});
	$(document).ready(function(){
		$('.checkallphp').click(function(){
			$('.acphp').prop('checked', this.checked);
		});
	});
</script>

	<title>CHAP</title>

</head>
<body>
	<?php //에러 출력안함 (사용이유 : 처음 마켓페이지실행시(즉,내가구매한 강의가 하나도없을경우==purarray.txt안에 내용이 없을경우) 오류가 발생하게됨)
	error_reporting(0);
	ini_set('display_errors', '0');
	?>

	<?php //purchasepage.php 팝업에서 구매한 강의를 purarray.txt파일에 줄단위로 저장
	if($_POST['recheck']){
		$rechs = $_POST['recheck'];
		$fp = fopen("purarray.txt", "a");
		foreach ($rechs as $rech) {
			fputs($fp,$rech);
			fputs($fp,"\r\n");
		}
		fclose($fp);
	} ?>
	<?php 
	$purfile = file('purarray.txt');
	$pursize = count($purfile);
	?>

	<form method="post" action="./marketpage/purchasepage" target="sendWin" onsubmit="return submitWin(this)">
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
				@include("mpgnav_marketpage")
			</div>
		</header>

		<div class="wrap">
			<div id="myinfo" class="hidden-xsm hidden-sm">
				<div class="menuname">
					내정보
				</div>
				<div class="yourpic">
					<img src="{{asset($imgpath.'/avatar.png')}}"/>
				</div>
				<div>
					<ul>
						<li>
							코인 수 : <a href="#">0</a> 개
						</li>
						<li>
							구매한 강좌 수 : <a href="#"><?= $pursize ?></a> 개
						</li>
					</ul>
				</div>
				<input style="margin-top: 20px; width: 100%; height: 40px" type="submit" value="구매하기">
			</div>
			<div>
				<div class="shopmenu shopmenuright betweenmargin minsizemargintop">
					<div class="shopname php">
						<label>PHP<input id="ckbt" type="checkbox" name="allphp" class="checkallphp"></label>
					</div>
					<div class="shopcont">
						<ul>
							<?php 
							$phs = file("market_php.txt"); //sql미사용 쉽게 txt로 구현 (market_html.txt 파일은 html강의 전체 목록)
							$torfphp = false;
							$fps = file("purarray.txt"); //sql미사용 쉽게 txt로 구현 (purarray.txt 파일은 내가 구매한 강의목록)

							foreach ($phs as $ph) {
								foreach ($fps as $fp) {
									if(strpos($fp, $ph) !== false){
										$torfphp = true;
										break;
									} ?>
						<?php   }
								if($torfphp == ture){ ?>
									<li><?= $ph ?></li>
						<?php   }else{ ?>
								<li><label><?= $ph ?><input id="ckbt" type="checkbox" name="mck[]" class="acphp" value=<?= $ph ?>></label></li>
						<?php   }
								$torfphp = false; ?>
					<?php   } ?>
						</ul>
					</div>
				</div>
				<div class="shopmenu">
					<div class="shopname js">
						<label>JS<input id="ckbt" type="checkbox" name="alljs" class="checkalljs"></label>
					</div>
					<div class="shopcont">
						<ul>
							<?php 
							$jss = file("market_js.txt"); //sql미사용 쉽게 txt로 구현 (market_html.txt 파일은 html강의 전체 목록)
							$torfjs = false;
							$fps = file("purarray.txt"); //sql미사용 쉽게 txt로 구현 (purarray.txt 파일은 내가 구매한 강의목록)

							foreach ($jss as $js) {
								foreach ($fps as $fp) {
									if(strpos($fp, $js) !== false){
										$torfjs = true;
										break;
									} ?>
						<?php   }
								if($torfjs == ture){ ?>
									<li><?= $js ?></li>
						<?php   }else{ ?>
								<li><label><?= $js ?><input id="ckbt" type="checkbox" name="mck[]" class="acjs" value=<?= $js ?>></label></li>
						<?php   }
								$torfjs = false; ?>
					<?php   } ?>
						</ul>
					</div>
				</div>
				<div class="shopmenu betweenmargin">
					<div class="shopname html">
						<label>HTML<input id="ckbt" type="checkbox" name="allhtml" class="checkallhtml"></label>
					</div>
					<div class="shopcont">
						<ul>
							<?php 
							$htmls = file("market_html.txt"); //sql미사용 쉽게 txt로 구현 (market_html.txt 파일은 html강의 전체 목록)
							$torfhtml = false;
							$fps = file("purarray.txt"); //sql미사용 쉽게 txt로 구현 (purarray.txt 파일은 내가 구매한 강의목록)

							foreach ($htmls as $html) {
								foreach ($fps as $fp) {
									if(strpos($fp, $html) !== false){
										$torfhtml = true;
										break;
									} ?>
						<?php   }
								if($torfhtml == ture){ ?>
									<li><?= $html ?></li>
						<?php   }else{ ?>
								<li><label><?= $html ?><input id="ckbt" type="checkbox" name="mck[]" class="achtml" value=<?= $html ?>></label></li>
						<?php   }
								$torfhtml = false; ?>
					<?php   } ?>
					
						</ul>
					</div>
				</div>
				<div class="shopmenu">
					<div class="shopname css">
						<label>CSS<input id="ckbt" type="checkbox" name="allcss" class="checkallcss"></label>
					</div>
					<div class="shopcont">
						<ul>
							<?php 
							$csss = file("market_css.txt"); //sql미사용 쉽게 txt로 구현 (market_html.txt 파일은 html강의 전체 목록)
							$torfcss = false;
							$fps = file("purarray.txt"); //sql미사용 쉽게 txt로 구현 (purarray.txt 파일은 내가 구매한 강의목록)

							foreach ($csss as $css) {
								foreach ($fps as $fp) {
									if(strpos($fp, $css) !== false){
										$torfcss = true;
										break;
									} ?>
						<?php   }
								if($torfcss == ture){ ?>
									<li><?= $css ?></li>
						<?php   }else{ ?>
								<li><label><?= $css ?><input id="ckbt" type="checkbox" name="mck[]" class="accss" value=<?= $css ?>></label></li>
						<?php   }
								$torfcss = false; ?>
					<?php   } ?>
						</ul>
					</div>
				</div>
			</div>
			<input class="hidden-md hidden-lg hidden-xlg" style="margin-top: 10px; width: 30%; height: 40px" type="submit" value="구매하기">
		</div>
	</form>

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