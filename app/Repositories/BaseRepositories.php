<?php

namespace App\Repositories;


abstract class BaseRepositories
{
    abstract public function create(array $attributes);
    abstract public function update($model, array $attributes);
    abstract public function delete($model);
}