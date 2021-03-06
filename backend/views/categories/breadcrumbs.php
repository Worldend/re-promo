<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$breadcrumbs = $category->getAllParentsForBreadcrumbs();

if (!empty($breadcrumbs)){

    $currentBreadcrumb = array_pop($breadcrumbs);

    foreach ($breadcrumbs as $categoryBreadcrumb){
        $this->params['breadcrumbs'][] = [
            'label' => $categoryBreadcrumb->techname,
            'url' => Url::toRoute(['index','id' => $categoryBreadcrumb->id])
        ];
    }

    $this->params['breadcrumbs'][] = $currentBreadcrumb->techname;
    $homeLink = ['label' => 'Категории', 'url' => '/categories'];
} else {
    $homeLink = 'Категории';
}

//.......
// Выводим цепочку навигации
echo Breadcrumbs::widget([
        'homeLink' => $homeLink,
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
    ]);