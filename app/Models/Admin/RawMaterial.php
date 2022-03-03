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

class RawMaterial extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'raw_material';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"nama",
		"jumlah",
		"satuan",
		"harga",
		"tanggal_pembelian",
		"keterangan",
    ];
    public function getHargaAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
	public function getTanggalPembelianAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_format')) : null;
    }
    public function setTanggalPembelianAttribute($value)
    {
        $this->attributes['tanggal_pembelian'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}