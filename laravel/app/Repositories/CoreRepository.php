<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new ($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startConditions()
    {
        return clone $this->model; //работаем с моделью не напрямую, а клонируем её
    }
}
