<?php

function printHeader($printer, $decodedJson)
{

    $printer->setReverseColors(true);
    $timestamp = $decodedJson->message->date;
    $timezone = "Europe/Madrid";
    $dt = new DateTime();
    $dt->setTimestamp($timestamp);
    $dt->setTimezone(new DateTimeZone($timezone));
    $datetime = $dt->format('Y-m-d H:i:s');

    $printer->text($decodedJson->message->chat->first_name . ' - ' . $datetime);
    $printer->feed(2);
    $printer->setReverseColors(false);
}

function printFoot($printer)
{
    $printer->feed(2);
    $printer->cut();

    $printer->close();
}
