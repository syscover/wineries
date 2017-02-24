<?php namespace Syscover\Wineries\Models;

use Syscover\Pulsar\Core\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Support\Facades\Validator;

/**
 * Class Winery
 *
 * Model with properties
 * <br><b>[id, custom_field_group, hotel_id, name, slug, web, web_url, contact, email, phone, mobile, fax, active, country_id, territorial_area_1_id, territorial_area_2_id, territorial_area_3_id, cp, locality, address, latitude, longitude, booking_data, booking_email, data_lang, data]</b>
 *
 * @package     Syscover\Wineries\Models
 */

class Winery extends Model
{
    use Eloquence, Mappable;

	protected $table        = '015_190_winery';
    protected $primaryKey   = 'id_190';
    protected $suffix       = '190';
    public $timestamps      = false;
    protected $fillable     = ['id_190', 'field_group_id_190', 'hotel_id_190', 'name_190', 'slug_190', 'web_190', 'web_url_190', 'contact_190', 'email_190', 'phone_190', 'mobile_190', 'fax_190', 'active_190', 'country_id_190', 'territorial_area_1_id_190', 'territorial_area_2_id_190', 'territorial_area_3_id_190', 'cp_190', 'locality_190', 'address_190', 'latitude_190', 'longitude_190', 'booking_data_190', 'booking_email_190', 'data_lang_190', 'data_190'];
    protected $maps         = [];
    protected $relationMaps = [
        'hotel'         => \Syscover\Hotels\Models\Hotel::class, // if this winery belonging to a hotel
        'lang'          => \Syscover\Pulsar\Models\Lang::class,
        'winery_lang'   => \Syscover\Wineries\Models\WineryLang::class,
        'country'       => \Syscover\Pulsar\Models\Country::class
    ];
    private static $rules   = [
        'name'      => 'required|between:2,100',
        'email'     => 'required|between:2,50|email|unique:015_190_winery,email_190',
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['emailRule']) && $specialRules['emailRule']) static::$rules['email'] = 'required|between:2,50|email';

        return Validator::make($data, static::$rules);
	}

    /**
     * @param   \Sofa\Eloquence\Builder     $query
     * @return  mixed
     */
    public function scopeBuilder($query)
    {
        return $query->join('015_191_winery_lang', '015_190_winery.id_190', '=', '015_191_winery_lang.id_191')
            ->join('001_001_lang', '015_191_winery_lang.lang_id_191', '=', '001_001_lang.id_001')
            ->join('001_002_country', function ($join) {
                $join->on('015_190_winery.country_id_190', '=', '001_002_country.id_002')
                    ->on('001_002_country.lang_id_002', '=', '001_001_lang.id_001');
            })
            ->leftJoin('001_003_territorial_area_1', '015_190_winery.territorial_area_1_id_190', '=', '001_003_territorial_area_1.id_003')
            ->leftJoin('001_004_territorial_area_2', '015_190_winery.territorial_area_2_id_190', '=', '001_004_territorial_area_2.id_004');
    }

    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_id_191');
    }

    public function addToGetIndexRecords($request, $parameters)
    {
        $query =  $this->builder();

        if(isset($parameters['lang'])) $query->where('lang_id_191', $parameters['lang']);

        return $query;
    }

    public static function getTranslationRecord($parameters)
    {
        return Winery::join('015_191_winery_lang', '015_190_winery.id_190', '=', '015_191_winery_lang.id_191')
            ->join('001_001_lang', '015_191_winery_lang.lang_id_191', '=', '001_001_lang.id_001')
            ->where('id_190', $parameters['id'])->where('lang_id_191', $parameters['lang'])
            ->first();
    }

    public static function getRecords($parameters)
    {
        $query = Winery::builder();

        if(isset($parameters['slug_190'])) $query->where('slug_190', $parameters['slug_190']);
        if(isset($parameters['lang_id_191'])) $query->where('lang_id_191', $parameters['lang_id_191']);
        if(isset($parameters['territorial_area_1_id_190'])) $query->where('territorial_area_1_id_190', $parameters['territorial_area_1_id_190']);

        if(isset($parameters['active_190'])) $query->where('active_190', true);

        return $query->get();
    }
}