<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Form;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $form = new Form;
        if (Yii::$app->request->isPost) {
            if($form->upload(UploadedFile::getInstance($form, 'file'))) {
                return $this->render('result', ['data' => $form->getData()]);
            } else {
                Yii::$app->session->setFlash('error', 'Выберите корректный html или htm файл');
            }
        }
        return $this->render('index', ['form' => $form]);
    }
}
