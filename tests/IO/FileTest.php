<?php


namespace YiTool\Tests\IO;


use PHPUnit\Framework\TestCase;
use YiTool\IO\File;

class FileTest extends TestCase
{

    const URL = 'https://hn-img-mall-1.oss-cn-shenzhen.aliyuncs.com/uploader/8c79387a2c4d61b577aa3ce90a034beb.jpg';
    const LOCAL_FILE = 'C:\Users\yi.qin\PhpstormProjects\yitool\tests\resource\a.jpg';
    const BASE64_LOCAL_FILE = 'C:\Users\yi.qin\PhpstormProjects\yitool\tests\resource\b.jpg';
    const BASE64_FILE = 'C:\Users\yi.qin\PhpstormProjects\yitool\tests\resource\base64.log';

    public function testGetLocalFile()
    {
        $res = File::getLocalFile();
        $this->assertNotEmpty($res);
    }

    public function testGetLocalFileFromUrl()
    {
        $res = File::getLocalFileFromUrl(self::URL);
        $this->assertNotEmpty($res);
        $this->assertStringContainsString('C:\Users\yi.qin\AppData\Local\Temp', $res);
    }

    public function testGetFormFileFromUrl()
    {
        $res = File::getFormFileFromUrl(self::URL);
        $this->assertNotEmpty($res);
        $this->assertIsArray($res);
    }

    public function testGetCurlFileFromUrl()
    {
        $res = File::getCurlFileFromUrl(self::URL);
        $this->assertNotEmpty($res);
        $this->assertInstanceOf(\CURLFile::class, $res);
        $this->assertClassHasAttribute('name', \CURLFile::class);
    }

    public function testGetFileMimeTypeFormFileName()
    {
        $res = File::getFileMimeTypeFormFileName(self::LOCAL_FILE);
        $this->assertEquals('image/jpeg', $res);
    }

    public function testFile2Base64()
    {
        $res = File::file2Base64(self::LOCAL_FILE);
        $this->assertStringContainsString('data:image/jpeg;base64,', $res);
    }

    public function testBase642File()
    {
        $res = File::base642File(file_get_contents(self::BASE64_FILE), self::BASE64_LOCAL_FILE);
        $this->assertEquals(self::BASE64_LOCAL_FILE, $res);
    }
}