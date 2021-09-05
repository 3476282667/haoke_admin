<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class HousesController extends BaseController
{
    public function upload_image(Request $request)
    {

        $img_type = ['jpeg' => '.jpg', 'png' => '.png', 'bmp' => '.bmp'];

        $file_arr = $request->post('file');
        if ($request->post('file') === null) {
            return $this->create(null, '至少上传一张图片', 204);
        }
        $result_arr = [];

        foreach ($file_arr as $key => $value) {
            preg_match('/data:image\/(\w+)/', $value, $res);
            $base_data = explode(',', $value)[1];
            if ($img_type[$res[1]] === null) {
                return $this->create(null, '图片格式不对，仅支持png、jpg、bmp', 205);
            }

            $img_name = $this->generatePin(9) . $img_type[$res[1]];
            $result_arr[$key] = $img_name;
            Storage::disk('public')->put('images/newImg/' . $img_name, base64_decode($base_data));
        }

        return $this->create($result_arr, '发布房源成功');
    }

    /* 获取房源信息 */
    public function index(Request $request)
    {
        $id = $request->get('id');

        if (!$id) {
            return $this->create(null, '参数错误', 400);
        }

        $data = DB::table('houses')->where('areaID', 'like', "%|$id")->first();
        $img_url = explode('|', $data->carouselMap)[0];
        $res = array(
            "desc" => "$data->room_type_name/$data->size/$data->oriented_name/$data->community",
            "title" => $data->title,
            "houseCode" => $data->houseCode,
            "houseImg" => URL::asset("storage/images/newImg/$img_url"),
            "tags" => explode('|', $data->tags),
            "price" => $data->price_num
        );
        return $this->create([$res]);
    }

    /* 获取筛选条件数据 */
    public function condition(Request $request)
    {
        $city_id = $request->get('id');
        $city_name = $request->get('city_name');

        if (!$city_id && !$city_name) {
            return $this->create(null, '参数错误');
        }
        $areas = [
            'label' => '区域',
            'value' => 'area',
            'children' => [
                ['label' => '不限', 'value' => null]
            ]
        ];
        $area_data = DB::table('areas')
            ->select('area', 'area_name')
            ->where('city', $city_id)
            ->groupBy('area')
            ->get();
        foreach ($area_data as $value) {
            $street_data = DB::table('areas')
                ->select('street as value', 'street_name as label')
                ->where('area', $value->area)
                ->groupBy('street')
                ->get();
            $temp = [
                'label' => $value->area_name,
                'value' => $value->area,
                'children' => [['label' => '不限', 'value' => null], ...$street_data]
            ];
            $areas['children'][] = $temp;
        }
        $subs = [
            'label' => '地铁',
            'value' => 'subway',
            'children' => [
                ['label' => '不限', 'value' => null]
            ]
        ];
        $subways_data = DB::table('subways')
            ->where('area_subway_name', $city_name)
            ->select('station', 'code')
            ->groupBy('station')
            ->get();
        foreach ($subways_data as $value) {

            $data = DB::table('subways')
                ->select('platform as label', 'code as value')
                ->where('area_subway_name', $city_name)
                ->where('station', $value->station)
                ->get();

            $temp = [
                'label' => $value->station,
                'value' => $value->code,
                'children' => [['label' => '不限', 'value' => null], ...$data]
            ];

            $subs['children'][] = $temp;
        }

        $characteristic_data = DB::table('characteristics')
            ->select('name as label', 'code as value')
            ->get();

        $floor = [
            ['label' => '高楼层', 'value' => 'FLOOR|3'],
            ['label' => '中楼层', 'value' => 'FLOOR|2'],
            ['label' => '低楼层', 'value' => 'FLOOR|1']
        ];

        $oriented = DB::table('orienteds')
            ->select('name as label', 'code as value')
            ->get();

        $price = [
            [
                "label" => "不限",
                "value" => null
            ],
            [
                "label" => "1000元以下",
                "value" => "PRICE|1000-"
            ],
            [
                "label" => "2000-3000",
                "value" => "PRICE|3000"
            ],
            [
                "label" => "3000-4000",
                "value" => "PRICE|4000"
            ],
            [
                "label" => "4000-5000",
                "value" => "PRICE|5000"
            ],
            [
                "label" => "5000-6000",
                "value" => "PRICE|6000"
            ],
            [
                "label" => "6000-7000",
                "value" => "PRICE|7000"
            ],
            [
                "label" => "70000+",
                "value" => "PRICE|7000+"
            ]
        ];

        $rentType = [
            ['label' => '不限', 'value' => null],
            ['label' => '整租', 'value' => true],
            ['label' => '合租', 'value' => false]
        ];

        $roomType = DB::table('roomtypes')
            ->orderBy('name')
            ->select('name as label', 'code as value')
            ->get();

        return $this->create([
            'area' => $areas,
            'subway' => $subs,
            'characteristic' => $characteristic_data,
            'floor' => $floor,
            'oriented' => $oriented,
            'price' => $price,
            'rentType' => $rentType,
            'roomType' => $roomType,
        ]);
    }

    /* 根据条件筛选房源 */
    public function house(Request $request)
    {
        $city_name = $request->get('cityName');
        $area = $request->get('area');
        $mode = $request->get('mode');
        $price = $request->get('price');
        $more = $request->get('more');
        $start = $request->get('start');
        $subway = $request->get('subway');

        $data = DB::table('houses')->where('area_name', 'like', "$city_name|%");
        if ($area) {
            $data = $data->where('areaID', 'LIKE', "%$area%");
        }

        if ($subway) {
            $data = $data->where('areaID', 'LIKE', "%$subway%");
        }

        if ($price) {
            switch ($price) {
                case 'PRICE|1000-' :
                    $data = $data->where('price_num', '<', 1000);
                    break;
                case 'PRICE|3000' :
                    $data = $data->whereBetween('price_num', [2000, 3000]);
                    break;
                case 'PRICE|4000' :
                    $data = $data->whereBetween('price_num', [3000, 4000]);
                    break;
                case 'PRICE|5000' :
                    $data = $data->whereBetween('price_num', [4000, 5000]);
                    break;
                case 'PRICE|6000-' :
                    $data = $data->whereBetween('price_num', [5000, 6000]);
                    break;
                case 'PRICE|7000' :
                    $data = $data->whereBetween('price_num', [6000, 7000]);
                    break;
                case 'PRICE|7000+' :
                    $data = $data->where('price_num', '>', 7000);
                    break;
            }
        }

        if ($mode) {
            switch ($mode) {
                case"true" :
                    $data = $data->where('entire', 1);
                    break;
                case "false" :
                    $data = $data->where('entire', 0);
                    break;
            }
        }

        if ($more) {
            $morearr = explode(',', $more);
            $namearr = ['ROOM' => 'roomTypeID', 'ORIEN' => 'orientedID', 'CHAR' => 'tagsID'];
            $floor = ['FLOOR|1' => '低楼层', 'FLOOR|2' => '中楼层', 'FLOOR|3' => '高楼层'];
            foreach ($morearr as $value) {
                $keys = explode('|', $value)[0];
                if (isset($namearr[$keys])) {
                    if ($keys === 'CHAR') {
                        $data = $data->where('tagsID', 'LIKE', "%$value%");
                    } else {
                        $data = $data->where($namearr[$keys], $value);
                    }
                } else {
                    $data = $data->where('floor', $floor[$value]);
                }
            }
        }
        $count = $data->count();
        $data = $this->restructure_data($data->offset($start)->limit(20)->get());

        return $this->create(['list' => $data, 'count' => $count]);
    }

    /* 房源详细信息 */
    public function houseDetail(Request $request)
    {
        $house_id = $request->get('id');

        if (!$house_id) {
            return $this->create(null, '请求失败，参数错误', 400);
        }
        try {
            $data = DB::table('houses')
                ->where('houseCode', $house_id)
                ->first();
            $slider = [];
            foreach (explode('|', $data->carouselMap) as $value) {
                $slider[] = URL::asset('storage/images/newImg/' . $value);
            }
            $house = [
                'houseId' => $data->id,
                'slides' => $slider,
                'houseCode' => $house_id,
                'coord' => $data->coord,
                'title' => $data->title,
                'oriented' => explode('|', $data->oriented_name),
                'tags' => explode('|', $data->tags),
                'description' => $data->description,
                'community' => $data->community,
                'floor' => $data->floor,
                'size' => $data->size,
                'price' => $data->price_num,
                'roomType' => $data->room_type_name,
                'supporting' => explode('|', $data->supporting)
            ];
            return $this->create($house);
        } catch (Exception $exception) {
            return $this->create(null, $exception->getMessage(), 401);
        }
    }

    /* 搜索小区或者地区下房源 */
    public function search(Request $request)
    {

        $city_id = $request->get('id');
        $search_text = $request->get('q');
        $start = $request->get('start') * 1;

        $query = DB::table('houses')
            ->where('areaID', 'LIKE', "$city_id|%")
            ->where('community', 'LIKE', "%$search_text%");

        $count = $query->count();
        $house_data = $this->restructure_data($query->offset($start)->limit(20)->get());

        return $this->create(['list' => $house_data, 'count' => $count]);
    }
}
