<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<?php
			$song_count = 5678;
			$news_pages = 7;
			$faary = array("Guns N' Roses","Green Day","Blink182","Queen");
		?>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			I love music.
			I have <?=$song_count?> total songs,
			which is over <?=(int)($song_count/10)?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!--
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
		
			<ol>
				<?php for($i=1;$i<=$news_pages;$i++){ ?>
					<li><a href="http://music.yahoo.com/news/archive/?page=<?=$i?>">Page <?=$i?></a></li>
				<?php } ?>

			</ol>
		</div>
			-->
		<!-- Ex 3: Query Variable -->
		<?php
		$news_pages = 5;
		if(isset($_GET["newpages"])){
			$news_pages = (int)$_GET["newpages"];
		}
		?>
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
		
			<ol>
				<?php for($i=1;$i<=$news_pages;$i++){ ?>
					<li><a href="http://music.yahoo.com/news/archive/?page=<?=$i?>">Page <?=$i?></a></li>
				<?php } ?>

			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
	
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
					<?php 
					foreach(file("./favorite.txt") as $fa){
					?>
					<?php /*<li><a href="http://en.wikipedia.org/wiki/<?=implode("_",explode(" ",$fa))?>"><?=$fa?></a></li>
					*/
						?>
					<li><a href="http://en.wikipedia.org/wiki/<?=str_replace(" ","_",$fa)?>"><?=$fa?></a></li>
					<?php } ?>
					<!--
				<li>Guns N' Roses</li>
				<li>Green Day</li>
				<li>Blink182</li>
				-->
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
	
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
					<?php 
						$ary = glob("lab5/musicPHP/songs/*.mp3");
						function szsort($a,$b){
							$asz = filesize($a);
							$bsz = filesize($b);
							if($asz==$bsz){
								return 0;
							}
							return $asz<$bsz? 1:-1;
						}
						uasort($ary,'szsort');
						foreach($ary as $fs){
					?>
						<li class="mp3item">
							<a href="<?=$fs?>"><?=basename($fs)?></a> <?= " (".(int)(filesize($fs)/1024)." KB)" ?>
						</li>
					<?php
						}
					?>
			<!--
				<li class="mp3item">
					<a href="lab5/musicPHP/songs/paradise-city.mp3">paradise-city.mp3</a>
				</li>
				
				<li class="mp3item">
					<a href="lab5/musicPHP/songs/basket-case.mp3">basket-case.mp3</a>
				</li>

				<li class="mp3item">
					<a href="lab5/musicPHP/songs/all-the-small-things.mp3">all-the-small-things.mp3</a>
				</li>
				-->
				<!-- Exercise 8: Playlists (Files) -->

				<?php 
				$topary = glob("lab5/musicPHP/songs/*.m3u");
				arsort($topary);
				foreach($topary as $m3u){?>
				<li class="playlistitem"><?=basename($m3u)?>:
					<ul>
						<?php
							$ary = file($m3u);
							shuffle($ary);
							foreach($ary as $ln){
								if(strpos($ln,'#')===false){
								?>
								<li><?=$ln?></li>
								<?php
							}
							}
						?>
					</ul>
				</li>
				<?php } ?>
				<!--<li class="playlistitem">326-13f-mix.m3u:
					<ul>
						<li>Basket Case.mp3</li>
						<li>All the Small Things.mp3</li>
						<li>Just the Way You Are.mp3</li>
						<li>Pradise City.mp3</li>
						<li>Dreams.mp3</li>
					</ul>
				</li>-->
			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
