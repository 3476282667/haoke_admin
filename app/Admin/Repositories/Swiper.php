<?php

namespace App\Admin\Repositories;

use App\Models\Swiper as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Swiper extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
