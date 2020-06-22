<?php


namespace Alirmohammadi\SmsPanel\models;


use Illuminate\Support\Facades\Http;

class GetMessages
{

    const ROUTE = "GetMessages";

    protected int $location;
    protected string $username;
    protected string $password;
    protected string $from;
    protected string $index;
    protected string $endpoint;
    protected bool $count;


    public function __construct (int $location, int $index, int $count)
    {
        $this -> location = $location;
        $this -> index = $index;
        $this -> count = $count;
        $this -> username = config('smspanel.username');
        $this -> password = config('smspanel.password');
        $this -> from = config('smspanel.from');
        $this -> endpoint = config('smspanel.endpoint') . self::ROUTE;
    }

    public function runner ()
    {
        $res = Http ::post($this -> endpoint, [
            "username" => $this -> username,
            "password" => $this -> password,
            "location" => $this -> location,
            "from"     => $this -> from,
            "count"    => (int)$this -> count,
            "index"    => $this -> index,
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
