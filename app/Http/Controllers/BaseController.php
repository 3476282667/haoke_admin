<?php

namespace App\Http\Controllers;

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Prophecy\Exception\Exception;

class BaseController extends Controller
{
    /* 返回值结构 */
    public function create($data, $msg = '', $status = 200)
    {
        $request = [
            'status' => $status,
            'msg' => $msg,
            'body' => $data
        ];

        return response($request);
    }

    /* 生成随机用户名 */
    protected function generatePin($number)
    {
        $alpha = array();
        for ($u = 65; $u <= 90; $u++) {
            // Uppercase Char
            array_push($alpha, chr($u));
        }

        $rand_alpha_key = array_rand($alpha);
        $rand_alpha = $alpha[$rand_alpha_key];

        $rand = array($rand_alpha);
        for ($c = 0; $c < $number - 1; $c++) {
            array_push($rand, mt_rand(0, 9));
            shuffle($rand);
        }

        return implode('', $rand);
    }

    protected function getStreet($quarter_superior, $streets)
    {
        foreach ($streets as $street) {
            if ($quarter_superior === $street->streetCode) {
                return ['code' => $street->streetCode, 'name' => $street->streetName, 'superior' => $street->streetSuperior];
            }
        }
        return [];
    }

    protected function getArea($street_superior, $areas)
    {
        foreach ($areas as $area) {
            if ($street_superior === $area->areaCode) {
                return ['code' => $area->areaCode, 'name' => $area->areaName];
            }
        }
        return [];
    }

    protected function getName($table, $name)
    {
        return DB::table($table)->select('name')->where('code', $name)->first()->name;
    }

    // 重构数据
    protected function restructure_data($DB_data)
    {
        $houses_data = [];
        foreach ($DB_data as $DB) {
            $data = [];
            $data['tags'] = explode('|', $DB->tags);
            $data['houseImg'] = URL::asset('storage/images/newImg/' . explode('|', $DB->carouselMap)[0]);
            $data['desc'] = $DB->room_type_name . '/' . $DB->size . '/' . $DB->oriented_name . '/' . $DB->community;
            $data['title'] = $DB->title;
            $data['houseCode'] = $DB->houseCode;
            $data['price'] = $DB->price_num;
            $houses_data[] = $data;
        }
        return $houses_data;
    }

    /* 签发token */
    protected function issue($user_id, $user_name): string
    {
        $time = time();
        $key = "localhost";
        $payload = array(
            "iss" => "localhost",
            "aud" => "localhost",
            "iat" => $time,
            "exp" => $time + 3600000,
            "nbf" => $time + 15,
            "jti" => $time,
            "data" => [
                "userId" => $user_id,
                "username" => $user_name,
                "isLogin" => true,
            ]
        );

        return JWT::encode($payload, $key);
    }

    /* 校验token */
    protected function verification($token)
    {
        if (!Cache::has($token)) {
            return false;
        }

        $key = 'localhost';
        if ($token !== null) {
            try {
                JWT::$leeway += 15;//当前时间减去60，把时间留点余地
                $decoded = JWT::decode($token, $key, ['HS256']); //HS256方式，这里要和签发的时候对应

                return (array)$decoded;
            } catch (SignatureInvalidException | ExpiredException | BeforeValidException | Exception $exception) {
                return false;
            }
        }
        return false;
    }
}
