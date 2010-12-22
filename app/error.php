<?php
class AppError extends ErrorHandler {

  function error404($params)
    {
    $this->controller->layout = "error";
    parent::error404($params);
    }
   
}
?>