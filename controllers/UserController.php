<?php
namespace app\controllers;
use app\models\User;
use Yii;
use yii\web\Response;
use yii\rest\ActiveController;
class UserController extends ActiveController {
  public $modelClass = 'app\models\User';
  protected function findUserByToken($token)
  {
      return User::findOne(['token' => $token]);
  }
  public function actionDel() {
    $response = $this->response;
    $users = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
    if($users){
        $user = User::findOne(['id_user' => Yii::$app->request->get('id_user')]);
        if($user){
            $user->delete();
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
                'message' => 'Не авторизированный пользователь',
            ],
        ];
    }
  }
  public function actionRegister() {
 
        $data=Yii::$app->request->post();
        $user=new User();
        $user->load($data, '');
        $token = $user->register();
        $response = $this->response;
        echo $token;
        if ($token !== null) {
            $response->statusCode = 204;
            $response->data = ['data' => ['token' => $token]];
            return $response;
        } else {
            $response->statusCode = 422;
            $response->data = [
                'error' => [
                    'code' => 422,
                    'message' => 'Ошибка валидации'
                ],
                'error_description' => $user->errors,
                'error' => [ 
                    'code' => 403,
                    'message' => 'Ошибка доступа'
                ],
                'error_description' => $user->errors,
                'error' => [
                    'code' => 404,
                    'message' => 'Страница не найдена'
                ],
                'error_description' => $user->errors   
            ];
            return $response;
        }
  }
  public function actionGet() {
    $login = Yii::$app->request->get('login');
    $user = User::findOne(['login' => $login]);
    $response = $this->response;
    $users = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
    if ($users !== null) {
      $response->statusCode = 200;
      $response->data = [
        'data' => [
          'code' => 200,
          'first_name' => $user->first_name,
          'last_name' => $user->last_name,
          'phone' => $user->phone,
          'photo' => $user->photo
        ]
      ];
    }else{
      $this->responseError(403,"У вас нет прав для совершения это операции");
    }
  }
  public function actionBonusplus(){
    $user = new User();
    $response = $this->response;
    $users = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
    if ($users !== null) {
      
      $login = Yii::$app->request->post('login');
      $bonus = Yii::$app->request->post('bonus');
      $users->load($login,'');
      $users->bonus = $user->bonus + $bonus;
      $users->save(false);
      $response->data = [
        'data' => 'null'
      ];
    }else{
    $response->statusCode = 403;
    $response->data = [
      'data' => [
        'code' => 403,
        'message' => 'У вас нет прав для проведения этой операции'
      ]
    ];
    }
    return $response;
  }
  public function actionLogin(){
    $user = User::findOne(['login' => Yii::$app->request->post('login')]);

    $token = $this->generateToken();

    $user->token = $token;

    $user->save(false);

    if ($user && Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('password'), $user->password)) {

      $response = $this->response;

      $response->statusCode = 200;

      $response->data = ['data' => ['token' => $token]];

      return $response;
    }else {

      $this->responseError(401, 'Не правильный пароль или логин');
    }
  }
  protected function generateToken()
  {
      return Yii::$app->security->generateRandomString();
  }
  public function actionUpdates(){
    $response = $this->response;
    $users = $this->findUserByToken(str_replace('Bearer ', '', Yii::$app->request->headers->get('Authorization')));
    if ($users !== null) {
        $user = User::findOne(['login' => Yii::$app->request->get('login')]);
        if($user){
            $user->first_name = Yii::$app->request->post('first_name'); 
            $user->last_name = Yii::$app->request->post('last_name'); 
            $user->email = Yii::$app->request->post('email'); 
            $user->password = Yii::$app->request->post('password'); 
            $user->save(false);
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
                'message' => 'Ошибка доступа',
            ],
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
