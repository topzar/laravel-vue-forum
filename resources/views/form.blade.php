<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>this is laravel form test</title>
</head>
<body>
    <h3>this is laravel form test</h3>
    <form action="/form"  method="post">
        {{ csrf_field() }}
        <input type="text" name="username" id=""><br>
        <input type="password" name="password" id="">
        <button type="submit">submit</button>
    </form>
</body>
</html>