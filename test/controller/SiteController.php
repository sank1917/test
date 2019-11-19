<?php

class SiteController extends Controller {

    public function __construct() {
        $this->view = new View();
        $this->model = new SiteModel();
    }

    public function index() {
        $this->pageData['title'] = 'Список задач';

        $limit = 3;
        $offset = 0;
        $allTasks = count($this->model->getTasks());
        $totalPages = ceil($allTasks / $limit);
        $this->pageData['pages'] = $totalPages;

        if(!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $offset = 0;
        } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages;
            $offset = $limit * ($totalPages - 1);
        } else {
            $pageNumber = intval($_GET['page']);
            $offset = $limit * ($pageNumber-1);
        }

        $tasks = $this->model->getLimitTasks($limit, $offset);
        $this->pageData['tasks'] = $tasks;

        $this->view->render('main', $this->pageData);
    }

    public function addTask() {
        if(!empty($_POST) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['text'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $text = $_POST['text'];

            if($this->model->addNewTask($name, $email, $text)) {
                setcookie('added', 'Задание успешно добавлено', time()+3);
                header('Location: /site');
            }
        }
    }

    public function complete() {
        if (!$_SESSION['user']) {
            header('Location: /login');
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if ($this->model->completeTask($id)) {
                    if (isset($_GET['page'])) {
                        header('Location: /site?page='.$_GET['page']);
                    } else {
                        header('Location: /site');
                    }
                }
            }
        }
    }

    public function editTask() {
        if (!$_SESSION['user']) {
            header('Location: /login');
        } else {
            if (isset($_POST['id']) && isset($_POST['text'])) {
                $id = $_POST['id'];
                $text = $_POST['text'];
                if ($this->model->editTask($id, $text)) {
                    return true;
                }
            }
        }
    }

}

?>