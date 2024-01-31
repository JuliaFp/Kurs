<?php
namespace app\controllers;
use app\models\User;
use Yii;
use yii\web\Response;
use yii\rest\ActiveController;
use app\models\Region;
class RegionController extends ActiveController {
  public $modelClass = 'app\models\User';
  protected function findUserByToken($token)
  {
      return User::findOne(['token' => $token]);
  }
  public function actionUpdateRegion() {
        $response = $this->response;
        $user = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
        if ($user !== null) {

            $region = Product::findOne(['id_regoin' => Yii::$app->request->post('id_region')]);
            if($region){   
                $region->load($region, '');
                $region->name = Yii::$app->request->post('name');
                if($region->save()){
                    $response->statusCode = 204;
                    $response->data = [
                        'data' => [
                            'status' => 'ok'
                        ]
                        ];
                }else{
                    $response->statusCode = 422;
                    $response->data = [
                        'data' => 'Ошибка валидации'
                        ];
                }
            }else{
                $response->statusCode = 404;
                    $response->data = [
                        'data' => 'Такой области не существует'
                        ];
            }
        }else{
            $response->statusCode = 403;
            $response->data = [
            'data' => [
                'message' => 'Не авторизированный пользователь'
                ]
            ];
        }
        return $response;
    }
    
    public function actionCreates(){
        $response = $this->response;
        $region = new Region();
        if($this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')))){
            if($region->load(Yii::$app->request->post(),'') && $region->save()){
                $response->data = [
                    'data' => [
                        'status' => 'ok',
                    ]
                ];
            }
        }else{
            $response->data = [
                'data' => [
                    'code' => '403',
                    'message' => 'Не авторизированный пользователь',
                ]
            ];
        }
    }
    public function actionUpdates(){
        $response = $this->response;
        if($this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')))){
            $region = Region::findOne(['id_region' => Yii::$app->request->get('id_region')]);
            if($region){
                $region->name = Yii::$app->request->post('new_name');
                $region->save(false);
                $response->data = [
                    'data' => [
                        'status' => 'ok',
                    ]
                ];
            }else{
                $response->data = [
                    'data' => [
                        'code' => '404',
                        'message' => 'Страница не найдена',
                    ]
                ];
            }
        }else{
            $response->data = [
                'data' => [
                    'code' => '403',
                    'message' => 'Не авторизированный пользователь',
                ]
            ];
        }
    } 
    public function actionDel(){
        $response = $this->response;
        $region = Region::findOne(['name' => Yii::$app->request->post('name')]);
        if($this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')))){
            if($region){
                $region->delete();
                $response->data = [
                    'data' => [
                        'status' => 'ok'
                    ]
                ];
            }else{
                $response->data = [
                    'data' => [
                        'code' => '404',
                        'message' => 'Страница не найдена',
                    ]
                ];
            }
        }else{
            $response->data = [
                'data' => [
                    'code' => '403',
                    'message' => 'Не авторизированный пользователь',
                ]
            ];
        }
    }
  protected function responseSuccessfull($statusCode, $message)
    {
        $response = $this->response;
        $response->setStatusCode($statusCode);
        $response->data = [
            'data' => [
                'code' => $statusCode,
                'message' => $message,
            ],
        ];
        return $response;
    }
  protected function responseError($statusCode, $message)
    {
        $response = $this->response;
        $response->setStatusCode($statusCode);
        $response->data = [
            'error' => [
                'code' => $statusCode,
                'message' => $message,
            ],
        ];
        return $response;
    }
}