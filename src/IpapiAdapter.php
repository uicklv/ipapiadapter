<?php


namespace App\Lib;


class IpapiAdapter implements AdapterInterface
{
    protected $data;
    public function parse(string $ip)
    {

        $result = file_get_contents('http://ip-api.com/json/' . $ip);
        $this->data = json_decode($result, true);

        if ($this->data['status'] == 'fail') {
            $result = file_get_contents('http://ip-api.com/json/' . env('DEFAULT_IP_ADDR'));
            $this->data = json_decode($result, true);
        }
    }

    public function getCountryCode()
    {
        return $this->data['countryCode'];

    }

    public function getCityName()
    {
       return $this->data['city'];
    }
}
