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
                                  'brandUrl' => Url::to(['site/indexdepart']),
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
                                          'label'=>'  ข้อมูลเครื่องแสกน', 
                                          'url'=>['scanlocation/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-map-marker'],
                                    ],
                                    [
                                          'label'=>'  ข้อมูลแสกนรายบุคคล', 
                                          'url'=>['chkinout/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-eye'],
                                    ],

                                    [
                                          'label'=>'  บันทึกการลา', 
                                          'url'=>['leave/index'],
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
                                                'label' => '  จัดการ - ประเภทการลา', 'url' => ['leavetype/index'],
                                                'linkOptions'=>['class'=>'fa fa-bullhorn']

                                            ],
                                            [
                                                'label' => '  จัดการ - วันหยุดนักขัตฤกษ์', 'url' => ['holiday/index'],
                                                'linkOptions'=>['class'=>'fa fa-calendar']

                                            ],
                                            [
                                                  'label'=>' จัดการ - รายชื่อผู้แสกน', 
                                                  'url'=>['userinfo/index'],
                                                  //'options'=> ['class'=>'list-group-item'],
                                                  'linkOptions'=>['class'=>'fa fa-user'],
                                            ],
                                            [
                                                  'label'=>' จัดการ - หน่วยงาน', 
                                                  'url'=>['department/index'],
                                                  //'options'=> ['class'=>'list-group-item'],
                                                  'linkOptions'=>['class'=>'fa fa-map-marker'],
                                            ],
                                        ],
                                        'linkOptions'=>['class'=>'fa fa-cog']
                                    ],
                                    [
                                        'label' => '   
                                        '.Yii::$app->session["fname"] . ' ' . Yii::$app->session["lname"].' | '.Yii::$app->session["member_name"],

                                        'items' => [
                                             [
                                              'label' => 'ออกจากระบบ', 'url' => '@web/user/logout',
                                              'linkOptions'=>['class'=>'fa fa-sign-out'],
                                             ],
                                          
                                        ],
                                        'linkOptions'=>['class'=>'fa fa-user'],
                                        
                                  ],
                            ];
                        

                  }else {

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
                                          'url'=>['site/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-home'],
                                    ],
                                    [
                                          'label'=>'  ข้อมูลแสกนรายบุคคล', 
                                          'url'=>['chkinout/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-eye'],
                                    ],

                                    [
                                          'label'=>'  บันทึกการลา', 
                                          'url'=>['leave/index'],
                                          //'options'=> ['class'=>'list-group-item'],
                                          'linkOptions'=>['class'=>'fa fa-list-alt'],
                                    ],
                                    [
                                          'label'=>'  รายงาน', 
                                          'url'=>['chkinout/reportform'],
                                          'linkOptions'=>['class'=>'fa fa-file-code-o'],
                                    ],
                                   
                                    [
                                        'label' => '   
                                        '.Yii::$app->session["fname"] . ' ' . Yii::$app->session["lname"].' | '.Yii::$app->session["member_name"],
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
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        
        <div class="panel panel-default">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ออกแบบแล้วพัฒนาโดย ศูนย์คอมพิวเตอร์ โรงพยาบาลร้อยเอ็ด <?= date('Y') ?></p>

        <p class="pull-right">เวอร์ชัน 60.01.10</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
