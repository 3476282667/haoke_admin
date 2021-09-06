<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Overtrue\Pinyin\Pinyin;

class AreaController extends BaseController
{
    /* 获取小区 */
    public function community(Request $request)
    {
        $name = $request->get('name');
        $id = $request->get('id');
        $isName = $request->get('isName');

        /* 判断参数 */
        if (!($name && $id)) {
            return $this->create(null, '参数错误', 400);
        }

        /* 查询数据 */
        /* 查询当前城市 */

        $quarter_data = DB::table('areas')
            ->select('city', 'city_name', 'area', 'area_name', 'street', 'street_name', 'community', 'community_name')
            ->where('city', $id)
            ->where('community_name', 'LIKE', "%$name%")
            ->get();

        if (!$isName) {
            foreach ($quarter_data as $value) {
                $temp = $value->community_name;
                $value->community_name = $value->city_name . $temp;
            }
        }

        return $this->create($quarter_data, '请求成功');
    }

    /* 获取地名 */
    public function citylist(Request $request)
    {
        $level = $request->get('level') ? $request->get('level') : 1;
        $data = DB::table('cities')->where('type', $level)->get();
        $res = $this->pinyin($data);

        return $this->create($res);
    }

    /* 获取热门城市 */
    public function hot()
    {
        $data = DB::table('cities')
            ->where('name', '上海')
            ->orWhere('name', '深圳')
            ->orWhere('name', '北京')
            ->orWhere('name', '广州')
            ->get();
        $res = $this->pinyin($data);

        return $this->create($res, '请求成功');
    }

    /* 获取当前城市信息 */
    public function info(Request $request)
    {
        $cityname = $request->get('cityname');

        if (!$cityname) {
            return $this->create(null, '参数错误', 400);
        }

        $data = DB::table('cities')
            ->where('name', $cityname)
            ->first();
        if (!$data){
            // 如果找不到，就默认返回北京的位置
            return $this->create(['label' => '北京', 'value' => 'AREA|88cff55c-aaa4-e2e0'], '请求成功');
        }
        $res = [
            'label' => $data->name,
            'value' => $data->code
        ];
        return $this->create($res, '请求成功');
    }

    /* 获取城市经纬度信息 */
    public function map(Request $request)
    {
        $id = $request->get('id');
        $city_name = $request->get('city_name');
        if (!$id && !$city_name) {
            return $this->create(null, '参数错误', 400);
        }

        $data = DB::table('cities')->where('superior', $id)->get();
        $res = [];
        foreach ($data as $value) {
            $count = $this->get_count($value->type, $value->code);
            $get_url = "https://api.map.baidu.com/geocoding/v3/?address={$city_name}市{$value->name}区&output=json&ak=z5dX7FsHRTx9KP18xDtHtwofe2QkygbG";
            $coord = json_decode(file_get_contents($get_url));
            if ($count > 0) {
                $temp = [
                    'label' => $value->name,
                    'value' => $value->code,
                    'count' => $count,
                    'coord' => [
                        "latitude" => $coord->result->location->lat,
                        "longitude" => $coord->result->location->lng
                    ]
                ];
                $res[] = $temp;
            }
        }

        return $this->create($res);
    }

    // 重构数据
    protected function pinyin($dates): array
    {
        /* 实例化方法对象 */
        $pinyin = new Pinyin();

        $res = [];
        foreach ($dates as $data) {
            /* 拿到拼音数组 */
            $py = $pinyin->convert($data->name);
            /* 获取缩写 */
            $short = '';
            foreach ($py as $value) {
                $short .= substr($value, 0, 1);
            }
            /* 重构数据 */
            $result = [
                'label' => $data->name,
                'value' => $data->code,
                'pinyin' => implode($py),
                'short' => $short
            ];
            $res[] = $result;
        }
        return $res;
    }

    protected function get_count($type, $id): int
    {
        if ($type === 4) {
            return DB::table('houses')
                ->where('areaID', 'like', "%|$id%")
                ->get()
                ->count();
        } else {
            return DB::table('houses')
                ->where('areaID', 'like', "%|$id|%")
                ->get()
                ->count();
        }
    }
}
