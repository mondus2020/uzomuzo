<?php

# JSONファイルを読み込み, オブジェクト型に変換する
$json_path = '../assets/upload/json/data.json';
$json = file_get_contents($json_path);
$data = json_decode($json, true);


# URLパラメータ付きでアクセスしたときの処理
if (isset($_GET['token'])) {

    # URLパラメータを取得する
    $token = $_GET['token'];


    # JSONに該当データがないとき（新規作成）
    if (!$data[$token]) {
        # 新規の配列を作成し, JSONファイルに追記する
        $data[$token] = array(
          "id" => "$token",
            "title" => "新規4コマ",
            "images" => array(
                "sample/01.png",
                "sample/02.png",
                "sample/03.png",
                "sample/04.png",
            )
        );
        file_put_contents($json_path, json_encode($data));
        #画像書くの私の作成
        mkdir("../assets/upload/img/".$token, 0777);
    }
    # 必要なデータを取得する
    $title = $data[$token]['title'];
    $image_path = $data[$token]['images'];



} else {
  # URLパラメータなしでアクセスしたときはトップにリダイレクトする
    http_response_code(301);
    header('Location: /');
    exit;
};
if (isset($_POST['new_title'])) {
  $data[$token]["title"] = $_POST["new_title"];
  file_put_contents($json_path, json_encode($data));
};
if(isset($_FILES["img0"])){
  $tempfile = $_FILES['img0']['tmp_name'];
  $pos = "../assets/upload/img/".$token."/01.png";
  move_uploaded_file($tempfile,$pos);
  $data[$token]["images"][0] = $token."/01.png";
  file_put_contents($json_path,json_encode($data));
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

    <h1><?php echo $title ?></h1>

    <ul>
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[0] ?>"></li>
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[1] ?>"></li>
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[2] ?>"></li>
        <li><img src="<?php echo '../assets/upload/img/'. $image_path[3] ?>"></li>
    </ul>
    <form class="" action="edit.php" method="get">
      <button type="submit" name="token"  value="<?php echo $token ?>">編集する</button>
    </form>


</body>
</html>
