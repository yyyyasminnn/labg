<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vinculo_prof_curso".
 *
 * @property string $id
 * @property int $situacao_id
 * @property string $curso_id
 * @property string $prof_id
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Curso $curso
 * @property Professor $prof
 * @property SituacaoVinculo $situacao
 */
class VinculoProfCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vinculo_prof_curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['situacao_id', 'curso_id', 'prof_id'], 'required'],
            [['situacao_id', 'curso_id', 'prof_id', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'id']],
            [['prof_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['prof_id' => 'id']],
            [['situacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => SituacaoVinculo::className(), 'targetAttribute' => ['situacao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'situacao_id' => 'Situacao ID',
            'curso_id' => 'Curso ID',
            'prof_id' => 'Prof ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'curso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProf()
    {
        return $this->hasOne(Professor::className(), ['id' => 'prof_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(SituacaoVinculo::className(), ['id' => 'situacao_id']);
    }
}
