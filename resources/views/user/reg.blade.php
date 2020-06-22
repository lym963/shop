<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
</head>
<body>
<center>
    <h1>注册</h1>
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
                <td>邮箱</td>
                <td>
                    <input type="email" name="user_email">
                    <span style="color:red">{{$errors->first('user_email')}}</span>
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
                <td>确认密码</td>
                <td>
                    <input type="password" name="password_confirmation">
                    <span style="color:red">{{$errors->first('password_confirmation')}}</span>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="注册"></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>