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
$imageFile = new PhotoDNA\Resource\ImageFile('/path/to/location');
$imageUrl = new PhotoDNA\Resource\ImageLocation('https://url.com/file.png');

$result = $client->match($imageFile);
// or
$result = $client->match($imageLocation);
// enhanced matching
$result = $client->match($imageFile, true);
```

Report a resource...
```php
// Fluently set

$violation = new PhotoDNA\Resource\Violation()
    ->set('IncidentTime', '9/10/2014 9:08:14 PM');
    ->set('ViolationContentCollection', [
        'Name' => $imageFile->getFilename(),
        'Value' => $imageFile->getBase64(),
        'UploadIpAddress' => '127.0.0.1',
        // etc
    ]);
$reporter = new PhotoDNA\Resource\Reporter()
    ->set('OrgName', 'ExampleOrgName');
    ->set('ReporterName', 'Example Reporter')
    ->set('ReporterEmail', 'test@example.com');

$reportee = new PhotoDNA\Resource\Reportee()
    ->set('ReporteeName', 'Reportee Name')
    ->set('ReporteeIPAddress', '127.0.0.1');

$response = $client->report($reportee, $reporter, $violation, isTest: true);
```
