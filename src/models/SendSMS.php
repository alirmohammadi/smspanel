<?php


namespace Alirmohammadi\SmsPanel\models;

use Illuminate\Support\Facades\Http;

class SendSMS
{

    const ROUTE = "SendSMS";

    protected string $to;
    protected string $username;
    protected string $password;
    protected string $from;
    protected string $text;
    protected string $endpoint;
    protected bool $flash;

    /**
     * SendSMS constructor.
     *
     * @param string $to
     * @param string $text
     * @param bool   $flash
     */
    public function __construct (string $text,array $to, bool $flash)
    {
        $this -> to = implode(",", $to);
        $this -> text = $text;
        $this -> flash = $flash;
        $this -> username = config('smspanel.username');
        $this -> password = config('smspanel.password');
        $this -> from = config('smspanel.from');
        $this -> endpoint = config('smspanel.endpoint') .self::ROUTE;
    }

    public function runner ()
    {
        $res = Http ::post($this -> endpoint, [
            "username" => $this -> username,
            "password" => $this -> password,
            "to"       => $this -> to,
            "from"     => $this -> from,
            "text"     => $this -> text,
            "flash"     => $this -> flash,
        ])->json();

        if ($res[ "Value" ] < 8 and $res[ "Value" ] > 0)
        {
            throw new \Exception("send failed with error code: " . $res[ "Value" ]);
        }
        if ($res[ "Value" ] == 11)
        {
            throw new \Exception("sms sending failed error 11");
        }
        if ($res[ "RetStatus" ] == 1 and $res[ "StrRetStatus" ] == "OK")
        {
            return $res[ "Value" ];
        }
        else
        {
            throw new \Exception("unknown error " . json_encode($res));
        }


    }


}
