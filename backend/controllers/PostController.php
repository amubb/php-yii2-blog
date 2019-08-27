<?php

namespace backend\controllers;

use backend\components\BaseController;
use common\models\Post;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class PostController
 * @package backend\controllers
 */
class PostController extends BaseController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->selectNoText()->with('categories')->with('author')->orderByCid(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->allowComment = true;
        $model->allowFeed = true;
        $model->allowPing = true;

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->inputCategories = Yii::$app->request->post('inputCategories', []);
                $model->inputTags = Yii::$app->request->post('inputTags', []);
                $model->inputAttachments = Yii::$app->request->post('inputAttachments', []);
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->inputCategories = Yii::$app->request->post('inputCategories', []);
                $model->inputTags = Yii::$app->request->post('inputTags', []);
                $model->inputAttachments = Yii::$app->request->post('inputAttachments', []);
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Post::find()->andWhere(['cid' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
