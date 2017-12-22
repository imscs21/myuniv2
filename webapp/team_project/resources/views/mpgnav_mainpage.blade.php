<nav id="navbar">
	<input type="checkbox" id="mbtn"></input>
	<div class="flex-layout flex-layout-horizontal hidden-md hidden-lg hidden-xlg">
		<span class="flex-item-lv1 mobile-menu-btn" ><label for="mbtn">≡</label></span>
		<div class="flex-item-lv12 nav-logo">
			<a href="#"><img src="{{asset($imgpath.'/chap.png')}}"/></a>
		</div>
	</div>
	<ul class="menu">
		<li class="logo hidden-xsm hidden-sm">
			<a href="./"><img src="{{asset($imgpath.'/chap.png')}}"/></a>
		</li>
		<?php foreach( $navitems as $a){ ?>
		<li class="hoverable">
			<a  href="<?= $a['link']?>"><div><p><?= $a["title"] ?></p></div></a>
		</li>
		<?php } ?>
		<!--
		<div id="navaddtionalbar1" class="hidden-md hidden-lg hidden-xlg"></div>
		<li ></li>
		<li><a href="studypage3"><div><p>html</p></div></a></li>
		<li><a href="studypage3"><div><p>css</p></div></a></li>
		<li><a href="studypage3"><div><p>javascript</p></div></a></li>
		<li><a href="studypage3"><div><p>php</p></div></a></li>
		<li><a href="marketpage"><div><p>market</p></div></a></li>
		-->
	</ul>
</nav>