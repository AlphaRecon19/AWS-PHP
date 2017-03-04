<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace AWS;

use Aws\S3\Exception\S3Exception;

class Bucket extends Base
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function create()
    {
        $client = $this->getClient();
        try {
            $result = $client->createBucket([
                "Bucket" => $this->getName()
            ]);
        } catch (S3Exception $e) {
            return false;
        }

        return true;
    }

    public function destroy()
    {
        $this->emptyBucket();

        $client = $this->getClient();
        try {
            $result = $client->deleteBucket([
                'Bucket' => $this->getName(),
            ]);
        } catch (S3Exception $e) {
            dump($e->getMessage());
            return false;
        }

        return true;
    }

    protected function emptyBucket()
    {
        $client = $this->getClient();
        $objects = $client->getIterator('ListObjects', ['Bucket' => $this->getName()]);
        foreach ($objects as $object) {
            $result = $client->deleteObject(array(
                'Bucket' => $this->getName(),
                'Key' => $object['Key']
            ));
        }

        return true;
    }

    public function fetchAll()
    {
        $client = $this->getClient();
        $buckets = $client->listBuckets()->toArray();

        return $buckets["Buckets"];
    }
}