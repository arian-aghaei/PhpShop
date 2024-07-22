<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/output.css">
</head>
<body class="" style="background-image: linear-gradient(to right, #a9a9ff, #ffb6b6);">
    <div class="container mx-auto justify-center flex mt-[8rem]">
        <form method="post" class="w-1/4 border border-gray-500 bg-white p-5 pt-10 rounded-lg">
            <div class="mb-3">
                <label for="username">Username: </label>
                <input class="form-control" type="text" name="username" placeholder="username">
            </div>
            <div class="mb-5">
                <label for="password">Password: </label>
                <input class="form-control" type="password" name="password" placeholder="password">
            </div>
            <div class="flex">
                <button class="rounded-lg px-3 py-1 text-white bg-blue-700 hover:bg-blue-800" type="submit">Login</button>
                <div class="ml-auto text-sm my-auto">
                    <span class="">or you can</span>
                    <a class="rounded-lg px-1 py-1 text-blue-400 hover:text-blue-500" href="/register">Register</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>