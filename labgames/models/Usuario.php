<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $id
 * @property string $nome
 * @property string $sobrenome
 * @property string $email
 * @property string $username
 * @property string $senha
 * @property resource $authKey
 * @property string $rg
 * @property resource $foto_arq
 * * @property resource $foto_url
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Administrador[] $administradors
 * @property Aluno[] $alunos
 * @property Professor[] $professors
 */
class Usuario extends ActiveRecord implements IdentityInterface
{
    
    public $repetirSenha;
    public $campoSenha;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'sobrenome', 'rg', 'email', 'username', 'senha', 'repetirSenha'], 'required','on'=>'signup'],
            [['username', 'senha'], 'required', 'on'=>'login'],                                                  
            [['username','email','rg'], 'trim'],                          
            [['nome', 'sobrenome', 'email', 'username','senha','auth_key'], 'string', 'max' => 100],
            [['rg', 'ativo'], 'integer'],                                                          
            [['email'], 'email'],                                              
            [['foto_arq'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'on'=> 'update'],             
            [['foto_url'],'string','max'=>250, 'on'=> 'update'],
            [['created', 'updated'], 'safe'],                           
            
            [['username'], 'unique', 'targetClass' => '\app\models\Usuario', 'message' => utf8_encode("Esse nome de usuário já foi tomado.")],
            ['email', 'unique', 'targetClass' => '\app\models\Usuario', 'message' => utf8_encode("Esse endereço de e-mail já foi tomado.")], 
            [['rg'], 'unique', 'targetClass' => '\app\models\Usuario', 'message' => utf8_encode("Esse RG já foi usado.")],
            [['repetirSenha'], 'compare', 'compareAttribute'=>'senha', 'message'=>utf8_encode("Senhas não combinam.")],                        
            [['username'], 'unique', 'targetAttribute' => ['usernameLowercase' => 'lower(username)']],           
            [['repetirSenha'], 'compare', 'compareAttribute'=>'senha', 'message'=>utf8_encode("Senhas não combinam")],             
            ['email', 'unique', 'targetClass' => '\app\models\Usuario', 'message' => utf8_encode("Esse endereço de e-mail já foi tomado.")],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'foto_arq' => 'Foto',
            'foto_url' => 'Foto URL',
            'created' => 'Data de Criação',
            'updated' => 'Última Atualização',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministradors()
    {
        return $this->hasMany(Administrador::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessors()
    {
        return $this->hasMany(Professor::className(), ['usuario_id' => 'id']);
    }
   
    
    /*~ The following authentication methods were taken from the class User ~*/            
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)            
    {
        $usuario = Usuario::findOne(['id'=>$id]);
        return isset($usuario) ? new static($usuario) : null;
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Not yet implemented
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $usuarios = Usuario::find()->all();
        foreach ($usuarios as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->senha === $password;
    } 
    
    /*~ Validation Methods ~*/
        
    public function getUsernameLowercase()
    {
        return strtolower($this->username);
    }        
    /*
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->scenario == 'signup') {
                $this->auth_key = $app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
    */
    public function beforeSave($insert) 
    {
        if(isset($this->campo_senha)) {
            $this->password = Security::generatePasswordHash($this->campo_senha);
        }
        return parent::beforeSave($insert);
    }
    
     public function setPassword($campo_senha)
    {
        $this->senha = Yii::$app->security->generatePasswordHash($campo_senha);
    }
    
    
    
   

}
