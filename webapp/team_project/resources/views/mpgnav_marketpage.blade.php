<nav id="navbar">
	<input type="checkbox" id="mbtn"></input>
	<?php if( Session::has("logininfo") ){ ?>
		<img class="menu-usr-icon" ng-click="popup.userinfo.show=!popup.userinfo.show" style="float:right;height:90%;padding:0px;border-radius:50%;cursor:pointer;margin-right:0.5em;margin-top:0.1em;" src='{{Session::get("logininfo")["avatar"]}}'>

	<?php } ?>
	<div class="flex-layout flex-layout-horizontal hidden-md hidden-lg hidden-xlg">
		<span class="flex-item-lv1 mobile-menu-btn" ><label for="mbtn">≡</label></span>
		<div class="flex-item-lv12 nav-logo">
			<a href="mainpage3"><img src="{{asset($imgpath.'/chap.png')}}"/></a>
		</div>
	</div>
		
	<ul class="menu">
	<!--
		<div id="setblock">
			<div id="myinfo" class="hidden-md hidden-lg hidden-xlg">
				<div class="menuname">
					내정보
				</div>
				<div class="yourpic">
					<img src="{{asset($imgpath.'/avatar.png')}}"/>
				</div>
				<div class="nocss">
					<ul>
						<li>
							코인 수 : 0 개
						</li>
						<li>$pursize
							구매한 강좌 수 : $pursize ?> 개
						</li>
					</ul>
				</div>
			</div>
		</div>
		-->

		<li class="logo hidden-xsm hidden-sm">
			<a href="./"><img src="{{asset($imgpath.'/chap.png')}}"/></a>
		</li>
		<?php foreach( $navitems as $a){ ?>
		<li class="hoverable">
			<a  href="<?= $a['link']?>"><div><p><?= $a["title"] ?></p></div></a>
		</li>
		<?php } ?>
		
		<!--
		<li>
			<a href="studypage3"><div><p>html</p></div></a>
		</li>
		<li><a href="studypage3"><div><p>css</p></div></a></li>
		<li><a href="studypage3"><div><p>javascript</p></div></a></li>
		<li><a href="studypage3"><div><p>php</p></div></a></li>
		<li><a href="marketpage"><div><p>market</p></div></a></li>
		-->
	</ul>
<!--<?php foreach( $navitems as $a){ ?>

        <a href="<?= $a['link']?>" class="flex-item-lv1" style="height:100%"><div><p><?= $a["title"] ?></p></div></a>
<?php } ?>
-->
</nav>
<!-- IMPORT POPUP2:: START-->
			<div class="msg2" ng-show="popup.userinfo.show">
				<div class="balloon2">
					<div class="balloon2-wrapper">
						<section class="user-info">
						
						</section>
						<footer class="flex-layout flex-layout-horizontal buttom-user-bar">
							<div style="flex:1">
									<a href="./userpage"><p>내 정보</p></a>
							</div>
							<div class="vertical-divider"></div>
							 <div style="flex:1">
                           
                                <a href="./logout"><p>로그아웃</p></a>
                            
                        </div>


						</footer>
					</div>
				</div>
			</div>
			<!-- IMPORT POPUP2:: END -->