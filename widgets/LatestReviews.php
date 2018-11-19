<?php

namespace pantera\reviews\widgets;

use pantera\reviews\models\ReviewSearch;
use yii\base\Widget;
use yii\db\ActiveRecord;

class LatestReviews extends Widget
{
    /** @var ActiveRecord */
    public $model;

    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());
        $dataProvider->pagination = false;
        $dataProvider->query->andWhere([
            'model_class' => $this->model::className(),
            'model_id' => $this->model->getPrimaryKey(),
        ]);
        $dataProvider->query->limit(2);
        return $this->render('latest-reviews-list', [
            'dataProvider' => $dataProvider,
            'entityMdel' => $this->model,
        ]);
    }
}