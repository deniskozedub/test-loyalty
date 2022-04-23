<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @throws BindingResolutionException|BindingResolutionException|BindingResolutionException
     */
    public function __construct()
    {
        $this->model = app()->make($this->model());
    }

    abstract public function model(): string;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if (isset($this->query)) {
            return $this->query;
        }

        return $this->model->newQuery();
    }
}
