<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Prophecy\Exception\Exception;

class UserController extends BaseController
{
    /* 登录 */
    public function login(Request $request): Response
    {
        /* 接受数据 */
        $username = $request->userName ?? null;
        $password = $request->password ?? null;

        /* 验证数据 */
        if (!($username && $password)) {
            return $this->create(null, '参数错误', 400);
        }

        /* 查询用户 */
        $query = DB::table('users')
            ->select('id', 'user_name', 'user_pass')
            ->where('user_name', $username)
            ->first();

        /* 校验数据 */
        if (count((array)$query) > 0) {
            if ($query->user_pass === $password) {
                $token = $this->issue($query->id, $query->user_name);
                $data = ["token" => $token];
                /* 存储token */
                Cache::put($token, $token, 360);
                return $this->create($data, '账号登录成功');
            } else {
                return $this->create(null, '密码错误，请重试', 401);
            }
        }
        return $this->create(null, '用户不存在', 401);
    }

    /* 注册 */
    public function registered(Request $request)
    {
        /* 接受数据 */
        $username = $request->post('userName');
        $password = $request->post('password');

        /* 查找是否有相同的用户名 */
        $isUser = DB::table('users')
            ->select('user_name')
            ->where('user_name', $username)
            ->first();

        if ($isUser) {
            return $this->create(null, '该用户名已被占用', 400);
        }

        $time = date('Y-m-d H:i:s');

        $res = DB::table('users')
            ->insert([
                'user_name' => "$username",
                'user_pass' => "$password",
                'user_nick' => "好客_{$this->generatePin(10)}",
                'createdAt' => "$time",
                'updatedAt' => "$time",
            ]);
        if (!$res) {
            return $this->create(null, '账号注册失败', 400);
        }

        return $this->create(null, '账号注册成功');
    }

    /* 退出登录 */
    public function logout(Request $request): Response
    {
        $token = $request->get('authorization');
        if (!Cache::has($token)) {
            return $this->create(null, 'token失效或者异常', 400);
        } else {
            Cache::forget($token);
            return $this->create(null, '退出成功');
        }
    }

    /* 获取用户数据 */
    public function user(Request $request)
    {
        $token = $request->get('authorization');
        if (Cache::has($token)) {
            if ($this->verification($token) === false) {
                return $this->create(null, '登录信息失效,请重新登录', 400);
            }

            $data = $this->verification($token)['data'];
            $id = $data->userId;

            $user = DB::table('users')
                ->select('id', 'user_avatar as avatar', 'user_gender as gender', 'user_nick as nickname', 'user_phone  as phone', 'user_name as username', 'signature')
                ->where('id', $id)
                ->first();

            $user = (array)$user;
            if ($user['phone'] === null) {
                $user['phone'] = URL::asset('images/profile/default_avatar.png');
            } else {
                $tmp_phone = $user['phone'];
                $user['phone'] = URL::asset('storage/avatar/' . $tmp_phone);
            }
            return $this->create($user, '请求用户数据成功');
        }
        return $this->create(null, '登录信息失效,请重新登录', 400);
    }

    /* 获取或者发布房源数据 */
    public function houses(Request $request)
    {
        $method = $request->method();
        $floors = ['FLOOR|3' => '高楼层', 'FLOOR|2' => '中楼层', 'FLOOR|1' => '低楼层'];
        if (strtoupper($method) === 'GET') {
            /* 获取token */
            $token = $request->get('authorization');
            $user_data = $this->verification($token);

            /* 验证token 并请求数据 */
            if ($user_data) {
                try {
                    $user_id = $user_data['data']->userId;
                    $houses = DB::table('houses')
                        ->select('carouselMap', 'title', 'oriented_name', 'tags', 'price_num', 'houseCode', 'size', 'community', 'room_type_name')
                        ->where('user_id', $user_id)
                        ->get();
                    $houses_data = $this->restructure_data($houses);

                    return $this->create($houses_data, '请求成功');
                } catch (Exception $exception) {
                    /* 如果查询失败 代表请求失败 */
                    return $this->create(null, '请求失败', 404);
                }
            } else {
                /* token异常 */
                return $this->create(null, 'token过期或者异常', 400);
            }
        }

        if (strtoupper($method) === 'POST') {
            $house_data = $request->post();
            $token_data = $this->verification($request->post('authorization'));
            if (!$token_data) {
                return $this->create(null, 'token过期或者异常', 400);
            }
            $user_id = $token_data['data']->userId;
            $supporting = explode('|', $house_data['supporting']);
            $supportings = DB::table('devices')
                ->select('code')
                ->whereIn('name', $supporting)
                ->get();
            $supportingCode = [];
            foreach ($supportings as $supporting) {
                $supportingCode[] = $supporting->code;
            }
            $roomType = $this->getName('roomtypes', $house_data['roomType']);
            $oriented = $this->getName('orienteds', $house_data['oriented']);
            $tags = DB::table('characteristics')
                ->select('name')
                ->whereIn('code', $house_data['tags'])
                ->get();
            $tagsCode = [];
            foreach ($tags as $tag) {
                $tagsCode[] = $tag->name;
            }
            $tagsCode = implode('|', $tagsCode);
            $community = DB::table('cities')
                ->select('name', 'superior')
                ->where('code', $house_data['community'])
                ->first();
            $street = DB::table('cities')
                ->select('name', 'code', 'superior')
                ->where('code', $community->superior)
                ->first();
            $area = DB::table('cities')
                ->select('name', 'code')
                ->where('code', $street->superior)
                ->first();
            $area_name = $house_data['city']['label'] . '|' . $area->name . '|' . $street->name . '|' . $community->name;
            $areaID = $house_data['city']['value'] . '|' . $area->code . '|' . $street->code . '|' . $house_data['community'];

            /* 获取地址经纬度 */
            $coord = json_decode(file_get_contents("https://api.map.baidu.com/geocoding/v3/?address=$area_name&ak=z5dX7FsHRTx9KP18xDtHtwofe2QkygbG&output=json"))->result->location;
            $coord_data = json_encode(['latitude' => $coord->lat, 'longitude' => $coord->lng]);

            $supportingCode = implode(',', $supportingCode);

            DB::table('houses')->insert([
                'community' => $community->name,
                'communityID' => $house_data['community'],
                'area_name' => $area_name,
                'areaID' => $areaID,
                'coord' => $coord_data,
                'room_type_name' => $roomType,
                'roomTypeID' => $house_data['roomType'],
                'oriented_name' => $oriented,
                'orientedID' => $house_data['oriented'],
                'floorID' => $house_data['floor'],
                'floor' => $floors[$house_data['floor']],
                'size' => $house_data['size'],
                'supporting' => $house_data['supporting'],
                'supportingID' => $supportingCode,
                'title' => $house_data['title'],
                'carouselMap' => $house_data['houseImg'],
                'price_num' => $house_data['price'],
                'entire' => $house_data['entire'],
                'description' => $house_data['description'],
                'time' => date('Y-m-d H:i:s'),
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
                'tags' => $tagsCode,
                'tagsID' => implode('|', $house_data['tags']),
                'user_id' => $user_id,
                'houseCode' => $this->generatePin(24)
            ]);
            return $this->create(null, '发布房源成功');
        }
    }

    /* 切换收藏 */
    public function favorites(Request $request)
    {
        /* 接受数据 */
        $method = $request->method();
        $token = strtoupper($method) === 'GET' ? $request['authorization'] : $request->post('authorization');
        $house_code = strtoupper($method) === 'GET' ? $request['house_code'] : $request->post('house_code');

        /* 验证token */
        if (!$this->verification($token)) {
            return $this->create(null, 'token异常或者过期', 400);
        }
        try {
            /* 获取用户id 和 房屋 */
            $user_id = $this->verification($token)['data']->userId;
            $house = DB::table('houses')
                ->where('houseCode', $house_code)
                ->first();

            /* 验证房屋是否存在 */
            if (!$house) {
                return $this->create(null, '房屋不存在', 401);
            } else {

                /* 判断是否收藏 */
                $house_id = $house->id;
                $isFavorite = DB::table('favorite')->where('house_id', $house_id)->first();

                /* 根据不同请求进行处理 */
                if (strtoupper($method) === 'GET') {
                    if ($isFavorite) {
                        return $this->create(["isFavorite" => true], '请求成功');
                    } else {
                        return $this->create(["isFavorite" => false], '请求成功');
                    }
                } else if (strtoupper($method) === 'POST') {
                    if (!$isFavorite) {
                        DB::table('favorite')->insert([
                            'id' => null,
                            'user_id' => $user_id,
                            'house_id' => $house_id
                        ]);
                        return $this->create(null, '收藏成功');
                    }
                } else if (strtoupper($method) === 'DELETE') {
                    if ($isFavorite) {
                        DB::table('favorite')->where('house_id', $house_id)->delete();
                        return $this->create(null, '取消收藏成功');
                    }
                }
            }
        } catch (Exception $exception) {
            return $this->create(null, '出现错误', 400);
        }
    }

    /* 用户收藏 */
    public function favorite(Request $request)
    {
        $token_data = $this->verification($request->post('authorization'));
        if (!$token_data) {
            return $this->create(null, 'token过期或者异常', 400);
        }

        $user_id = $token_data['data']->userId;
        try {
            $favorites = DB::table('favorite')
                ->where('user_id', $user_id)
                ->get();
            $favorite_data = [];
            foreach ($favorites as $favorite) {
                $favorite_data[] = DB::table('houses')->where('id', $favorite->house_id)->first();
            }
            $houses_data = $this->restructure_data($favorite_data);
            return $this->create($houses_data, '请求成功');
        } catch (Exception $exception) {
            return $this->create(null, '请求错误', 400);
        }
    }

    /* 修改用户头像 */
    public function modifyAvatar(Request $request)
    {
        $token_data = $this->verification($request->post('authorization'));
        if (!$token_data) {
            return $this->create(null, 'token失效或者异常', 400);
        }

        /* 删除旧头像 */
        $user_id = $token_data['data']->userId;
        $avatar = DB::table('users')
            ->select('user_phone as avatar')
            ->where('id', $user_id)
            ->first()
            ->avatar;
        $isAvatar = $avatar === null;
        $misfiles = Storage::disk('public')->exists('avatar/' . $avatar);
        if (!$isAvatar && $misfiles) {
            Storage::disk('public')->delete('avatar/' . $avatar);
        }


        /* 更新新头像 */
        $img_type = ['jpeg' => '.jpg', 'png' => '.png', 'bmp' => '.bmp'];
        $img = $request->post('avatar');
        preg_match('/data:image\/(\w+)/', $img, $res);
        $type = $img_type[$res[1]];
        $img_data = explode(',', $img)[1];
        $img_name = $this->generatePin(9) . $type;
        Storage::disk('public')->put('/avatar/' . $img_name, base64_decode($img_data));

        DB::table('users')->where('id', $user_id)->update(['user_phone' => $img_name]);

        /* 裁剪图片 */
        $img = Image::make(storage_path('app/public/avatar/' . $img_name));
        $img->fit(120);
        $img->save(storage_path('app/public/avatar/' . $img_name));

        return $this->create(URL::asset('storage/avatar/' . $img_name), '上传头像成功');
    }

    /* 添加 获取 删除 用户浏览记录 */
    public function history(Request $request)
    {
        $method = strtoupper($request->method());
        $token = $request->get('authorization') ?? $request->post('authorization');
        $house_id = $request->get('houseId') ?? $request->post('houseId');
        $token_data = $this->verification($token);

        if (!$token_data) {
            return $this->create(null, 'token过期或者异常', 400);
        }

        $user_id = $token_data['data']->userId;

        $isLook = DB::table('look_history')
            ->where('user_id', $user_id)
            ->where('house_id', $house_id)
            ->get();

        if ($method === 'GET') {
            try {
                $historys = DB::table('look_history')->select('house_id')->where('user_id', $user_id)->get();
                $house_id_ary = [];
                foreach ($historys as $history) {
                    $house_id_ary[] = $history->house_id;
                }
                $data = $this->restructure_data(DB::table('houses')->whereIn('id', $house_id_ary)->get());
                return $this->create($data, '请求成功');
            } catch (\Exception $exception) {
                return $this->create(null, $exception->getMessage());
            }
        } else if ($method === 'POST') {
            if (count($isLook) !== 0) {
                return $this->create(null, '请求成功', 201);
            }

            try {
                DB::table('look_history')->insert([
                    'id' => null,
                    'user_id' => "$user_id",
                    'house_id' => "$house_id"
                ]);
            } catch (\Exception $exception) {
                return $this->create(null, $exception->getMessage());
            }

            return $this->create(null, '请求成功');
        } else if ($method === 'DELETE') {
            DB::table('look_history')->where('user_id', '=', $user_id)->delete();
            return $this->create(null, '删除成功');
        }
    }

    /* 修改用户其他信息 */
    public function uploadInfo(Request $request)
    {
        $attr = $request->post('value');
        $token_data = $this->verification($request->post('authorization'));
        $name_arr = [
            'nickname' => 'user_nick',
            'signature' => 'signature',
            'password' => 'user_pass',
            'gender' => 'user_gender'
        ];

        if (!$token_data) {
            return $this->create(null, 'token过期或者异常', 400);
        }

        $user_id = $token_data['data']->userId;
        try {
            DB::table('users')->where('id', $user_id)->update([
                $name_arr[$attr[1]] => $attr[0]
            ]);
        } catch (\Exception $e) {
            return $this->create(null, $e->getMessage(), 400);
        }

        return $this->create([$attr[1] => $attr[0]], '修改成功');
    }
}
