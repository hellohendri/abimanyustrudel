<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\PaymentMethod;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Balance extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'balance';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"kategori",
		"jumlah",
    ];
    public function kategori_id()
    {
        return $this->belongsTo(PaymentMethod::class, 'kategori');
    }
	public function getJumlahAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}