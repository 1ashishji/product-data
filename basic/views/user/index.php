<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'full_name',
            'first_name',
            'last_name',
            'email:email',
            //'password',
            //'date_of_birth',
            //'gender',
            //'about_me',
            //'contact_no',
            //'address',
            //'latitude',
            //'longitude',
            //'city',
            //'country',
            //'zipcode',
            //'language',
            //'profile_file',
            //'is_notification',
            //'tos',
            //'role_id',
            //'state_id',
            //'type_id',
            //'metric_no',
            //'last_visit_time',
            //'last_action_time',
            //'last_password_change',
            //'login_error_count',
            //'activation_key',
            //'timezone',
            //'created_on',
            //'created_by_id',
            [
                'class' => ActionColumn::className()
                
            ],
        ],
    ]); ?>


</div>
