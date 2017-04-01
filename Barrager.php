<?php

namespace xutl\barrager;

use Yii;
use yii\base\Widget;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Barrager
 * 弹幕
 *
 * @see https://github.com/yaseng/jquery.barrager.js
 */
class Barrager extends Widget
{
    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the options for the underlying barrager JS plugin.
     */
    public $clientOptions = [];

    public $serverUrl;

    /**
     * {@inheritDoc}
     * @see \yii\base\Object::init()
     */
    public function init()
    {
        parent::init();
        if (!isset ($this->options ['id'])) {
            $this->options ['id'] = $this->getId();
        }
        $this->clientOptions = array_merge(
            [
                'loopTime' => 3000,
                'cancelValue' => Yii::t('app', 'Cancel')
            ], $this->clientOptions);
    }

    /**
     * {@inheritDoc}
     * @see \yii\base\Widget::run()
     */
    public function run()
    {
        $view = $this->getView();
        BarragerAsset::register($view);
        $view->registerJs("jQuery.getJSON('{$this->serverUrl}',function(items) {
            var barrager_index = 0;
            var barrager_looper = setInterval(function(){
                jQuery('body').barrager(items[index]);
                barrager_index++;
                if(barrager_index == items.length){
                    clearInterval(barrager_looper);
                    return false;
                }
            },{$this->clientOptions['loopTime']});   
            
});");
    }
}
