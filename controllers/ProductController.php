<?php
namespace app\controllers;
use Yii;
use app\models\Product;
use app\models\Cart;
use yii\web\Response;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\User;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';
    /**
     * @inheritDoc
     */
    protected function findUserByToken($token)
    {
        return User::findOne(['token' => $token]);
    }
    public function actionSearch(){
        $response = $this->response;
        $product = Product::find()->where(Yii::$app->request->post('name_column').' = '.Yii::$app->request->post('value'))->one();
        if($this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')))){
            if($product){
                $response->data = [
                    'data' => $product,
                ];
            }else{ 
                $response->data = [
                    'data' => [
                        'code' => 404,
                        'message' => 'Страница не найдена',
                    ],
                ];
            }
        }else{
            $response->data = [
                'data' => [
                    'code' => 403,
                    'message' => 'Нет прав',
                ],
            ];
        }

    }
    public function actionGet(){
        $response = $this->response;
        $product = Product::findOne(['id_product' => Yii::$app->request->get('id_product')]);
        if($product){
            $response->data = [
                'data' => [
                    'code' => 200,
                    'image' => $product->image,
                    'name' => $product->name,
                    'amount' => $product->amount,
                    'price' => $product->price,
                    'id_product' => $product->id_product,
                    'region_id' => $product->region_id,

                ],
            ];
        }else{
            $response->data = [
                'data' => [
                    'code' => 404,
                    'message' => 'Страница не найдена',
                ],
            ];
        }


    }
    public function actionCreate(){
        $response = $this->response;
        $product = new Product();
        if($this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')))){
            if($product->load(Yii::$app->request->post()) && $product->save()){
                $response->data = [
                    'data' => [
                        'status' => 'ok',
                        'id_product' => $product->id_product,
                    ]
                ];
            }else{
                $response->data = [
                    'data' => [
                        'code' => '422',
                        'message' => 'Ошибка валидации'
                    ]
                ];
            }
        }else{
            $response->data = [
                'data' => [
                    'code' => 403,
                    'message' => 'Нет прав',
                ],
            ];
        }
    }
    public function actionDel(){

        $response = $this->response;
        $product = Product::findOne(['id_product' => Yii::$app->request->post('id_product')]);
        $response->data = $product->id_product;
        $users = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
        if ($users !== null) {
            if($product){
                $product->delete();
                $response->data = [
                    'data' => [
                        'status' => 'ok',
                    ],
                ];
            }else{
                $response->data = [
                    'data' => [
                        'code' => 404,
                        'message' => 'Страница не найдена',
                    ],
                ];
            }
        }else{
            $response->data = [
                'data' => [
                    'code' => 403,
                    'message' => 'Нет прав',
                ],
            ];
        }

    }
}
