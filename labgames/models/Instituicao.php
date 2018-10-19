<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "instituicao".
 *
 * @property string $id
 * @property string $nome
 * @property string $sobrenome
 * @property string $email
 * @property string $endereco_id
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Curso[] $cursos
 * @property Endereco $endereco
 */
class Instituicao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instituicao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'sobrenome', 'email', 'endereco_id'], 'required'],
            [['endereco_id', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['nome', 'sobrenome', 'email'], 'string', 'max' => 45],
            [['endereco_id'], 'exist', 'skipOnError' => true, 'targetClass' => Endereco::className(), 'targetAttribute' => ['endereco_id' => 'id']],
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
            'email' => 'Email',
            'endereco_id' => 'Endereco ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['instituicao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEndereco()
    {
        return $this->hasOne(Endereco::className(), ['id' => 'endereco_id']);
    }
}
