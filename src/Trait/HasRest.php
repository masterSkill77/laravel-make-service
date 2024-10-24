<?php

namespace Masterskill\ServicePackage\Trait;

use Exception;

trait HasRest
{
    public function store(array $data)
    {
        try {
            $entry = new ($this->model)($data);
            $entry->save();
            return $entry;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function get(mixed $value, string $column = 'id')
    {
        return ($this->model)::where($column, $value)->first();
    }
}
