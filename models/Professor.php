<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "professor".
 *
 * @property string $id
 * @property string $usuario_id
 * @property string $link_curric_lattes
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Usuario $usuario
 * @property VinculoProfCurso[] $vinculoProfCursos
 */
class Professor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'professor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'required'],
            [['usuario_id', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['link_curric_lattes'], 'string', 'max' => 45],
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
            'link_curric_lattes' => 'Link do Currículo Lattes',
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
    public function getVinculoProfCursos()
    {
        return $this->hasMany(VinculoProfCurso::className(), ['prof_id' => 'id']);
    }
}
