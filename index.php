<?php

# 16桁の乱数を生成する
$bytes = openssl_random_pseudo_bytes(8);
$token = bin2hex($bytes);


$jason_path = 'assets/upload/json/data.json';
$json = file_get_contents($jason_path);
$data = json_decode($json,true);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comic Maker</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <form action="./comic/" method="get">
        <button type="submit">4コマを作る</button>
        <div>
            <label for="token">token：</label>
            <input type="text" name="token" id="token" maxlength="16" pattern="^[0-9A-Za-z]+$" value="<?php echo $token ?>">
        </div>
    </form>
<div class="comics">
  <ul>
    <?php foreach($data as $comic): ?>
      <?php $image_path = $comic['images']; ?>
      <?php echo $id ?>
      <li class="ttl"><?php echo $ttl = $comic['title']?></li>
      <li><img src="<?php echo 'assets/upload/img/'.$image_path[0] ?>"></li>
      <li><a href="<?php echo 'comic/?token='.$comic['id'] ?>">見る</a></li>
    <?php endforeach ?>
  </ul>
</div>
</body>
</html>
