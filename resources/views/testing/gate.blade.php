<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <form action="{{ route('authenticate-testing-credentials') }}" method="POST">
            @csrf
            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="Username">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password">
            <button type="submit">Log In</button>
        </form>
    </body>
</html>