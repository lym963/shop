<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登陆</title>
</head>
<body>
<center>
    <h1>登陆</h1>
    <form action="" method="post">
        @csrf
        <table>
            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="user_name">
                    <span style="color:red">{{$errors->first('user_name')}}</span>
                </td>
            </tr>
            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="password">
                    <span style="color:red">{{$errors->first('password')}}</span>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="登陆"></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>