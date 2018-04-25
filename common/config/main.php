<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //url美化
        'urlManager'=>[
            'enablePrettyUrl' => true, //对url进行美化
            'showScriptName' => false,//隐藏index.php   （不知道必要不，但是不添加.htaccess文件的话是不会成功的）
            //'suffix' => '.html',//网页后缀
            // 'enableStrictParsing'=>FALSE,//不要求网址严格匹配，则不需要输入rules
            // 'rules' => []//网址匹配规则
        ],
        //语言包的配置
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    // 'basePath' => '/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
            ],
        ],
    ],
];
