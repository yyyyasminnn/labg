<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vinculo_aluno_curso".
 *
 * @property string $id
 * @property int $situacao_id
 * @property string $curso_id
 * @property string $aluno_id
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Aluno $aluno
 * @property Curso $curso
 * @property SituacaoVinculo $situacao
 */
class VinculoAlunoCurso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vinculo_aluno_curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['situacao_id', 'curso_id', 'aluno_id'], 'required'],
            [['situacao_id', 'curso_id', 'aluno_id', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['aluno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['aluno_id' => 'id']],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_id' => 'instituicao_id']],
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
            'aluno_id' => 'Aluno ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'aluno_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['instituicao_id' => 'curso_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(SituacaoVinculo::className(), ['id' => 'situacao_id']);
    }
}
