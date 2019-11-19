<?php

class View {

    public function render($viewTemplate, $pageData) {
        include ROOT .'/views/'. $viewTemplate .'.php';
    }

}

?>