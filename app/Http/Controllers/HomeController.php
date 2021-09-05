<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class HomeController extends BaseController
{
    public function recommend()
    {
        try {
            $data = DB::table('houses')->inRandomOrder()->offset(0)->limit(3)->get();
            $data = $this->restructure_data($data);
            return $this->create($data, '请求成功');
        } catch (Exception $exception) {
            return $this->create(null, '请求失败', 400);
        }
    }

    public function group()
    {
        $data = [
            [
                "id" => 1,
                "title" => "家住回龙观",
                "desc" => "归属的感觉",
                "imgSrc" => URL::asset('storage/images/group/1.png')
            ],
            [
                "id" => 2,
                "title" => "宜居四五环",
                "desc" => "大都市生活",
                "imgSrc" => URL::asset('storage/images/group/2.png')
            ],
            [
                "id" => 3,
                "title" => "喧嚣三里屯",
                "desc" => "繁华的背后",
                "imgSrc" => URL::asset('storage/images/group/3.png')
            ],
            [
                "id" => 4,
                "title" => "比邻十号线",
                "desc" => "地铁心连心",
                "imgSrc" => URL::asset('storage/images/group/4.png')
            ]
        ];
        return $this->create($data, '请求成功');
    }

    public function swiper()
    {
        $data = DB::table('swiper')->select('id', 'img_name as imgSrc', 'alt')->get();

        foreach ($data as $value) {
            $temp = $value->imgSrc;
            $value->imgSrc = URL::asset('storage/images/swiper/' . $temp);
        }
        return $this->create($data, '请求成功');
    }
}
