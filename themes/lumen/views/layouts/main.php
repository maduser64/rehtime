<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
//use app\assets\AppAsset;
use app\themes\lumen\LumenAsset;

LumenAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web/icon/fa-desktop.png'); ?>"  >
    <?= Html::csrfMetaTags() ?>
    <title>ระบบรายงานข้อมูลการสแกนลายนิ้วมือ</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php 

        $brandLabel = "<i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> ระบบรายงานข้อมูลการสแกนลายนิ้วมือ";
    ?>
    <?php
                $session = Yii::$app->session;

              if (Yii::$app->session["Username"] != "" and Yii::$app->session["Password"] != "" and Yii::$app->session["level"] != "") {

                  if(Yii::$app->session["level"] == "5"){

                         NavBar::begin([
                                  'brandLabel' =>  $brandLabel,
                                  'brandUrl' => Url::to(['site/index']),
                                  'options' => [
                                      'class' => 'navbar navbar-inverse navbar-fixed-top',
                                  ]
                                ]);

                          $items = [
                   
                                    [
                                          'label'=>'  หน้าแรก', 
                                          'url'=>['site/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-home'],
                                    ],
                                    [
                                          'label'=>'  ข้อมูลเครื่องสแกน', 
                                          'url'=>['scanlocation/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-map-marker'],
                                    ],

                                    [
                                          'label'=>'  ข้อมูลสแกนรายบุคคล', 
                                          'url'=>['chkinout/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-eye'],
                                    ],

                                    [
                                          'label'=>'  บันทึกการลา', 
                                          'url'=>['scanleavereport/indexadmin'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-list-alt'],
                                    ],
                                    [
                                          'label'=>'  รายงาน', 
                                          'url'=>['chkinout/reportform'],
                                          'linkOptions'=>['class'=>'fa fa-file-code-o'],
                                    ],

                                    [
                                        'label' => '   ตั้งค่า',  
                                        'items' => [
                                            [
                                                'label' => '  การลา', 'url' => ['leavetype/index'],
                                                'linkOptions'=>['class'=>'fa fa-bullhorn']

                                            ],
                                            [
                                                'label' => '  วันหยุดนักขัตฤกษ์', 'url' => ['holiday/index'],
                                                'linkOptions'=>['class'=>'fa fa-calendar']

                                            ],
                                            [
                                                  'label'=>' รายชื่อผู้สแกน', 
                                                  'url'=>['userinfo/index'],
                                                  //'options'=> ['class'=>'list-group-item'],
                                                  'linkOptions'=>['class'=>'fa fa-user'],
                                            ],
                                            [
                                                  'label'=>' จัดการผู้ดูแลหน่วยงาน', 
                                                  'url'=>['scanservice/index'],
                                                  //'options'=> ['class'=>'list-group-item'],
                                                  'linkOptions'=>['class'=>'fa fa-users'],
                                            ],
                                            [
                                                  'label'=>'  หน่วยงาน', 
                                                  'url'=>['department/index'],
                                                  //'options'=> ['class'=>'list-group-item'],
                                                  'linkOptions'=>['class'=>'fa fa-map-marker'],
                                            ],
                                            [
                                                  'label'=>'  คู่มือการใช้งาน', 
                                                  'url'=>['doc/rehtime_admin.pdf','target' => '_blank'],
                                                  //'options'=> ['class'=>'list-group-item'],
                                                  'options' => [
									                    'target' => '_blank',
									               ],
                                                  'linkOptions'=>['class'=>'fa fa-book'],
                                            ],
                                        ],
                                        'linkOptions'=>['class'=>'fa fa-cog']
                                    ],
                                   
                                    [
                                        'label' => '   
                                        '.Yii::$app->session["member_name"],
                                        'items' => [
                                             [
                                              'label' => 'ออกจากระบบ', 'url' => '@web/user/logout',
                                              'linkOptions'=>['class'=>'fa fa-sign-out'],
                                             ],
                                            
                                        ],

                                        'linkOptions'=>['class'=>'fa fa-user'],
                                    ]
                          ];

                                  
                                
                  }else{
                      NavBar::begin([
                                  'brandLabel' =>  $brandLabel,
                                  'brandUrl' => Url::to(['site/indexdepart']),
                                  'options' => [
                                      'class' => 'navbar navbar-inverse navbar-fixed-top',
                                  ]
                                ]);

                          $items = [
                   
                                    [
                                          'label'=>'  หน้าแรก', 
                                          'url'=>['site/indexdepart'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-home'],
                                    ],
                                  
                                    [
                                          'label'=>'  ข้อมูลแสกนรายบุคคล', 
                                          'url'=>['chkinout/indexdepart'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-eye'],
                                    ],

                                    [
                                          'label'=>'  บันทึกการลา', 
                                          'url'=>['scanleavereport/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-list-alt'],
                                    ],
                                    [
                                          'label'=>'  รายงาน', 
                                          'url'=>['chkinout/reportformdepart'],
                                          'linkOptions'=>['class'=>'fa fa-file-code-o'],
                                    ],
                                    [
                                          'label'=>'  ตั้งค่าข้อมูลพื้นฐาน', 
                                          'url'=>['userinfo/updateuser'],
                                          'linkOptions'=>['class'=>'fa fa-users'],
                                    ],
                                  
                                   
                                    [
                                        'label' => '   
                                        '.Yii::$app->session["member_name"],
                                        'items' => [
                                             [
                                              'label' => 'ออกจากระบบ', 'url' => '@web/user/logout',
                                              'linkOptions'=>['class'=>'fa fa-sign-out'],
                                             ],
                                            
                                        ],

                                        'linkOptions'=>['class'=>'fa fa-user'],
                                    ]
                                ];
                  }
                

            }else{

                  NavBar::begin([
                    'brandLabel' =>  $brandLabel,
                    'brandUrl' => Url::to(['user/login']),
                    'options' => [
                        'class' => 'navbar navbar-inverse navbar-fixed-top',
                    ]
                    
                  ]);
                  $items = [
                      
                                    
                        ];
                  
          }
                

        echo Nav::widget([
            'options' => ['class' => 'navbar-red navbar-nav navbar-right'],
            'items' => $items,
        ]);

        NavBar::end();
    
   

    ?>
   
    <div class="container">


        <?php
            if(Yii::$app->session["level"] == "5"){
                echo Breadcrumbs::widget([
                  'homeLink' => [ 
                                  'label' => Yii::t('yii', 'หน้าแรก'),
                                  'url' => Url::to(['site/index']),
                             ],
                  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
               ]);
              }else{
                  echo Breadcrumbs::widget([
                    'homeLink' => [ 
                                    'label' => Yii::t('yii', 'หน้าแรก'),
                                    'url' => Url::to(['site/indexdepart']),
                               ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                 ]);
              }
        ?>
        
        
        <div class="panel panel-default">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ออกแบบแล้วพัฒนาโดย ศูนย์คอมพิวเตอร์ โรงพยาบาลร้อยเอ็ด <?= date('Y') ?></p>

        <p class="pull-right">เวอร์ชัน V1.1.4</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
