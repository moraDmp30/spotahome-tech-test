<?php

namespace Spotahome\Repositories\Property;

interface PropertyRepository
{
    /**
     * Gets properties.
     *
     * @param array $params
     *
     * @return array
     */
    public function getProperties($params) : array;
}
