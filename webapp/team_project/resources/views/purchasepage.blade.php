<!DOCTYPE html>
<html>
 
<head>
	<link href="purchasepage.css" rel="stylesheet" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utp-8">

	<script type="text/javascript">
		function closed() {
			opener.location.replace('./marketpage');
			window.close();
		}

	</script>

	<title>구매</title>
</head>

<body>
	<?php //에러 출력안함 (사용이유 : 처음 마켓페이지실행시(즉,내가구매한 강의가 하나도없을경우==purarray.txt안에 내용이 없을경우) 오류가 발생하게됨)
	error_reporting(0);
	ini_set('display_errors', '0');
	?>
	
	<?php 
	if(!$_POST['mck']){ ?> 
		<div class="phtopbar">
			구매페이지
		</div>
		<p>선택한 강의가 없습니다.</p>
		<p>다시 선택해 주세요.</p>
		<input type="button" class="cancel" value="취소" onclick="window.close()">
	<?php }else{ ?>
	<form method="post" action="marketpage.php" target="mom">
		<div class="phtopbar">
			구매페이지
		</div>
		<h2>선택한 강의 목록</h2>
		<ol>
		<?php
			$cks = $_POST['mck'];
			foreach ($cks as $ck) { ?>
			<li><?= $ck ?><input type="checkbox" name="recheck[]" value=<?= $ck ?> checked="checked"></li>
		<?php } ?>
		</ol>
		<p>위 선택한 강의를 구매하시겠습니까?</p>
		<input type="submit" name="phtrue" value="구매" onclick="closed();">

		<input type="button" class="cancel" value="취소" onclick="window.close()">
	</form>
	<?php } ?>
</body>

</html>