<!DOCTYPE html>
<html>
<head>
<title>Ведутся технические работы</title>
<meta charset="utf-8">
<style>
    body{
        font-family: Verdana, Arial, sans-serif;
        font-size: 20px;
        color : #000;
    }
    h1{
        font-size: 30px;
    }
    p{
        font-size: 22px;
        padding: 0 0 0 10px;
        margin:0;
    }
    .template{
        padding: 0 0 10px 50px;
        text-align: center;
    }
    .block{
        padding-right: 15px;
        padding-left: 15px;
    }
    .bender{
        max-width: 400px;
    }
</style>
</head>
<body>
<div class="block">
<div class="template">
<img class="bender" src="images/robot.jpg">
<h1>На сайте ведутся технические работы</h1>
<p>На текущий момент сайт недоступен.</p>
<p>{{ json_decode(file_get_contents(storage_path('framework/down')), true)['message'] }}</p>
</div>
</div>
</div>
</body>
</html>
