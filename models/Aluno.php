<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property string $id
 * @property string $usuario_id
 * @property string $matricula
 * @property int $status
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Usuario $usuario
 * @property VinculoAlunoCurso[] $vinculoAlunoCursos
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'matricula'], 'required'],
            [['id', 'usuario_id', 'matricula', 'status', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['matricula'], 'unique'],
            [['id'], 'unique'],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'matricula' => 'Matricula',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVinculoAlunoCursos()
    {
        return $this->hasMany(VinculoAlunoCurso::className(), ['aluno_id' => 'id']);
    }
}
