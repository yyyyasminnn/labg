<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property string $id
 * @property string $nome
 * @property string $codigo
 * @property string $ppc
 * @property string $instituicao_id
 * @property int $unid_bloco_id
 * @property string $curso_original
 * @property string $updated
 * @property string $created
 * @property int $ativo
 *
 * @property UnidBloco $unidBloco
 * @property Curso $cursoOriginal
 * @property Curso[] $cursos
 * @property Instituicao $instituicao
 * @property VinculoAlunoCurso[] $vinculoAlunoCursos
 * @property VinculoProfCurso[] $vinculoProfCursos
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'codigo', 'ppc', 'instituicao_id', 'unid_bloco_id'], 'required'],
            [['instituicao_id', 'unid_bloco_id', 'curso_original', 'ativo'], 'integer'],
            [['updated', 'created'], 'safe'],
            [['nome', 'codigo', 'ppc'], 'string', 'max' => 45],
            [['unid_bloco_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidBloco::className(), 'targetAttribute' => ['unid_bloco_id' => 'id']],
            [['curso_original'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::className(), 'targetAttribute' => ['curso_original' => 'id']],
            [['instituicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituicao::className(), 'targetAttribute' => ['instituicao_id' => 'id']],
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
            'codigo' => 'Codigo',
            'ppc' => 'Ppc',
            'instituicao_id' => 'Instituicao ID',
            'unid_bloco_id' => 'Unid Bloco ID',
            'curso_original' => 'Curso Original',
            'updated' => 'Updated',
            'created' => 'Created',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidBloco()
    {
        return $this->hasOne(UnidBloco::className(), ['id' => 'unid_bloco_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCursoOriginal()
    {
        return $this->hasOne(Curso::className(), ['id' => 'curso_original']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::className(), ['curso_original' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstituicao()
    {
        return $this->hasOne(Instituicao::className(), ['id' => 'instituicao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVinculoAlunoCursos()
    {
        return $this->hasMany(VinculoAlunoCurso::className(), ['curso_id' => 'instituicao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVinculoProfCursos()
    {
        return $this->hasMany(VinculoProfCurso::className(), ['curso_id' => 'id']);
    }
}
