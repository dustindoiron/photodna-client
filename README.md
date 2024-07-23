# photodna-client

A basic Match and Report API client for Microsoft's PhotoDNA service. You should have a valid PhotoDNA Moderation account and an NCMEC contact prior to using this client.

Usage:
Create a client...
```php
$configuration = new PhotoDNA\Configuration(
    apiKey: 'apiKey',
    endpoint: 'https://api.microsoftmoderator.com/photodna/v1.0/', // default
    ncmecUsername: 'ncmecUsername',
    ncmecPassword: 'ncmecPassword'
);
$client = new PhotoDNA\Client($configuration);
```

Create a resource...
```php
$imageFile = new PhotoDNA\ImageFile('/path/to/location);
$imageUrl = new PhotoDNA\ImageLocation('https://url.com/file.png');

$result = $client->match($imageFile);
// or
$result = $client->match($imageLocation);
// enhanced matching
$result = $client->match($imageFile, true);
```

Report a resource...
```php
// Fluently set
$violation = new PhotoDNA\Violation()
    ->IncidentTime('9/10/2014 9:08:14 PM');
    ->ViolationContentCollection([
        'Name' => $imageFile->getFilename(),
        'Value' => $imageFile->getBase64(),
        'UploadIpAddress' => '127.0.0.1',
        // etc
    ]);
$reporter = new PhotoDNA\Reporter()
    ->OrgName('ExampleOrgName');
    ->ReporterName('Example Reporter')
    ->ReporterEmail('test@example.com');

$reportee = new PhotoDNA\Reportee()
    ->ReporteeName('Reportee Name')
    ->ReporteeIPAddress('127.0.0.1');

$response = $client->report($reportee, $reporter, $violation, isTest: true);
```