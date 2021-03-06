<?php
namespace backend\widgets;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper as AH;
use yii\base\Widget;

class Form extends Widget {

    public $rows = [];

    public $saveUrl = '';

    const INPUT_TEXT = 'textInput';

    CONST INPUT_TEXT_ACTIVE = 'textActiveInput';

    const INPUT_CHECKBOX_INACTIVE = 'inputCheckboxInactive';

    const MULTISELECT = 'multiselect';
    
    const IMG = 'img';

    public function getViewPath()
    {
        return \Yii::getAlias('@app/widgets/views/form');
    }

    public function init()
    {
        parent::init();
    }

    public function run(){
        $rows = $this->rows;
        $saveUrl = $this->saveUrl;

        foreach ($rows as &$item){

            $this->setPanelContent($item);
        }

        return $this->render('base',compact('rows','saveUrl'));
    }

    protected function setPanelContent(&$row){
        $panelForm = '';
        $row['panel-content'] = [];

        foreach ($row['attributes'] as $attribute) {

            $inputType = $attribute['type'];

            $panelForm .= $this->$inputType($attribute);
        }

        $row['panel-content'] = $panelForm;
    }

    protected function textInput($attribute){

        return $this->render('text-input', compact('attribute'));
    }

    protected function inputCheckboxInactive($attribute){

        return $this->render('input-checkbox-inactive', compact('attribute'));
    }

    protected function img($attribute){
        return $this->render('img', compact('attribute'));
    }

    protected function multiselect($attribute){
        $selectpicker = $attribute['selectpicker'];
        $values     = $selectpicker['values'];
        $selected   = $selectpicker['selected'];
        $options    = AH::getValue($selectpicker,'options',[]);
        $model      = $attribute['model'];
        $label      = $attribute['label'];
        $name       = $attribute['name'];

        return $this->render('multi-select',compact(
                'model',
                'values',
                'selected',
                'options',
                'label',
                'name'
        ));
    }
}