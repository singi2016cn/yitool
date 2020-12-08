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

//RSA
$rsaPk = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuAyFwwiuYn06wkEzjxzU
jJ11VsIpRlEafAMUSCEJmX/O+pot803MF+mrGBOBu5zW9M+4gfnWfm6vYDRh6ob/
MpooslkoCJHWKYGFoAfuf4F2nyCMWLf7juesR6fWiIb5JCEYuPc2JnKgieXt1PN6
9YNTaOFwfE5E7MuHRhugS0stbzhTQtWcTiotSPYFhPgFcOMnQq5pYvVTNYMIW6P3
cNu1w2liOBBzuINLnTF8rSSTPJP1MCKnIGDZH5XANRKlPtUemsnvTTkuR/rYoobm
M4OahBLyGfDqVnHLm2k/BcjNJ0TzO1gssh6O+1TBJ71tpP/i8f41ku1tzIHYN+/H
WwIDAQAB
-----END PUBLIC KEY-----
';
$rsaSk = '-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQC4DIXDCK5ifTrC
QTOPHNSMnXVWwilGURp8AxRIIQmZf876mi3zTcwX6asYE4G7nNb0z7iB+dZ+bq9g
NGHqhv8ymiiyWSgIkdYpgYWgB+5/gXafIIxYt/uO56xHp9aIhvkkIRi49zYmcqCJ
5e3U83r1g1No4XB8TkTsy4dGG6BLSy1vOFNC1ZxOKi1I9gWE+AVw4ydCrmli9VM1
gwhbo/dw27XDaWI4EHO4g0udMXytJJM8k/UwIqcgYNkflcA1EqU+1R6aye9NOS5H
+tiihuYzg5qEEvIZ8OpWccubaT8FyM0nRPM7WCyyHo77VMEnvW2k/+Lx/jWS7W3M
gdg378dbAgMBAAECggEAAdbmM1fP3l4gCzb5m/GO0kT0mkRggzpmSF0Dg+EIpocX
e3u0/9yEMKz+L8RqJIThxRqaXnovwZ27lPuRCvYEcO4HgBjSBJvohwurWTkbEh0q
IVcC8BQOqJP6LdEonL60mL7X72lRGjtFDXvFz74LOY7xc3flVui1WaSDGplGFdqL
Jn+sNBOjUWu9yKMUULNskcIIgJn5D/YTfHQFI10qRJt8a/D/aHL7QWd0UqCt4fRX
Qbc6ckJ5RrQiPiDrTuk6sOkkLm2D9rs+2M06/HsKglY7QYedVSVWKaUXIo2nYmBF
OeMoResc7FZyK9eSF74gMi+vj8pZgMYACJuspO9f0QKBgQDkcvfmqa5PM2pnnWwo
Jne1hApLElV0J6ZdiC9bEsJdVXIgthuvQFU4nhDB69Ejj/8XIl8fV/eeY3Hckwdd
8VSQzVoouay57eaH6w0Fk9XjRILzcvpi0GDLkUChrrTBwywJryOoS5nuB1WZVCTw
kVz2JrnvaZdv0xd8BkT6YI8L2QKBgQDOPsN4z+7dsTL9aYpGMzhKxesguoTdBn2v
gocJX25yuKBJ1/xEk4YxLn5eqx9E7vCjjhihrAjSV4u79TzrH/dMR1XLcjvuiKuJ
CBYp783wBo3npg5zoaGWX92cMGcgnpg6nRwmKv/3v779W3b5HL2CtKVqKXZKljXG
i1XIG2BwUwKBgGfBQ5ASfqVf/7Khj87IcdQR7S7dW8xOecO/J2rgoUAMn7H1o6s7
t7joKUo51Rmmu7+BD9zHciIQnlUEvfLPuY2uhoU6lxU21F3kxlxDIYB/zE3PaaLZ
ayzpgoYsN9JM10JqtfIoq/esgxcJXWGZU7REMGxo86uJHwBoRInGsxE5AoGASKbX
WMF2lWWMXrRE30G/vKdHknnhv7I/qAnE48pYL9VVsW2CEe4dwUltfo+tLi01W4f8
qUbevKnWMVnMIc9a3+XpFQeikP5X3qeYlyFAXCMS7d0TDiyLrVsLx69NRLJZUZxy
hAd1r6I99yW3HT3AjEByXJlKcC/FtbDzgNAUAr0CgYA4it4//V5GN0WyI3zWdEH9
OpXrzUpCifWImJeO9qqu1eI1QVIqcj8vexoiLVG+gQa189DTjbOb3pc7QTAFuzR/
YyE5s+G1RDarm28AlMAcVm8YrKWm3Urdqatp8Gu36EptBtjRWlgBC/uacDw/P2eY
ukpHYS5bv2eRpaSuLamXBQ==
-----END PRIVATE KEY-----
';
var_dump(\YiTool\Crypto\Rsa::encrypt('{"name":"yitool"}', $rsaPk));//DBhXAAMCc0L1JEqer87g2dO2wjMGEsvMI1aHnxSEGWMzfsjmAh99wVNn11F+YB7VPpPznE9FcxDKzaOA4snOVfgsS9Hl1wPmJDm/QHmBUoSJU3em2t3LziNc8PhMqLZdNqUmUxiFTLbXUW0xcmNVbkMwSR/RUCUnKvdTe4TSkgF4VNLGNsrbArseDIoTMwBvdl0ViJ0NAQ60ous58UD0zSo08afy3YpYcN06HaU+9BxeAsHKQhfmivwktmmTY2hASwqGUa8TgBARki0d9ydTZZokVZcCi81biJqi8ArKGK3sps6G7lozctjN2At1PHozabLPiRQzu5So1RYVJ6vDDQ==

var_dump(\YiTool\Crypto\Rsa::decrypt('DBhXAAMCc0L1JEqer87g2dO2wjMGEsvMI1aHnxSEGWMzfsjmAh99wVNn11F+YB7VPpPznE9FcxDKzaOA4snOVfgsS9Hl1wPmJDm/QHmBUoSJU3em2t3LziNc8PhMqLZdNqUmUxiFTLbXUW0xcmNVbkMwSR/RUCUnKvdTe4TSkgF4VNLGNsrbArseDIoTMwBvdl0ViJ0NAQ60ous58UD0zSo08afy3YpYcN06HaU+9BxeAsHKQhfmivwktmmTY2hASwqGUa8TgBARki0d9ydTZZokVZcCi81biJqi8ArKGK3sps6G7lozctjN2At1PHozabLPiRQzu5So1RYVJ6vDDQ==', $rsaSk));//{"name":"yitool"}
var_dump(\YiTool\Crypto\Rsa::sign('{"name":"yitool"}', $rsaSk));//P9ItjurOqz4uTobeWBPYT9Q8joc6AdNnhMyv/gAFu/u8fw7B2KSbO9fyZ1JKQdQfyW79eI1eqPVklalRuGbu202m0G9+oHmHiJ8szOtBHmd40rpdBLI2wrvcNhBRIJNbgB5MINTBHWZff1Fef56zZz01EhMZ5qnffCJojXzaKlXMYL6m6t0XwfOSYjvgBw9l3P31EGNv5+wSL7IQKRe+Wo86RgZ6n0wL7Rmcxd3h0ROMIlne07FxCF140DZyHceejUyRzMZlCeVesKf5VmqIaolEhE/KJca5Kt4KedaRyj5sZEnbo1WRtpD+mjOwKI32Z9sT7tDs9osgzxmXZKTH6w==

var_dump(\YiTool\Crypto\Rsa::checkSign('{"name":"yitool"}', 'P9ItjurOqz4uTobeWBPYT9Q8joc6AdNnhMyv/gAFu/u8fw7B2KSbO9fyZ1JKQdQfyW79eI1eqPVklalRuGbu202m0G9+oHmHiJ8szOtBHmd40rpdBLI2wrvcNhBRIJNbgB5MINTBHWZff1Fef56zZz01EhMZ5qnffCJojXzaKlXMYL6m6t0XwfOSYjvgBw9l3P31EGNv5+wSL7IQKRe+Wo86RgZ6n0wL7Rmcxd3h0ROMIlne07FxCF140DZyHceejUyRzMZlCeVesKf5VmqIaolEhE/KJca5Kt4KedaRyj5sZEnbo1WRtpD+mjOwKI32Z9sT7tDs9osgzxmXZKTH6w==', $rsaPk));//true


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