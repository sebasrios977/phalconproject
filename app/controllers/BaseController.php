<?php

abstract class BaseController extends Phalcon\Mvc\Controller
{
    protected $_textStatus =  [
        200 => "Ok",
        201 => "Created",
        400 => 'Bad Request',
    ];
    protected function jsonResponse($data, $status) {
        $this->response->setStatusCode($status, $this->_textStatus[$status]);
        $this->response->setJsonContent($data);
        $this->response->send();
        return;
    }

    protected function errorsResponse($model) {
        $errors = [];
        foreach($model->getMessages() as $messages) {
            $errors[] = [
                "message" => $messages->getMessage(),
                "field" => $messages->getField(),
            ];
        }
        $this->jsonResponse($errors, 400);
    }
}
