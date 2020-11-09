<?php


namespace YiTool\Http;


use SoapClient;
use SoapFault;

class WebService
{
    /**
     * @param string $functionName
     * @param array $data
     * @param null $wsdl
     * @return mixed
     * @throws SoapFault
     */
    public static function soap($functionName, $data, $wsdl = null)
    {
        $soapClient = new SoapClient($wsdl, [
            'location' => 'url',
            'uri' => 'uri',
        ]);
        return $soapClient->__soapCall($functionName, $data);
    }
}