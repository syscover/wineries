<?php namespace Syscover\Wineries\Models;

use Syscover\Pulsar\Models\Model;
use Illuminate\Support\Facades\Validator;
use Syscover\Pulsar\Traits\TraitModel;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

/**
 * Class WineryLang
 *
 * Model with properties
 * <br><b>[id, lang, cuisine, description_title, description, activity]</b>
 *
 * @package     Syscover\Spas\Models
 */

class WineryLang extends Model {

    use TraitModel;
    use Eloquence, Mappable;

	protected $table        = '015_191_winery_lang';
    protected $primaryKey   = 'id_191';
    protected $suffix       = '191';
    public $timestamps      = false;
    protected $fillable     = ['id_191', 'lang_191', 'description_title_191', 'description_191', 'activity_191'];
    protected $maps         = [];
    protected $relationMaps = [
        'lang'  => \Syscover\Pulsar\Models\Lang::class
    ];
    private static $rules   = [];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}

    public function getLang()
    {
        return $this->belongsTo('Syscover\Pulsar\Models\Lang', 'lang_191');
    }
}