
<nav id="navbar">
<input type="checkbox" id="mbtn"></input>
<div class="flex-layout flex-layout-horizontal hidden-md hidden-lg hidden-xlg">
<p class="flex-item-lv1 mobile-menu-btn" ><label for="mbtn">≡</label></p>
<div class="flex-item-lv12 nav-logo ">
<img src="https://images.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="logo image"/>
<h1>Jr. CHAP</h1>
</div>
</div>
<ul class="menu">
<div id="navaddtionalbar1" class="hidden-md hidden-lg hidden-xlg">

</div>
<?php foreach( $navitems as $a){ ?>
<li>
    <a href="<?= $a['link']?>"><div><p><?= $a["title"] ?></p></div></a>
</li>
<?php } ?>
</ul>
<!--
style="width:<?= (int)(99.9/count($navitems)) ?>vw;"
<?php foreach( $navitems as $a){ ?>

        <a href="<?= $a['link']?>" class="flex-item-lv1" style="height:100%"><div><p><?= $a["title"] ?></p></div></a>
<?php } ?>
-->
</nav>