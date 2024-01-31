<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id_user
 * @property string $login
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property int $token
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $user = new User();
        $user->setScenario('register');
        if ($this->validate(false)) {
            $user->login = $this->login;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->email = $this->email;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            // Генерация токена после успешной регистрации
            $token = $this->generateToken();
            $user->token = $token;

            if ($user->save(false)) {
                return $token;
            }
        } 
        return null;     
    }
    protected function generateToken()
    {
        return Yii::$app->security->generateRandomString();
    }
    public function login()
    {
        
            $user = User::findOne(['login' => $this->login]);

            $token = $this->generateToken();
            $user->token = $token;
            $user->save(false);

            if ($user && Yii::$app->getSecurity()->validatePassword($this->password, $user->password)) {
                return $token;
            }
        

        return null;
    }
    public function rules()
    {
        return [
            [['login', 'first_name', 'last_name', 'email', 'password', 'token'], 'required'],
            [['token'], 'integer'],
            [['login'], 'string', 'max' => 50],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 120],
            [['password'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'login' => 'Login',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'token' => 'Token',
        ];
    }
}
