<?php
session_start();

$name = "";
$name_err = "";
$errflg = 0;

if($_SERVER["REQUEST_METHOD"]==="POST"){
	$name = htmlspecialchars($_POST["name"],ENT_QUOTES);
	$name = mb_convert_kana($name,'KV','UTF-8');
	if(mb_strlen($name) === 0){
		$name_err
					 = '<p class="err">名前が未入力です</p>';
		$errflg = 1;
	}	

	if($errflg === 0){
		$_SESSION["name"] = $name;
		header("Location: kakunin.php");
		exit;
	}
}
//修正
if(isset($_GET["henkou"])){
	$name = $_SESSION["name"];
}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>｜店の名前</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/*.css">
	</head>
	<body>
		<header>
			<h1>お店の名前</h1>
		</header>
		<nav>
			<ul id="gnav">
				<li><a href="goodslist.php">オンラインショップ</a></li>
			</ul>
		</nav>
		<main>
			<h2>購入者情報</h2>
			<form method="post" action="regi.php">
				<table border="1">
					<tr>
						<th>氏名</th>
						<td>
						<?php print($name_err); ?>
						<input type="text" name="name" value="<?php print($name); ?>"></td>
					</tr>
				</table>
				<button type="submit">
					<img src="images/btn/kakunin.png"
					  alt="注文情報の確認へリンク">
				</button>
			</form>
			
		</main>
		
		<footer>
			<p><small>(C)2021 お店の名前</small></p>
		</footer>
	</body>
</html>
