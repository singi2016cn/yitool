<?php

require 'vendor/autoload.php';

$helloYiTool = YiTool\HelloYiTool::hello();
var_dump($helloYiTool);

var_dump(\YiTool\Faker\ZhCn\Person::fullName());//石恨
var_dump(\YiTool\Faker\ZhCn\Person::fullName(2, 1));//司马暮
var_dump(\YiTool\Faker\ZhCn\Person::fullName(2, 2));//令狐凌敝

var_dump(\YiTool\Faker\ZhCn\Person::address());//湖北省武汉市江夏区定袄街889号

var_dump(\YiTool\Faker\ZhCn\Person::telephoneNumber());//373-8701801
var_dump(\YiTool\Faker\ZhCn\Person::mobileNumber());//11119276586