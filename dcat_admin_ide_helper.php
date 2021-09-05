<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection createdAt
     * @property Grid\Column|Collection introduction
     * @property Grid\Column|Collection roles
     * @property Grid\Column|Collection updatedAt
     * @property Grid\Column|Collection user_name
     * @property Grid\Column|Collection user_pass
     * @property Grid\Column|Collection area
     * @property Grid\Column|Collection area_name
     * @property Grid\Column|Collection city
     * @property Grid\Column|Collection city_name
     * @property Grid\Column|Collection community
     * @property Grid\Column|Collection community_name
     * @property Grid\Column|Collection street
     * @property Grid\Column|Collection street_name
     * @property Grid\Column|Collection code
     * @property Grid\Column|Collection superior
     * @property Grid\Column|Collection dec_id
     * @property Grid\Column|Collection user_coll
     * @property Grid\Column|Collection area_id
     * @property Grid\Column|Collection characteristic_id
     * @property Grid\Column|Collection city_id
     * @property Grid\Column|Collection collection_id
     * @property Grid\Column|Collection device_id
     * @property Grid\Column|Collection house_id
     * @property Grid\Column|Collection oriented_id
     * @property Grid\Column|Collection room_type_id
     * @property Grid\Column|Collection subway_id
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection areaID
     * @property Grid\Column|Collection carouselMap
     * @property Grid\Column|Collection characteristic_name
     * @property Grid\Column|Collection characteristicID
     * @property Grid\Column|Collection communityID
     * @property Grid\Column|Collection coord
     * @property Grid\Column|Collection entire
     * @property Grid\Column|Collection floor
     * @property Grid\Column|Collection floorID
     * @property Grid\Column|Collection houseCode
     * @property Grid\Column|Collection line_name
     * @property Grid\Column|Collection lineID
     * @property Grid\Column|Collection lineNum
     * @property Grid\Column|Collection lock
     * @property Grid\Column|Collection oriented_name
     * @property Grid\Column|Collection orientedID
     * @property Grid\Column|Collection price_num
     * @property Grid\Column|Collection priceType
     * @property Grid\Column|Collection priceTypeID
     * @property Grid\Column|Collection releaseNews
     * @property Grid\Column|Collection room_type_name
     * @property Grid\Column|Collection roomTypeID
     * @property Grid\Column|Collection size
     * @property Grid\Column|Collection supporting
     * @property Grid\Column|Collection supportingID
     * @property Grid\Column|Collection tags
     * @property Grid\Column|Collection tagsID
     * @property Grid\Column|Collection time
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection area_subway_name
     * @property Grid\Column|Collection platform
     * @property Grid\Column|Collection station
     * @property Grid\Column|Collection alt
     * @property Grid\Column|Collection img_name
     * @property Grid\Column|Collection creation_time
     * @property Grid\Column|Collection phone_cer
     * @property Grid\Column|Collection signature
     * @property Grid\Column|Collection user_avatar
     * @property Grid\Column|Collection user_code
     * @property Grid\Column|Collection user_gender
     * @property Grid\Column|Collection user_lock
     * @property Grid\Column|Collection user_nick
     * @property Grid\Column|Collection user_phone
     *
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection createdAt(string $label = null)
     * @method Grid\Column|Collection introduction(string $label = null)
     * @method Grid\Column|Collection roles(string $label = null)
     * @method Grid\Column|Collection updatedAt(string $label = null)
     * @method Grid\Column|Collection user_name(string $label = null)
     * @method Grid\Column|Collection user_pass(string $label = null)
     * @method Grid\Column|Collection area(string $label = null)
     * @method Grid\Column|Collection area_name(string $label = null)
     * @method Grid\Column|Collection city(string $label = null)
     * @method Grid\Column|Collection city_name(string $label = null)
     * @method Grid\Column|Collection community(string $label = null)
     * @method Grid\Column|Collection community_name(string $label = null)
     * @method Grid\Column|Collection street(string $label = null)
     * @method Grid\Column|Collection street_name(string $label = null)
     * @method Grid\Column|Collection code(string $label = null)
     * @method Grid\Column|Collection superior(string $label = null)
     * @method Grid\Column|Collection dec_id(string $label = null)
     * @method Grid\Column|Collection user_coll(string $label = null)
     * @method Grid\Column|Collection area_id(string $label = null)
     * @method Grid\Column|Collection characteristic_id(string $label = null)
     * @method Grid\Column|Collection city_id(string $label = null)
     * @method Grid\Column|Collection collection_id(string $label = null)
     * @method Grid\Column|Collection device_id(string $label = null)
     * @method Grid\Column|Collection house_id(string $label = null)
     * @method Grid\Column|Collection oriented_id(string $label = null)
     * @method Grid\Column|Collection room_type_id(string $label = null)
     * @method Grid\Column|Collection subway_id(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection areaID(string $label = null)
     * @method Grid\Column|Collection carouselMap(string $label = null)
     * @method Grid\Column|Collection characteristic_name(string $label = null)
     * @method Grid\Column|Collection characteristicID(string $label = null)
     * @method Grid\Column|Collection communityID(string $label = null)
     * @method Grid\Column|Collection coord(string $label = null)
     * @method Grid\Column|Collection entire(string $label = null)
     * @method Grid\Column|Collection floor(string $label = null)
     * @method Grid\Column|Collection floorID(string $label = null)
     * @method Grid\Column|Collection houseCode(string $label = null)
     * @method Grid\Column|Collection line_name(string $label = null)
     * @method Grid\Column|Collection lineID(string $label = null)
     * @method Grid\Column|Collection lineNum(string $label = null)
     * @method Grid\Column|Collection lock(string $label = null)
     * @method Grid\Column|Collection oriented_name(string $label = null)
     * @method Grid\Column|Collection orientedID(string $label = null)
     * @method Grid\Column|Collection price_num(string $label = null)
     * @method Grid\Column|Collection priceType(string $label = null)
     * @method Grid\Column|Collection priceTypeID(string $label = null)
     * @method Grid\Column|Collection releaseNews(string $label = null)
     * @method Grid\Column|Collection room_type_name(string $label = null)
     * @method Grid\Column|Collection roomTypeID(string $label = null)
     * @method Grid\Column|Collection size(string $label = null)
     * @method Grid\Column|Collection supporting(string $label = null)
     * @method Grid\Column|Collection supportingID(string $label = null)
     * @method Grid\Column|Collection tags(string $label = null)
     * @method Grid\Column|Collection tagsID(string $label = null)
     * @method Grid\Column|Collection time(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection area_subway_name(string $label = null)
     * @method Grid\Column|Collection platform(string $label = null)
     * @method Grid\Column|Collection station(string $label = null)
     * @method Grid\Column|Collection alt(string $label = null)
     * @method Grid\Column|Collection img_name(string $label = null)
     * @method Grid\Column|Collection creation_time(string $label = null)
     * @method Grid\Column|Collection phone_cer(string $label = null)
     * @method Grid\Column|Collection signature(string $label = null)
     * @method Grid\Column|Collection user_avatar(string $label = null)
     * @method Grid\Column|Collection user_code(string $label = null)
     * @method Grid\Column|Collection user_gender(string $label = null)
     * @method Grid\Column|Collection user_lock(string $label = null)
     * @method Grid\Column|Collection user_nick(string $label = null)
     * @method Grid\Column|Collection user_phone(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection version
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection username
     * @property Show\Field|Collection createdAt
     * @property Show\Field|Collection introduction
     * @property Show\Field|Collection roles
     * @property Show\Field|Collection updatedAt
     * @property Show\Field|Collection user_name
     * @property Show\Field|Collection user_pass
     * @property Show\Field|Collection area
     * @property Show\Field|Collection area_name
     * @property Show\Field|Collection city
     * @property Show\Field|Collection city_name
     * @property Show\Field|Collection community
     * @property Show\Field|Collection community_name
     * @property Show\Field|Collection street
     * @property Show\Field|Collection street_name
     * @property Show\Field|Collection code
     * @property Show\Field|Collection superior
     * @property Show\Field|Collection dec_id
     * @property Show\Field|Collection user_coll
     * @property Show\Field|Collection area_id
     * @property Show\Field|Collection characteristic_id
     * @property Show\Field|Collection city_id
     * @property Show\Field|Collection collection_id
     * @property Show\Field|Collection device_id
     * @property Show\Field|Collection house_id
     * @property Show\Field|Collection oriented_id
     * @property Show\Field|Collection room_type_id
     * @property Show\Field|Collection subway_id
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection areaID
     * @property Show\Field|Collection carouselMap
     * @property Show\Field|Collection characteristic_name
     * @property Show\Field|Collection characteristicID
     * @property Show\Field|Collection communityID
     * @property Show\Field|Collection coord
     * @property Show\Field|Collection entire
     * @property Show\Field|Collection floor
     * @property Show\Field|Collection floorID
     * @property Show\Field|Collection houseCode
     * @property Show\Field|Collection line_name
     * @property Show\Field|Collection lineID
     * @property Show\Field|Collection lineNum
     * @property Show\Field|Collection lock
     * @property Show\Field|Collection oriented_name
     * @property Show\Field|Collection orientedID
     * @property Show\Field|Collection price_num
     * @property Show\Field|Collection priceType
     * @property Show\Field|Collection priceTypeID
     * @property Show\Field|Collection releaseNews
     * @property Show\Field|Collection room_type_name
     * @property Show\Field|Collection roomTypeID
     * @property Show\Field|Collection size
     * @property Show\Field|Collection supporting
     * @property Show\Field|Collection supportingID
     * @property Show\Field|Collection tags
     * @property Show\Field|Collection tagsID
     * @property Show\Field|Collection time
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection area_subway_name
     * @property Show\Field|Collection platform
     * @property Show\Field|Collection station
     * @property Show\Field|Collection alt
     * @property Show\Field|Collection img_name
     * @property Show\Field|Collection creation_time
     * @property Show\Field|Collection phone_cer
     * @property Show\Field|Collection signature
     * @property Show\Field|Collection user_avatar
     * @property Show\Field|Collection user_code
     * @property Show\Field|Collection user_gender
     * @property Show\Field|Collection user_lock
     * @property Show\Field|Collection user_nick
     * @property Show\Field|Collection user_phone
     *
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection createdAt(string $label = null)
     * @method Show\Field|Collection introduction(string $label = null)
     * @method Show\Field|Collection roles(string $label = null)
     * @method Show\Field|Collection updatedAt(string $label = null)
     * @method Show\Field|Collection user_name(string $label = null)
     * @method Show\Field|Collection user_pass(string $label = null)
     * @method Show\Field|Collection area(string $label = null)
     * @method Show\Field|Collection area_name(string $label = null)
     * @method Show\Field|Collection city(string $label = null)
     * @method Show\Field|Collection city_name(string $label = null)
     * @method Show\Field|Collection community(string $label = null)
     * @method Show\Field|Collection community_name(string $label = null)
     * @method Show\Field|Collection street(string $label = null)
     * @method Show\Field|Collection street_name(string $label = null)
     * @method Show\Field|Collection code(string $label = null)
     * @method Show\Field|Collection superior(string $label = null)
     * @method Show\Field|Collection dec_id(string $label = null)
     * @method Show\Field|Collection user_coll(string $label = null)
     * @method Show\Field|Collection area_id(string $label = null)
     * @method Show\Field|Collection characteristic_id(string $label = null)
     * @method Show\Field|Collection city_id(string $label = null)
     * @method Show\Field|Collection collection_id(string $label = null)
     * @method Show\Field|Collection device_id(string $label = null)
     * @method Show\Field|Collection house_id(string $label = null)
     * @method Show\Field|Collection oriented_id(string $label = null)
     * @method Show\Field|Collection room_type_id(string $label = null)
     * @method Show\Field|Collection subway_id(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection areaID(string $label = null)
     * @method Show\Field|Collection carouselMap(string $label = null)
     * @method Show\Field|Collection characteristic_name(string $label = null)
     * @method Show\Field|Collection characteristicID(string $label = null)
     * @method Show\Field|Collection communityID(string $label = null)
     * @method Show\Field|Collection coord(string $label = null)
     * @method Show\Field|Collection entire(string $label = null)
     * @method Show\Field|Collection floor(string $label = null)
     * @method Show\Field|Collection floorID(string $label = null)
     * @method Show\Field|Collection houseCode(string $label = null)
     * @method Show\Field|Collection line_name(string $label = null)
     * @method Show\Field|Collection lineID(string $label = null)
     * @method Show\Field|Collection lineNum(string $label = null)
     * @method Show\Field|Collection lock(string $label = null)
     * @method Show\Field|Collection oriented_name(string $label = null)
     * @method Show\Field|Collection orientedID(string $label = null)
     * @method Show\Field|Collection price_num(string $label = null)
     * @method Show\Field|Collection priceType(string $label = null)
     * @method Show\Field|Collection priceTypeID(string $label = null)
     * @method Show\Field|Collection releaseNews(string $label = null)
     * @method Show\Field|Collection room_type_name(string $label = null)
     * @method Show\Field|Collection roomTypeID(string $label = null)
     * @method Show\Field|Collection size(string $label = null)
     * @method Show\Field|Collection supporting(string $label = null)
     * @method Show\Field|Collection supportingID(string $label = null)
     * @method Show\Field|Collection tags(string $label = null)
     * @method Show\Field|Collection tagsID(string $label = null)
     * @method Show\Field|Collection time(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection area_subway_name(string $label = null)
     * @method Show\Field|Collection platform(string $label = null)
     * @method Show\Field|Collection station(string $label = null)
     * @method Show\Field|Collection alt(string $label = null)
     * @method Show\Field|Collection img_name(string $label = null)
     * @method Show\Field|Collection creation_time(string $label = null)
     * @method Show\Field|Collection phone_cer(string $label = null)
     * @method Show\Field|Collection signature(string $label = null)
     * @method Show\Field|Collection user_avatar(string $label = null)
     * @method Show\Field|Collection user_code(string $label = null)
     * @method Show\Field|Collection user_gender(string $label = null)
     * @method Show\Field|Collection user_lock(string $label = null)
     * @method Show\Field|Collection user_nick(string $label = null)
     * @method Show\Field|Collection user_phone(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
