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

class Overhead extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'overhead';
    
    
	static $admiko_file_info = [
		"image"=>[
			"original"=>["action"=>"resize","width"=>1920,"height"=>1080,"folder"=>"upload/"]
		]
	];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"nama",
		"jumlah",
		"harga",
		"tanggal",
		"image",
		"image_admiko_delete",
		"keterangan",
    ];
    public function getHargaAttribute($value)
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
	public function setImageAttribute()
    {
        if (request()->hasFile('image')) {
            $this->attributes['image'] = $this->imageUpload(request()->file("image"), Overhead::$admiko_file_info["image"], $this->getOriginal('image'));
        }
    }
    public function setImageAdmikoDeleteAttribute($value)
    {
        if (!request()->hasFile('image') && $value == 1) {
            $this->attributes['image'] = $this->imageUpload('', Overhead::$admiko_file_info["image"], $this->getOriginal('image'), $value);
        }
    }
}