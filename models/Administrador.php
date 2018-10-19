<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrador".
 *
 * @property string $id
 * @property string $usuario_id
 * @property string $faculdade_id
 * @property string $created
 * @property string $updated
 * @property int $ativo
 *
 * @property Usuario $usuario
 */
class Administrador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'faculdade_id'], 'required'],
            [['usuario_id', 'faculdade_id', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
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
            'faculdade_id' => 'Faculdade ID',
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
}
