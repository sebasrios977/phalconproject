<?php

class CountriesController extends BaseController
{

    public function getAction()
    {
        $countries = Countries::find();
        $this->jsonResponse($countries->toArray(), 200);
    }

    public function createAction()
    {
        $country = new Countries();
        $country->country = $this->request->getPost('country');
        $country->iso_code = $this->request->getPost('iso');
        if($country->save()) {
            $this->jsonResponse($country->toArray(), 201);
        } else {
            $this->errorsResponse($country);
        }
    }

    public function updateAction($id)
    {
        $country = Countries::findFirst($id);
        if(gettype($country) == 'object') {
            $country->country = $this->request->getPut('country');
            $country->iso_code = $this->request->getPut('iso');
            if($country->save()) {
                $this->jsonResponse($country->toArray(), 200);
            } else {
                $this->errorsResponse($country);
            }
        } else {
            $this->jsonResponse(["message" => "El pais que intenta modificar no existe"], 400);
        }
    }

    public function deleteAction($id)
    {
        $country = Countries::findFirst($id);
        if(gettype($country) == 'object') {
            if($country->delete()) {
                $this->jsonResponse(["Message" => "El pais con el id $id fue borrado satisfactoriamente"], 200);
            } else {
                $errors[] = [
                    "message" => "Hubo un error y no se pudo borrar el pais"
                ];
            }
            return;
        } else {
            $errors[] = [
                "message" => "El pais con el id $id no se pudo encontrar"
            ];
        }
        $this->jsonResponse($errors, 400);
    }

}

