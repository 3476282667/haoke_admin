<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Swiper extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'swiper';
    public $timestamps = false;

}
