<?php
  if(isset($_GET['id'])){
   $id = $_GET["id"];
}
//==============================================================================
//■データベース情報を設定
//==============================================================================
$dsn = 'mysql:dbname=mydata;host=localhost;charset=utf8';
$user = 'root';  //ユーザー名
$password = '';  //パスワード

//==============================================================================
//■try(正常処理)
//==============================================================================
try{
	//-----------------------------------------------------------------
	//□PDOオブジェクトの作成
	//-----------------------------------------------------------------
		$db = new PDO($dsn, $user, $password);

	//-----------------------------------------------------------------
	//□SQL命令
	//　実行するSQL命令を変数に代入
	//　条件部分の値が送信データにあたる場合は「?」
	//-----------------------------------------------------------------
		$sql  = "select * from item where id = ?";

	//-----------------------------------------------------------------
	//□SQL命令の実行の準備
	//-----------------------------------------------------------------
		$stmt = $db->prepare($sql);

	//-----------------------------------------------------------------
	//□変数のあてはめを設定
	//　値が文字列の場合　$stmt -> bindParam(順番 , 値が代入されている変数名 , PDO::PARAM_STR);
	//　値が数値の場合　　$stmt -> bindParam(順番 , 値が代入されている変数名 , PDO::PARAM_INT);
	//-----------------------------------------------------------------
	$stmt -> bindParam(1 , $id , PDO::PARAM_STR);

	//-----------------------------------------------------------------
	//□SQL命令の実行
	//-----------------------------------------------------------------
		$stmt->execute();

	//-----------------------------------------------------------------
	//□抽出結果件数を取得
	//-----------------------------------------------------------------
	//$count = $stmt->rowCount();

//==============================================================================
//■エラー発生時（例外処理）
//　PDOException $e  $eにエラー内容を格納
//　print($e->getMessage());　例外メッセージを取得してエラーを表示
//==============================================================================
}catch(PDOException $e){
	//エラー出力
	print('DB接続エラー：'.$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>Goo</title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/item02.css">
	</head>
	<body>
<!-- header start -->
<div class="header">
    <div class="nav">
      <ul>
        <li><a href="index.html">トップ</a></li>
        <li><a href="item.html">商品一覧</a></li>
        <li><a href="rank.html">ランキング</a></li>
        <li><a href="sreep.html">睡眠の重要性</a></li>
      </ul>
    </div>
  </div>
	<!-- header end -->
	<!-- main start -->
<main>
					<h2>商品詳細</h2>
					<?php while($record=$stmt->fetch()){ ?>
					<img src="images/<?php print($record["picture"]); ?>" alt="" width="400">
					<table border="1">
						<tr>
							<th>商品コード</th>
							<td><?php print($record["id"]); ?></td>
						</tr>
						<tr>
							<th>商品名</th>
							<td><?php print($record["hinmei"]); ?></td>
						</tr>
						<tr>
							<th>販売価格</th>
							<td><?php print($record["price"]); ?>円（税込み）</td>
						</tr>
					</table>
					<form method="get" action="cart.php">
						<input type="text" name="kosu" value="1">
						<button type="submit">
							<img src="images/btn/cartin.png" alt="カートに入れる">
						</button>
						<input type="hidden" name="code" value="<?php print($record["id"]); ?>">
						<input type="hidden" name="hinmei" value="<?php print($record["hinmei"]); ?>">
						<input type="hidden" name="price" value="<?php print($record["price"]); ?>">
					</form>
				<?php } ?>
</main>

	<!-- main end -->
	
	<!-- footer start -->
	<footer>
		<ul class="footer-nav">
			<li><a href="index.html">HOMEトップ</a></li>
			<li><a href="shop.html">SHOPトップ</a></li>
			<li><a href="contact.html">CONTACTトップ</a></li>
			<li><a href="policy.html">個人情報保護方針</a></li>
			<li><a href="tokutei.html">特定商取引に基づく表記</a></li>
		</ul>
			<p class="copyright"><p><small>(c)清水太一</small></p>
	</footer>
	<!-- footer end -->
	<script src="js/*.js" charset="UTF-8"></script>
</body>
</html>