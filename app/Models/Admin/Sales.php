<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;
use App\Models\Admin\PaymentMethod;
use App\Models\Admin\PaymentStatus;
use Carbon\Carbon;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Sales extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'sales';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"nama",
		"metode_pembayaran",
		"status_pembayaran",
		"jumlah",
		"tanggal",
    ];
    public function nama_id()
    {
        return $this->belongsTo(Product::class, 'nama');
    }
	public function metode_pembayaran_id()
    {
        return $this->belongsTo(PaymentMethod::class, 'metode_pembayaran');
    }
	public function status_pembayaran_id()
    {
        return $this->belongsTo(PaymentStatus::class, 'status_pembayaran');
    }
	public function getTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_time_format')) : null;
    }
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}