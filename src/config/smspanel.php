<?php
return [


    "username"=>env("SMS_PANEL_USERNAME"),

    "password"=>env("SMS_PANEL_PASSWORD"),

    "from"=>env("SMS_PANEL_FROM"),

    "endpoint"=>env("SMS_PANEL_ENDPOINT","https://rest.payamak-panel.com/api/SendSMS/"),


];
