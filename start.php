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
require __DIR__ . '/utils.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;

use function PHPSTORM_META\map;

$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);

$inputJson = $argv[1];
$decodedJson = json_decode($inputJson);

printHeader($printer, $decodedJson);

$printer->text(wordwrap($decodedJson->message->text, 42, "\n", true));

printFoot($printer);
