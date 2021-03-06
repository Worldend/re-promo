<?php
namespace common\models\scopes;

use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery {

    use \common\models\scopes\traits\I18n;

    const TEXT_RELATION = 'categoryText';
    const TEXT_RELATION_TABLE = 'categories_text';

    /**
     * Получить потомков
     */
    public function withChildrens(){
        return $this->with('childrens');
    }

    /**
     * Категория с текущим переводом
     */
//    public function withText($languages_id = null){
//
//        return $this->with(['categoriesText' => function($query) use ($languages_id){
//            $tableName = \common\models\CategoriesText::tableName();
//
//            if ($languages_id){
//                return $query->andWhere(["$tableName.languages_id" => $languages_id]);
//            }
//        }]);
//    }

    /**
     * Категория без родителей
     */
    public function orphan(){

        return $this->andWhere(['parent_id' => NULL]);
    }

    public function searchUrlByLanguage($categoryUrl){
        return
            $this->joinWith(['categoriesText' => function(\yii\db\ActiveQuery $query){
                $query->andWhere(['categories_text.languages_id' => \Yii::$app->location->language->id]);
            }])
            ->andWhere(['categories_text.url' => $categoryUrl]);
    }

    public function withIcon(){
        return $this->with('icon');
    }

}