<?php

/**
 * This is a demo script for the functions of the PHP ESC/POS print driver,
 * Escpos.php.
 *
 * Most printers implement only a subset of the functionality of the driver, so
 * will not render this output correctly in all cases.
 *
 * @author Michael Billington <michael.billington@gmail.com>
 */
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;

$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);

$inputJson = $argv[1];

$decodedJson = json_decode($inputJson);

printHeader($printer, $decodedJson);

$printer->text(wordwrap($decodedJson->message->text, 42, "\n", true));

$printer->feed(2);
$printer->cut();

$printer->close();

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
