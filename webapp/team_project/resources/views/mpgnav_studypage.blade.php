<nav id="navbar">
	<input type="checkbox" id="mbtn"></input>
	<div class="flex-layout flex-layout-horizontal hidden-md hidden-lg hidden-xlg">
		<span class="flex-item-lv1 mobile-menu-btn" ><label for="mbtn">≡</label></span>
		<div class="flex-item-lv12 nav-logo">
			<a href="./"><img src="../chap.png"/></a>
		</div>
	</div>
	<ul class="menu">
		<div id="navaddtionalbar1" class="hidden-md hidden-lg hidden-xlg"></div>
		<li>
			<a href="#"><div><p>html</p></div></a>
		    <!--<a href="<?= $a['link']?>" style="width:<?= (int)(99.9/count($navitems)) ?>vw;"><div><p><?= $a["title"] ?></p></div></a> -->
		</li>
		<li><a href="#"><div><p>css</p></div></a></li>
		<li><a href="#"><div><p>javascript</p></div></a></li>
		<li><a href="#"><div><p>php</p></div></a></li>
		<li><a href="#"><div><p>market</p></div></a></li>
	</ul>
<!--<?php foreach( $navitems as $a){ ?>

        <a href="<?= $a['link']?>" class="flex-item-lv1" style="height:100%"><div><p><?= $a["title"] ?></p></div></a>
<?php } ?>
-->
</nav>