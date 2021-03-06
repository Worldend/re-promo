<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories_text".
 *
 * @property integer $id
 * @property integer $categories_id
 * @property integer $languages_id
 * @property string $name
 * @property string $url
 * @property string $seo_title
 * @property string $seo_desc
 * @property string $seo_keywords
 *
 * @property Categories $categories
 * @property Languages $languages
 */
class CategoryText extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories_text';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categories_id', 'languages_id', 'name', 'url'], 'required'],
            [['categories_id', 'languages_id'], 'integer'],
            [['name', 'url', 'seo_title', 'seo_desc', 'seo_keywords'], 'string', 'max' => 255],
            [['categories_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categories_id' => 'id']],
            [['languages_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['languages_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categories_id' => 'Categories ID',
            'languages_id' => 'Languages ID',
            'name' => 'Name',
            'url' => 'Url',
            'seo_title' => 'Seo Title',
            'seo_desc' => 'Seo Desc',
            'seo_keywords' => 'Seo Keywords',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Category::className(), ['id' => 'categories_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasOne(Language::className(), ['id' => 'languages_id']);
    }
}
