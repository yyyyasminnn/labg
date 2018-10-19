<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "situacao_vinculo".
 *
 * @property int $id
 * @property string $nome
 * @property string $updated
 * @property string $created
 * @property int $ativo
 *
 * @property VinculoAlunoCurso[] $vinculoAlunoCursos
 * @property VinculoProfCurso[] $vinculoProfCursos
 */
class SituacaoVinculo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'situacao_vinculo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nome'], 'required'],
            [['id', 'ativo'], 'integer'],
            [['updated', 'created'], 'safe'],
            [['nome'], 'string', 'max' => 45],
            [['id'], 'unique'],
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
            'updated' => 'Updated',
            'created' => 'Created',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVinculoAlunoCursos()
    {
        return $this->hasMany(VinculoAlunoCurso::className(), ['situacao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVinculoProfCursos()
    {
        return $this->hasMany(VinculoProfCurso::className(), ['situacao_id' => 'id']);
    }
}
