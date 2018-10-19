<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unid_bloco".
 *
 * @property int $id
 * @property string $nome
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Curso[] $cursos
 */
class UnidBloco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unid_bloco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['created', 'updated'], 'safe'],
            [['ativo'], 'integer'],
            [['nome'], 'string', 'max' => 45],
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
        return $this->hasMany(Curso::className(), ['unid_bloco_id' => 'id']);
    }
}
