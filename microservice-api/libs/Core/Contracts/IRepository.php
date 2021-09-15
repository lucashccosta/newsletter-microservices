<?php

namespace Libs\Core\Contracts;

interface IRepository
{
    /**
     * Get entity class name
     * @return string
     */
    public function entity(): string;

    /**
     * Get all results
     */
    public function all();

    /**
     * Create new entry
     *
     * @param any $data
     */
    public function create($data);
}
