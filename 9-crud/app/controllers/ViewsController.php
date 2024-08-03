<?php

    namespace app\controllers;
    use app\models\ViewsModel;

    class ViewsController extends ViewsModel {
        public function getViewsController($view) {
            if ($view != '') {
                $response = $this->getViewsModel($view);
            }
            else {
                $response = 'login';
            }

            return $response;
        }
    }

?>