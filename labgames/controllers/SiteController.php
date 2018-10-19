<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Usuario;
use app\models\Aluno;
use app\models\Professor;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {            
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSignup1(){
        $usuario = new Usuario();        
        $usuario->scenario = 'signup';
        if($usuario->load(Yii::$app->request->post())){
            $transaction = Yii::$app->db->beginTransaction();
            
            if($usuario->save()){
                Yii::$app->session->setFlash('sucesso', 'Usuário Salvo com Sucesso');
                $transaction->commit();
                return $this->redirect(['site/index']);
            }else{
                $usuario->senha = '';
                $usuario->repetirSenha = '';
                $erroMsg = '';                
                foreach($usuario->errors as $campos){                    
                    foreach($campos as $erro){                        
                        $erroMsg .= '<li>'.$erro.'</li>';
                    }
                }
                Yii::$app->session->setFlash('temErro', $erroMsg);                
                $transaction->rollback();                
            }            
        }
        return $this->render('signup', ['usuario'=>$usuario]);
    }
    
    public function actionSignup () {
        $usuario = new Usuario();
        $professor = new Professor();
        $aluno = new Aluno();
        $usuario->scenario = 'signup';
        if ($usuario->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();            
            if($usuario->save()){
                if(Yii::$app->request->post('selecionaPerfil') == '1'){
                    if($professor->load(Yii::$app->request->post())){
                        $professor->usuario_id = $usuario->id;                                                
                        if(!$professor->save()){
                            $transaction->rollBack();
                        }
                    }
                }else{
                    if($aluno->load(Yii::$app->request->post())){
                        $aluno->usuario_id = $usuario->id;
                        if(!$aluno->save()){
                            $transaction->rollBack();
                        }
                    }
                }                
            }else{
                $transaction->rollBack();
            }
            $transaction->commit();
            return $this->redirect(['login']);
        }

        return $this->render('signup', [
            'usuario' => $usuario,
			'professor' => $professor,
			'aluno' => $aluno
        ]);
    }
        
    
    /*
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    
                    var_dump($user);exit;
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
     public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
                
        $user = new Usuario();
       
            
        $user->username = $this->username;
        $user->nome = $this->nome;
        $user->sobrenome = $this->sobrenome;
        $user->rg = $this->rg;
        $user->email = $this->email;
        $user->setPassword($this->senha);
        /*
        if($user->validatePassword($this->confirma_senha)) {
            return null;
        }*/
        /*$user->generateAuthKey();*/
    /*    
        return $user->save() ? $user : null;
    }
    
    */

}
