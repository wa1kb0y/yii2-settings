<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use yii\helpers\Html;
use yii\grid\GridView;
use pheme\settings\Module;
use pheme\settings\models\Setting;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var pheme\settings\models\SettingSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Module::t('settings', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?=
        Html::a(
            Module::t(
                'settings',
                'Create {modelClass}',
                [
                    'modelClass' => Module::t('settings', 'Setting'),
                ]
            ),
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                //'type',
                [
                    'attribute' => 'section',
                    'filter' => ArrayHelper::map(
                        Setting::find()->select('section')->distinct()->where(['<>', 'section', ''])->all(),
                        'section',
                        'section'
                    ),
                ],
                [
                    'attribute' => 'key',
                    'value' => function($model) {
                        $title = Html::tag('b', $model->key, ['class'=>($model->is_deprecated ? 'text-muted text-deprecated' : '')]);
                        $info = Html::tag('div', $model->info, ['class'=>'small text-muted']);
                        return $title.$info;
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'value',
                    'value' => function($model) {
                        return Yii::$app->formatter->asNText($model->value);
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => '\pheme\grid\ToggleColumn',
                    'attribute' => 'active',
                    'filter' => [1 => Yii::t('yii', 'Yes'), 0 => Yii::t('yii', 'No')],
                    'hideAttribute' => 'hide_active',
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
