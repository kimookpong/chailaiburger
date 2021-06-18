<?php

namespace frontend\controllers;

use Yii;
use common\models\OrderList;
use common\models\OrderItem;
use common\models\ProductList;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderlistController implements the CRUD actions for OrderList model.
 */
class OrderlistController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new OrderList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('order', [
            'model' => $model,
        ]);
    }

    public function actionComplete()
    {

        return $this->render('complete');
    }

    /**
     * Displays a single OrderList model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrderList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderList();
        $model->code = Yii::$app->security->generateRandomString(8);
        $model->created_at = strtotime("now");
        $model->updated_at = strtotime("now");
        $model->user_id     = Yii::$app->user->identity->id ? Yii::$app->user->identity->id : 0;
        $model->created_by  = Yii::$app->user->identity->id ? Yii::$app->user->identity->id : 0;
        $model->updated_by  = Yii::$app->user->identity->id ? Yii::$app->user->identity->id : 0;



        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelItemCheck = ProductList::find()->all();
            foreach ($modelItemCheck as $item) {
                if (isset($_COOKIE['item' . $item->id]) && $_COOKIE['item' . $item->id] > 0) {

                    $modelItem = new OrderItem();
                    $modelItem->code            = $model->code;
                    $modelItem->product_id      = $item->id;
                    $modelItem->product_name    = $item->name;
                    $modelItem->price           = ($item->discount > 0) ? $item->discount : $item->price;
                    $modelItem->quantity        = $_COOKIE['item' . $item->id];
                    $modelItem->comment         = "";
                    $modelItem->save();

                    unset($_COOKIE['item' . $item->id]);
                    setcookie('item' . $item->id, '', time() - 3600, '/');
                }
            }

            unset($_COOKIE['totalCart']);
            unset($_COOKIE['totalPrice']);
            setcookie('totalCart', '', time() - 3600, '/');
            setcookie('totalPrice', '', time() - 3600, '/');

            return $this->redirect(['complete', 'id' => $model->id]);
        }

        return $this->render('confirm', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrderList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrderList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderList::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
