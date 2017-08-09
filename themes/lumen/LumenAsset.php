<?php
namespace app\themes\lumen;
use yii\web\AssetBundle;

class LumenAsset extends AssetBundle{
    public $sourcePath = '@app/themes/lumen/assets';
    
    public $css = [
        'lumen.css',
        'style.css',
        'font-awesome.css',
        'responsive.css',
    ];
    
    public $js = ['bootbox.min.js', 'main.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    public function init() {
        parent::init();
    }
    
}

