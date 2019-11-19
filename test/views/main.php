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
                <div class="circle">
                    <?php if (isset($_SESSION['user'])) { ?>
                        Админ
                    <?php } else { ?>
                        Гость
                    <?php } ?></div>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="/login/logout" class="btn-login">Выход</a>
                <?php } else { ?>
                    <a href="/login" class="btn-login">Вход</a>
                <?php } ?>
            </div>
        </div>
    </header>
    <aside class="left-panel">
        <nav>
            <ul>
                <li>
                    <a href="/site" class=""><i class="fas fa-home"></i></a>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="content">
        <div class="container-fluid">
            <div class="tasks">
                <h1>Задачи</h1>
                <div class="card">
                    <?php if(isset($_COOKIE['added'])) { ?> 
                        <div class="alert alert-success">
                            <?=$_COOKIE['added']?>
                        </div>
                    <?php } ?>
                    <div class="add-task">
                        <div class="task-form">
                            <form id="task-add" action="/site/addTask" method="post">
                                <div class="form-field">
                                    <input type="text" name="name" id="name" placeholder="Имя пользователя..." required>
                                </div>
                                <div class="form-field">
                                    <input type="email" name="email" id="email" placeholder="Email..." required>
                                </div>
                                <div class="form-field">
                                    <input type="text" name="text" id="text" placeholder="Текст задачи..." required>
                                </div>
                                <div class="error-block"></div>
                                <button type="submit"><i class="fa fa-plus"></i> Добавить задачу</button>
                            </form>
                        </div>
                        <button class="new-task">Новая задача</button>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Имя пользователя
                                    <a href="/site?type=name&direction=ASC<?=isset($_GET['page']) ? '&page='.$_GET['page'] : ''?>"><i class="far fa-arrow-down"></i></a> 
                                    <a href="/site?type=name&direction=DESC<?=isset($_GET['page']) ? '&page='.$_GET['page'] : ''?>"><i class="far fa-arrow-up"></i></a>
                                </th>
                                <th>Email
                                    <a href="/site?type=email&direction=ASC<?=isset($_GET['page']) ? '&page='.$_GET['page'] : ''?>"><i class="far fa-arrow-down"></i></a> 
                                    <a href="/site?type=email&direction=DESC<?=isset($_GET['page']) ? '&page='.$_GET['page'] : ''?>"><i class="far fa-arrow-up"></i></a>
                                </th>
                                <th style="width:25%;">Текст задачи</th>
                                <th>Статус
                                    <a href="/site?type=is_complete&direction=ASC<?=isset($_GET['page']) ? '&page='.$_GET['page'] : ''?>"><i class="far fa-arrow-down"></i></a> 
                                    <a href="/site?type=is_complete&direction=DESC<?=isset($_GET['page']) ? '&page='.$_GET['page'] : ''?>"><i class="far fa-arrow-up"></i></a>
                                </th>
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <th style="text-align:right;">Действия</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 0;
                            if (isset($_GET['page'])) {
                                $i = 3 * (intval($_GET['page']) - 1);
                            }
                            foreach ($pageData['tasks'] as $task) { 
                            $i++;
                        ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=htmlspecialchars($task['name'])?></td>
                                <td><?=htmlspecialchars($task['email'])?></td>
                                <td class="text-td" data-id="<?=$task['id']?>" data-text="<?=htmlspecialchars($task['text'])?>">
                                    <?=htmlspecialchars($task['text'])?>
                                    <?php if ($task['is_edited'] == 1) { ?>
                                        <br><span>отредактировано администратором</span>
                                    <?php } ?>
                                </td>
                                <td>
                                <?php if ($task['is_complete'] == 1) { ?>
                                    <i class="fa fa-check" style="color: #28a745;"></i> Выполнено
                                <?php } else { ?>
                                    Не выполнено
                                <?php } ?>
                                </td>
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <td style="text-align:right;">
                                    <?php if ($task['is_complete'] == 0) { ?>
                                        <a href="/site/complete?id=<?=$task['id']?><?= isset($_GET['page']) ? '&page='.$_GET['page'] : '';?>" class="btn btn-success"><i class="fa fa-check"></i></a>
                                    <?php } ?>
                                        <button class="btn btn-primary edit-text" data-id="<?=$task['id']?>"><i class="fa fa-pencil"></i></button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <ul class="pagination">
                    <?php for ($i = 1; $i < $pageData['pages'] + 1; $i++) { ?>
                        <li>
                            <a href="/site?page=<?=$i?><?= isset($_GET['type']) && isset($_GET['direction']) ? '&type='.$_GET['type'].'&direction='.$_GET['direction'] : '';?>" class="<?= $i == $_GET['page'] || !isset($_GET['page']) && $i == 1 ? 'active' : '';?>"><?=$i?></a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>