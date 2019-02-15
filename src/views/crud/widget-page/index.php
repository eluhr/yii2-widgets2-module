<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var hrzg\widget\models\crud\search\WidgetPage $searchModel
 */

$this->title = Yii::t('widgets', 'Widget Pages');
$this->params['breadcrumbs'][] = $this->title;

if (isset($actionColumnTemplates)) {
    $actionColumnTemplate = implode(' ', $actionColumnTemplates);
    $actionColumnTemplateString = $actionColumnTemplate;
} else {
    Yii::$app->view->params['pageButtons'] = Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('widgets', 'New'), ['create'], ['class' => 'btn btn-success']);
    $actionColumnTemplateString = '{view} {update} {delete}';
}
$actionColumnTemplateString = '<div class="action-buttons">' . $actionColumnTemplateString . '</div>';
?>
<div class="giiant-crud widget-page-index">


    <?php Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a']) ?>

    <h1>
        <?= Yii::t('widgets', 'Widget Pages') ?>
        <small>
            <?= Yii::t('widgets', 'List') ?>
        </small>
    </h1>
    <div class="clearfix crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('widgets', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <hr/>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => LinkPager::class,
                'firstPageLabel' => Yii::t('widgets', 'First'),
                'lastPageLabel' => Yii::t('widgets', 'Last'),
            ],
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'columns' => [
                [
                    'class' => ActionColumn::class,
                    'template' => $actionColumnTemplateString,
                    'buttons' => [
                        'view' => function ($url) {
                            $options = [
                                'title' => Yii::t('widgets', 'View'),
                                'aria-label' => Yii::t('widgets', 'View'),
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-file"></span>', $url, $options);
                        }
                    ],
                    'urlCreator' => function ($action, $model, $key) {
                        // using the column name as key, not mapping to 'id' like the standard generator
                        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string)$key];
                        $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                        return Url::toRoute($params);
                    },
                    'contentOptions' => ['nowrap' => 'nowrap']
                ],
                'view',
                'access_owner',
                'access_domain',
                'access_read',
                'access_update',
                'access_delete',
            ],
        ]); ?>
    </div>

</div>


<?php Pjax::end() ?>

