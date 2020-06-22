<?php


namespace Alirmohammadi\SmsPanel\models;


use Illuminate\Support\Facades\Http;

class GetDeliveries
{
    const ROUTE = "GetDeliveries2";

    protected string $username;
    protected string $password;
    protected string $endpoint;
    protected int $recID;

    /**
     * SendSMS constructor.
     *
     * @param int   $resID
     */
    public function __construct (int $recID)
    {
        $this -> username = config('smspanel.username');
        $this -> password = config('smspanel.password');
        $this -> recID = $recID;
        $this -> endpoint = config('smspanel.endpoint') .self::ROUTE;
    }

    public function runner ()
    {
        $res = Http ::post($this -> endpoint, [
            "username" => $this -> username,
            "password" => $this -> password,
            "recID"    => $this -> recID,
        ]) -> json();


        if ($res[ "RetStatus" ] == 1 and $res[ "StrRetStatus" ] == "Ok")
        {
            return $res[ "Value" ];
        }
        else
        {
            throw new \Exception("unknown error " . json_encode($res));
        }
    }
}
