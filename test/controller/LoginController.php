<?php

class LoginController extends Controller {

    public function __construct() {
        $this->model = new LoginModel();
        $this->view = new View(); 
    }

    public function index() {
        if (isset($_SESSION['user'])) {
            header("Location: /site");
        }
        
        $this->pageData['title'] = 'Вход';
        if(!empty($_POST)) {
			if(!$this->model->checkUser()) { 
				$this->pageData['error'] = "Ошибка валидации! Проверьте введенные данные и попробуйте снова.";
			}
		}
        $this->view->render('login', $this->pageData);
    }
    
    public function logout() {
        unset($_SESSION['user']);
        header("Location: /site"); 
    }

}

?>