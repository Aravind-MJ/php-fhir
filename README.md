# php-fhir
Tools for creating FHIR classes in PHP for use by a client.

This library is a work in progress.

## Basic Usage

After installation via Composer, you will need to procure XSD's for your desired FHIR spec version
(https://www.hl7.org/fhir/downloads.html provides links to DSTU 1 XSD's, for example).

Once this directory is downloaded and un-zipped, a simple script to build classes from the above XSD's is as follows:

```php
<?php
require __DIR__.'/vendor/autoload.php';

$xsdPath = 'path to wherever you un-zipped the xsd's';

$generator = new \PHPFHIR\Generator($xsdPath);

$generator->generate();
```

The generated classes will be placed under ` php-fhir/output/ `.

## Testing

At the moment, due to how much change is happening within the lib, I am testing this lib against the DSTU 1 spec.
Future development will support all official DSTU releases of FHIR.

## Suggestions and help

If you have some suggestions for how this lib could be made more useful, more applicable, easier to use, etc, please
let me know.