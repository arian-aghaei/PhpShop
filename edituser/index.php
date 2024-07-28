<?php
session_start();
if($_SESSION['user']['time'] > time()):
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Info</title>
    <link rel="stylesheet" href="/public/css/output.css">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto my-20 w-4/5 md:w-1/2">
        <form class="flex flex-col mx-auto justify-center" action="./edit.php" method="post" enctype="multipart/form-data">
            <div class="bg-white shadow-xl rounded-lg p-3 mb-6">
                <div class="flex justify-center mt-4">
                    <img class="w-16 md:w-40 rounded-[50%]" src=<?= $_SESSION['user']['user']['profile'] ? './public/uploads/profile/'.$_SESSION['user']['user']['profile']: 'profile.svg' ?> alt="profile">
                </div>
                <div class="p-4">
                    <label for="profile" class="me-5">Change Profile: </label>
                    <input type="file" name="profile" class="form-control">
                </div>
            </div>
            <div class="bg-white shadow-xl rounded-lg p-3">
                <div class="p-4">
                    <label for="name">Change Name: </label>
                    <input class="form-control" name="name" type="text" placeholder="<?= $_SESSION['user']['user']['name'] ? '' : "name" ?>" value=<?= $_SESSION['user']['user']['name'] ?>>
                </div>
                <div class="p-4">
                    <label for="username">Change Username: </label>
                    <input class="form-control" name="username" type="text" placeholder="<?= $_SESSION['user']['user']['username'] ? '' : "username" ?>" value=<?= $_SESSION['user']['user']['username'] ?>>
                </div>
                <div class="p-4">
                    <label for="email">Change E-Mail: </label>
                    <input class="form-control" name="email" type="email" placeholder="<?= $_SESSION['user']['user']['email'] ? '' : "email" ?>" value=<?= $_SESSION['user']['user']['email'] ?>>
                </div>
                <div class="p-4">
                    <label for="password">Change Password: </label>
                    <input class="form-control" name="password" type="password" placeholder="password" value="">
                </div>
            </div>
            <div class="flex justify-end">
                <button class="rounded-lg px-3 py-1 text-white bg-blue-700 hover:bg-blue-800 mt-6 me-7 shadow-xl" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <?php
    if ($_COOKIE['errors']):
        ?>
        <script>
            const errors = <?=$_COOKIE['errors']?>;
            Object.keys(errors).forEach(item => {
                document.getElementsByName(item)[0].classList.add('!ring-red-500');
            });
        </script>

    <?php
    endif;
    ?>
</body>
</html>
<?php
else:
    header('Location: ./login');
endif;
?>