<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ProductCategory;
use Carbon\Carbon;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class ProductionHistory extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'production_history';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"nama",
		"jenis",
		"jumlah",
		"hpp",
		"tanggal_produksi",
		"tanggal_expired",
    ];
    public function jenis_id()
    {
        return $this->belongsTo(ProductCategory::class, 'jenis');
    }
	public function getTanggalProduksiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_format')) : null;
    }
    public function setTanggalProduksiAttribute($value)
    {
        $this->attributes['tanggal_produksi'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_format'), $value)->format('Y-m-d H:i:s') : null;
    }
	public function getTanggalExpiredAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_format')) : null;
    }
    public function setTanggalExpiredAttribute($value)
    {
        $this->attributes['tanggal_expired'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}