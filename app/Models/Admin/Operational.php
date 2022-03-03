<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Operational extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'operational';
    
    
	static $admiko_file_info = [
		"foto"=>[
			"original"=>["folder"=>"upload/"]
		]
	];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"nama",
		"foto",
		"foto_admiko_delete",
		"biaya",
		"tanggal",
		"keterangan",
    ];
    public function setFotoAttribute()
    {
        if (request()->hasFile('foto')) {
            $this->attributes['foto'] = $this->fileUpload(request()->file("foto"), Operational::$admiko_file_info["foto"], $this->getOriginal('foto'));
        }
    }
    public function setFotoAdmikoDeleteAttribute($value)
    {
        if (!request()->hasFile('foto') && request()->foto_admiko_delete == 1) {
            $this->attributes['foto'] = $this->fileUpload('', Operational::$admiko_file_info["foto"], $this->getOriginal('foto'), $value);
        }
    }
	public function getBiayaAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
	public function getTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_format')) : null;
    }
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}