<?php

namespace PhotoDNA;

use PhotoDNA\Transport\Response;
use PhotoDNA\Transport\Request;
use PhotoDNA\Resource\ImageFile;
use PhotoDNA\Resource\ImageLocation;
use PhotoDNA\Resource\Reportee;
use PhotoDNA\Resource\Reporter;
use PhotoDNA\Resource\Violation;

class Client
{
    protected Configuration $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->setConfiguration($configuration);
    }

    public function setConfiguration(Configuration $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    public function getRequestFactory(): Request
    {
        return new Request($this->getConfiguration());
    }

    public function match(ImageFile|ImageLocation $image, bool $enhance = false): Response
    {
        $query = $enhance ? '?enhance' : '';
        $request = $this->getRequestFactory()
            ->setMethod('Match' . $query);

        if ($image instanceof ImageFile) {
            $request->setFile($image->getFile());
        }
        if ($image instanceOf ImageLocation) {
            $request->setParameters($image->getResourceParameters());
        }

        $response = $request->execute();

        if ($image instanceof ImageFile) {
            $image->closeFile();
        }

        return $response;
    }

    public function report(Reportee $reportee, Reporter $reporter, Violation $violation, bool $isTest = false): Response
    {
        $metadata = [
            'AdditionalMetadata' => [
                'isTest' => $isTest
            ]
        ];

        return $this->getRequestFactory()
            ->setMethod('Report')
            ->setParameters(array_merge(
                    $reportee->getResourceParameters(),
                    $reporter->getResourceParameters(),
                    ['ViolationContentCollection' => $violation->getResourceParameters()],
                    $metadata
                ))
            ->execute();
    }
}
