<?php

/* @var $this \humhub\modules\ui\view\components\View */
/* @var $model \humhubContrib\auth\orcid\models\ConfigureForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Yii::t('AuthORCIDModule.base', '<strong>ORCID</strong> Sign-In configuration') ?></div>

        <div class="panel-body">
            <p>
                <?= Html::a(Yii::t('AuthORCIDModule.base', 'ORCID Documentation'), 'https://info.orcid.org/documentation/integration-guide/sign-in-using-orcid-credentials/', ['class' => 'btn btn-primary pull-right btn-sm', 'target' => '_blank']); ?>
                <?= Yii::t('AuthORCIDModule.base', 'Please follow the ORCID instructions to create the required <strong>OAuth client</strong> credentials.'); ?>
                <br/>
            </p>
            <br/>

            <?php $form = ActiveForm::begin(['id' => 'configure-form', 'enableClientValidation' => false, 'enableClientScript' => false]); ?>

            <?= $form->field($model, 'enabled')->checkbox(); ?>

            <br/>
            <?= $form->field($model, 'clientId'); ?>
            <?= $form->field($model, 'clientSecret'); ?>
            <?= $form->field($model, 'serverUrl'); ?>

            <br/>
            <?= $form->field($model, 'redirectUri')->textInput(['readonly' => true]); ?>
            <br/>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('base', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
