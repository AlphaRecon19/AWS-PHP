<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */

namespace AWS;

abstract class Base
{
    protected $app;

    public function __construct(AWS $aws)
    {
        $this->app = $aws;
    }

    public function getClient()
    {
        return $this->app->getClient();
    }
}