<?php


namespace Alirmohammadi\SmsPanel;


use Alirmohammadi\SmsPanel\models\GetBasePrice;
use Alirmohammadi\SmsPanel\models\GetCredit;
use Alirmohammadi\SmsPanel\models\GetDeliveries;
use Alirmohammadi\SmsPanel\models\GetMessages;
use Alirmohammadi\SmsPanel\models\GetUserNumbers;
use Alirmohammadi\SmsPanel\models\SendSMS;

class SmsPanel
{

    public static function CheckConfig ()
    {
        if (empty(config("smspanel")))
        {
            throw new \Exception("config file for smspanel not found use 'php artisan vendor:publish' to create config file");

        }
        if (empty(config("smspanel.username")) or empty(config("smspanel.password")) or empty(config("smspanel.from")) or empty(config("smspanel.endpoint")))
        {
            throw new \Exception("wrong config for smspanel");
        }
    }

    public static function SensSMS (string $text, array $to ,bool $flash=FALSE)
    {
        self::CheckConfig();

        $ins=new SendSMS($text,$to,$flash);

        return $ins->runner();
    }

    public static function GetDeliveries (int $recID)
    {
        self::CheckConfig();

        $ins=new GetDeliveries($recID);

        return $ins->runner();
    }

    public static function GetMessages (int $location = 2, int $index = 0, int $count = 100)
    {
        self::CheckConfig();

        $ins=new GetMessages($location,$index,$count);

        return $ins->runner();
    }

    public static function GetCredit ()
    {
        self::CheckConfig();

        $ins=new GetCredit();

        return $ins->runner();
    }

    public static function GetBasePrice ()
    {
        self::CheckConfig();

        $ins=new GetBasePrice();

        return $ins->runner();
    }

    public static function GetUserNumbers ()
    {
        self::CheckConfig();

        $ins=new GetUserNumbers();

        return $ins->runner();
    }
}
