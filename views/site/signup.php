<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/muda-perfil.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<div class="site-signup">
    <h1>Cadastro de Novo Usuário</h1>

    <p>Preencha os campos a seguir para fazer o seu cadastro:</p>

    <div class="row">
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>                
                <label for="dropPerfil">Perfil</label>
		<?= Html::dropDownList('selecionaPerfil', null, ['1'=>'Professor', '2'=>'Aluno'], ['prompt' => 'Selecione o Perfil', 'id'=>'dropPerfil', 'class'=>'form-control']) ?>			                
            
        </div>
    </div>
    
    <hr/>
    
    <h4 id="titulo-div-aluno" style="display:none;"><strong>Dados do Aluno</strong></h4>
    <h4 id="titulo-div-professor" style="display:none;"><strong>Dados do Professor</strong></h4>
    
    
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($usuario, 'nome')->textInput(['autofocus' => true]) ?>                                
        </div>
        <div class="col-md-3">
            <?= $form->field($usuario, 'sobrenome')->textInput(['autofocus' => true]) ?>
        </div>        
        <div class="col-md-3">
            <?= $form->field($usuario, 'rg')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-md-3" id="field-aluno" style="display:none;">
            <?= $form->field($aluno, 'matricula')->textInput(['autofocus' => true]) ?>
        </div>
        <div class="col-md-3" id="field-professor" style="display:none;">
            <?= $form->field($professor, 'link_curric_lattes')->textInput(['autofocus' => true]) ?>           
        </div>
    </div>
    
    <hr/>
    <h4><strong>Informações de Usuário</strong></h4>
    
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($usuario, 'username')->textInput(['autofocus' => true]) ?>                                                
        </div>
        <div class="col-md-3">
            <?= $form->field($usuario, 'email') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($usuario, 'senha')->passwordInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($usuario, 'repetirSenha')->passwordInput() ?>
        </div>
    </div>        
    
    <hr/>
    
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>