<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'full_name',
            'first_name',
            'last_name',
            'email:email',
            'password',
            'date_of_birth',
            'gender',
            'about_me',
            'contact_no',
            'address',
            'latitude',
            'longitude',
            'city',
            'country',
            'zipcode',
            'language',
            'profile_file',
            'is_notification',
            'tos',
            'role_id',
            'state_id',
            'type_id',
            'metric_no',
            'last_visit_time',
            'last_action_time',
            'last_password_change',
            'login_error_count',
            'activation_key',
            'timezone',
            'created_on',
            'created_by_id',
        ],
    ]) ?>

</div>
