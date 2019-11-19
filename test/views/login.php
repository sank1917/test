<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/site.css">
    <title><?=$pageData['title']?></title>
</head>
<body>
    <header class="header">
        <div class="logo">App</div>
        <div class="bar">
            <div class="login">
                <div class="circle">Гость</div>
                <a href="" class="btn-login">Войти</a>
            </div>
        </div>
    </header>
    <aside class="left-panel">
        <nav>
            <ul>
                <li>
                    <a href="/site"><i class="fas fa-home"></i></a>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="content">
        <div class="container">
            <div class="login-page">
                <div class="login-block">
                    <h1>Вход</h1>
                    <p>Заполните поля ниже.</p>
                    <form class="form-signin" id="form-signin" method="post">
                        <div class="form-field">
                            <input type="text" id="login" name="login" placeholder="Логин..." required>
                        </div>
                        <div class="form-field">
                            <input type="password" id="password" name="password" placeholder="Пароль..." required>
                        </div>
                        <div class="error-block"><?php if(isset($pageData['error'])){ echo $pageData['error']; }?></div>
                        <button type="submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>