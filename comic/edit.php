<?php

# JSONファイルを読み込み, オブジェクト型に変換する
$json_path = '../assets/upload/json/data.json';
$json = file_get_contents($json_path);
$data = json_decode($json, true);


# URLパラメータ付きでアクセスしたときの処理
if (isset($_GET['token'])) {

    # URLパラメータを取得する
    $token = $_GET['token'];
    # 必要なデータを取得する
    $title = $data[$token]['title'];
    $image_path = $data[$token]['images'];
# URLパラメータなしでアクセスしたときはトップにリダイレクトする
} else {
    http_response_code(301);
    header('Location: /');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wtokenth=device-wtokenth, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comic Maker</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<form class="" action="index.php?token=<?php echo $token ?>" method="POST"  enctype="multipart/form-data">
    <h1>
      <input type="text" name="new_title" value="" placeholder="<?php echo $title ?>">
      <span style="display:block;font-size:.5em;">※ここにタイトルを入力ください。</span>
    </h1>
    <ul>
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[0] ?>"></li>
        <input type="file" name="img0" value="">
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[1] ?>"></li>
        <input type="file" name="img1" value="">
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[2] ?>"></li>
        <input type="file" name="img2" value="">
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[3] ?>"></li>
        <input type="file" name="img3" value="">
    </ul>
    <button type="submit" name="token" value="">編集完了</button>
</form>
</body>
</html>
