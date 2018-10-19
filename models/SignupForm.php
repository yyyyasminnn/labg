<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;

/**
 * ContactForm is the model behind the contact form.
 */
class SignupForm extends Model
{
    public $nome;
    public $sobrenome;
    public $rg;
    public $username;    
    public $email;
    public $senha;
    public $confirma_senha;
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [                        
            [['nome', 'sobrenome', 'rg','username','email', 'senha', 'confirma_senha'], 'required'],
            [['username'], 'unique', 'targetClass' => '\app\models\Usuario', 'message' => 'Esse nome de usuário já foi tomado.'],
            ['email', 'unique', 'targetClass' => '\app\models\Usuario', 'message' => 'Esse endereço de e-mail já foi tomado.'], 
            [['rg'], 'unique', 'targetClass' => '\app\models\Usuario', 'message' => 'Esse RG já foi usado.'],
            [['confirma_senha'], 'compare', 'compareAttribute'=>'senha', 'message'=>utf8_encode("Senhas não combinam")]

            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'sobrenome' => 'Sobrenome',
            'email' => 'E-mail',
            'username' => 'Nome de Usuário',
            'senha' => 'Senha',
            'auth_key' => 'Chave de Autenticação', 
            'rg' => 'RG',
            'foto' => 'Foto',
            'created' => 'Data de Criação',
            'updated' => 'Última Atualização',
            'ativo' => 'Ativo',
        ];
    }

    
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
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
        var_dump($user);exit;
        return $user->save() ? $user : null;
    }
}

