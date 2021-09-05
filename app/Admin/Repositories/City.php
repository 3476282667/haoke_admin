<?php

namespace App\Admin\Repositories;

use App\Models\City as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class City extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
