<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "endereco".
 *
 * @property string $id
 * @property string $logradouro
 * @property int $numero
 * @property string $complemento
 * @property string $cep
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Instituicao[] $instituicaos
 */
class Endereco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'endereco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logradouro', 'numero'], 'required'],
            [['numero', 'cep', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['logradouro', 'complemento'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logradouro' => 'Logradouro',
            'numero' => 'Numero',
            'complemento' => 'Complemento',
            'cep' => 'Cep',
            'created' => 'Created',
            'updated' => 'Updated',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstituicaos()
    {
        return $this->hasMany(Instituicao::className(), ['endereco_id' => 'id']);
    }
}
