<?php


namespace Alirmohammadi\SmsPanel\models;


use Illuminate\Support\Facades\Http;

class GetUserNumbers
{
    const ROUTE = "GetUserNumbers";

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
            "UserName" => $this -> username,
            "PassWord" => $this -> password,
        ]) -> json();


        if ($res["MyBase"]["RetStatus"]==1 and $res["MyBase"]["StrRetStatus"]=="Ok" and $res["MyBase"]["Value"]=="Ok")
        {
            return $res["Data"];
        }
        else
        {
            throw new \Exception("unknown error ".json_encode($res));
        }
    }
}
