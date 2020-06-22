<?php


namespace Alirmohammadi\SmsPanel\models;


use Illuminate\Support\Facades\Http;

class GetCredit
{

    const ROUTE = "GetCredit";

    protected string $username;
    protected string $password;
    protected string $endpoint;

    public function __construct ()
    {
        $this -> username = config('smspanel.username');
        $this -> password = config('smspanel.password');
        $this -> endpoint = config('smspanel.endpoint') . self::ROUTE;
    }

    public function runner ()
    {
        $res = Http ::post($this -> endpoint, [
            "username" => $this -> username,
            "password" => $this -> password,
        ]) -> json();


        if ($res["RetStatus"]==1 and $res["StrRetStatus"]=="Ok")
        {
            return $res["Value"];
        }
        else
        {
            throw new \Exception("unknown error ".json_encode($res));
        }
    }
}
