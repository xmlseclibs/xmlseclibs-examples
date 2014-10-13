<?php

require 'vendor/autoload.php';

$ReferenceNodeName = 'ExtensionContent';
$privateKey = file_get_contents('files/certs/zf2.pem');

$domDocument = new \DOMDocument();
$objSign = new \FR3D\XmlDSig\Adapter\XmlseclibsAdapter();

$domDocument->load('files/prueba.xml');
$objSign->setDigestAlgorithm();
$objSign->setPrivateKey($privateKey);
$objSign->setPublicKey($privateKey);
$objSign->addTransform(\FR3D\XmlDSig\Adapter\XmlseclibsAdapter::ENVELOPED);
$objSign->setCanonicalMethod();

$objSign->sign($domDocument, $domDocument->getElementsByTagName($ReferenceNodeName)->item(1));

print_r(str_replace('&#13;', '', $domDocument->saveXML()));