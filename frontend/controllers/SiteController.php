<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\UserData;
use common\models\User;
use frontend\models\UploadUserImg;
use yii\web\UploadedFile;
use common\models\Country;
use common\models\Region;
use common\models\City;

/**
 * Site controller
 */
class SiteController extends Controller
{   
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {    
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $signUp = new SignupForm();
        $login = new LoginForm();
        
        if (isset($_POST['loginSubmit']) && $this->loginLoad($login) && $login->login()) {
            return $this->goHome();
        } else {
            $login->password = '';
            $login->email = '';

            return $this->render('login', [
                'login' => $login,
                'signUp' => $signUp,
            ]);
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignUp()
    {   
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $login = new LoginForm(); 
        $signUp = new SignupForm();
        
        if ($this->signUpLoad($signUp) && $signUp->signup()) {
            return $this->goHome();
        } else {

            $signUp->password = '';
            $signUp->email = '';

            return $this->render('login', [
                'login' => $login,
                'signUp' => $signUp,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    protected function loginLoad($loginModel)
    {   
        $loginModel->email = $_POST['email'];
        $loginModel->password = $_POST['password'];
        $loginModel->rememberMe = isset($_POST['rememberMe']) ? 1 : 0;
        return true;
    }

    protected function signUpLoad($signUpModel) 
    {
        if($_POST != null) {
            foreach($_POST as $data) {
                if ($data == null) return false;
            }
        }

        $signUpModel->username = $_POST['username'];
        $signUpModel->password = $_POST['password'];
        $signUpModel->email = $_POST['email'];
        return true;
    }

    public function actionProfile()
    {   
        $user_id = Yii::$app->user->identity['id'];
        $email = Yii::$app->user->identity['email'];

        if (!UserData::findOne(['user_id' => $user_id])) {
            $user_data = new UserData();

            if (isset($_POST['submit'])){
                $uploadImage = new UploadUserImg();

                $this->changeUserProfile($user_data);
                $this->modifyArrayFILES('UploadUserImg', 'user_image', 'user_image');
                $uploadImage->user_image = UploadedFile::getInstance($uploadImage, 'user_image');
                
                if ($uploadImage->user_image) {
                    $user_data->image = $uploadImage->upload('users');
                }

                $user_data->save();

                return $this->goHome();
            }

            return $this->render('profile', [
                'email' => $email,
                'user_data' => $user_data,
            ]);

        } else {
            $user_data = UserData::findOne(['user_id' => $user_id]);

            if (isset($_POST['submit'])) {
                $uploadImage = new UploadUserImg();

                $this->changeUserProfile($user_data);
                $this->modifyArrayFILES('UploadUserImg', 'user_image','user_image');
                $uploadImage->user_image = UploadedFile::getInstance($uploadImage, 'user_image');
                if ($uploadImage->user_image) {
                    $user_data->image = $uploadImage->upload('users', $user_data->image);
                }
                $user_data->save();

                return $this->goHome();
            }   
            return $this->render('profile', [
                'email' => $email,
                'user_data' => $user_data,
            ]);  
        }
    }

    protected function changeUserProfile($user_data)
    {   
        $user_data->user_id = Yii::$app->user->identity['id'];
        $user_data->first_name = Yii::$app->request->post('f_name');
        $user_data->last_name = Yii::$app->request->post('l_name');
        $user_data->company = Yii::$app->request->post('company');
        $user_data->number_phone = Yii::$app->request->post('number');
        $user_data->first_address = Yii::$app->request->post('add1');
        $user_data->second_address = Yii::$app->request->post('add2');
        $user_data->country = Yii::$app->request->post('country');
        $user_data->region = Yii::$app->request->post('region');
        $user_data->city = Yii::$app->request->post('city');
    }


    // ====================== AJAX ACTIONS =====================
    // --------------------- SIGN_UP REQUESTS ---------------//
    public function actionEmailValidate()
    {
        $email = Yii::$app->request->get('email');

        if (strlen($email) == 0) {
            return 'Заполните данное поле.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Данный Email не корректный.';
        }
        if (User::findOne(['email' => $email])) {
            return 'Данный email уже занят.';
        }
        
    }

    public function actionPasswordValidate()
    {
        $password = Yii::$app->request->get('password');

        if (strlen($password) == 0) {
            return 'Заполните данное поле.';
        }
        if (strlen($password) < 6) {
            return 'Ваш пароль слишком корроткий.(Минимум 6 сим.).';
        }
    }

    public function actionUsernameValidate()
    {
        $username = Yii::$app->request->get('username');
        
        if (strlen($username) == 0) {
            return 'Заполните данное поле.';
        }
        if (strlen($username) < 5) {
            return 'Ваш логин слишком короткий.(Минимум 5 сим).';
        }
        if (strlen($username) > 255) {
            return 'Ваш логин слишком длинный.(Максимум 255 сим).';
        }
        if (User::findOne(['username' => $username])) {
            return 'Данный логин уже занят.';
        }
    }

    // ---------------------- LOGIN REQUESTS -----------------------------//
    public function actionLoginEmailValidate()
    {
        $email = Yii::$app->request->get('email');

        $user = User::findByEmail($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Данный Email не корректный.';
        }
        if (strlen($email) == 0) {
            return 'Заполните данное поле';
        }
        if (!$user) {
            return 'Данный Email не найден.';
        }     
    }

    public function actionLoginPasswordValidate()
    {
        $email = Yii::$app->request->get('email');
        $password = Yii::$app->request->get('password');

        $user = User::findByEmail($email);
        if (strlen($password) == 0) {
            return 'Заполните данное поле.';
        }
        if (strlen($password) < 6) {
            return 'Ваш пароль слишком корроткий.(Минимум 6 сим.).';
        }
        if (!$user->validatePassword($password)) {
            return 'Неправильный пароль.';
        }
    }

    // --------------------- SELECT ADDRESS -------------------
    public function actionSelectCountry()
    {
        $countryName = Yii::$app->request->get('countryName');
        $result = Country::find()->where(['like', 'name', $countryName.'%', false])->limit(5)->all();
      
        return $this->asJson($result);
    }

    public function actionSelectRegion()
    {   
        $regionName = Yii::$app->request->get('regionName');

        if ($country_id = Yii::$app->request->get('country_id')) {
            $result = Region::find()->where(['id_country' => $country_id])
                ->andWhere(['like', 'name', $regionName.'%', false])->all();

            return $this->asJson($result);
        } 

        $result = Region::find()->andWhere(['like', 'name', $regionName.'%', false])->all();
    
        return $this->asJson($result);
    }

    public function actionSelectCity()
    {
        $cityName = Yii::$app->request->get('cityName');

        if ($region_id = Yii::$app->request->get('region_id')) {
            $result = City::find()->where(['id_region' => $region_id])
                ->andWhere(['like', 'name', $cityName.'%', false])->all();

            return $this->asJson($result);
        } 

        if ($country_id = Yii::$app->request->get('country_id')) {
            $result = City::find()->where(['id_country' => $country_id])
                ->andWhere(['like', 'name', $cityName.'%', false])->all();

            return $this->asJson($result);
        } 

        $result = City::find()->andWhere(['like', 'name', $cityName.'%', false])->all();
    
        return $this->asJson($result);
    }
    // ===================== END AJAX ==========================

    // ==================== HELPER METHODS ======================
    protected function modifyArrayFILES($modelName, $modelAttr, $inputName)
    {   
        foreach($_FILES[$inputName] as $property => $propValue) {
            $_FILES[$modelName][$property][$modelAttr] = $propValue;
        }
        unset($_FILES[$inputName]);
    }

    protected function debug($val, $exit = true)
    {
        echo "<pre>";
        print_r($val);
        echo "</pre>";
        if ($exit == true) {
            exit();
        }
    }
}
