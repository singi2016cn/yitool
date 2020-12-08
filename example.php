<?php

require 'vendor/autoload.php';

var_dump(YiTool\HelloYiTool::hello());//hello YiTool

/*
 * 加解密
 * */

//AES
var_dump(\YiTool\Crypto\Aes::encrypt('{"name":"yitool"}', '123456'));//FAh0TtknsGD8G7W2j0rtfYe5q2lxsaXxT2D3r6ZuJBUomLH5lbQqnKwHIUQhXA7emddhFbuTI800pa5Nffh3MabJGkXX/FYUrM6TaYLDrgQ=
var_dump(\YiTool\Crypto\Aes::decrypt('FAh0TtknsGD8G7W2j0rtfYe5q2lxsaXxT2D3r6ZuJBUomLH5lbQqnKwHIUQhXA7emddhFbuTI800pa5Nffh3MabJGkXX/FYUrM6TaYLDrgQ=', '123456'));//{"name":"yitool"}

//DES
var_dump(\YiTool\Crypto\Des::encrypt('{"name":"yitool"}', '123456'));//MkNIcVlha3hnTTBOMUpFUDVoVm5QMkFITzJtcTI3K3E=
var_dump(\YiTool\Crypto\Des::decrypt('MkNIcVlha3hnTTBOMUpFUDVoVm5QMkFITzJtcTI3K3E=', '123456'));//{"name":"yitool"}

//RC4
var_dump(\YiTool\Crypto\RC4::encrypt('{"name":"yitool"}', '123456'));//e9oQBklWN6ZdTkvCllEt7JA=

//RSA see tests/Crypto/RsaTest.php


/*
 * curl 操作
 * */
//\YiTool\Http\Curl::get();
//\YiTool\Http\Curl::post();
//\YiTool\Http\Curl::postApplicationJson();
//\YiTool\Http\Curl::postApplicationXWwwFormUrlencoded();
//\YiTool\Http\Curl::postFile();
//\YiTool\Http\Curl::postFiles();


/*
 * IO操作
 * */
var_dump(\YiTool\IO\File::getLocalFile());//C:\Users\yi.qin\AppData\Local\Temp\preCF80.tmp
//var_dump(\YiTool\IO\File::getLocalFileFromUrl('oss_path'));//C:\Users\yi.qin\AppData\Local\Temp\preCF80.tmp
var_dump(\YiTool\IO\File::getFileMimeTypeFormFileName('C:\Users\yi.qin\Pictures\Saved Pictures\db.jpg'));//image/jpeg

/*
 * [
 *  'type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
 *  'size' => 10577,
 *  'temp_name' => 'C:\\Users\\yi.qin\\AppData\\Local\\Temp\\pre6C3B.tmp',
 *  'error' => 0
 * ]
 * */
var_dump(\YiTool\IO\File::getFormFileFromUrl('oss_path/aaa.xlsx'));


/*
 * 生成随机数据
 * */
var_dump(\YiTool\Faker\ZhCn\Person::fullName());//石恨
var_dump(\YiTool\Faker\ZhCn\Person::fullName(2, 1));//司马暮
var_dump(\YiTool\Faker\ZhCn\Person::fullName(2, 2));//令狐凌敝

var_dump(\YiTool\Faker\ZhCn\Person::address());//湖北省武汉市江夏区定袄街889号

var_dump(\YiTool\Faker\ZhCn\Person::telephoneNumber());//373-8701801
var_dump(\YiTool\Faker\ZhCn\Person::mobileNumber());//11119276586

// want more examples, see tests/