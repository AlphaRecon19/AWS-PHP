<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace AWS;

use Aws\S3\S3Client;

class AWS
{
    /**
     * @var S3Client
     */
    protected $client;

    public function __construct(S3Client $client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }
}