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
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;

class Product extends Model
{
    use AdmikoFileUploadTrait;

    public $table = 'product';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"nama",
		"jenis",
		"hpp",
		"harga_jual",
		"deskripsi",
    ];
    public function jenis_id()
    {
        return $this->belongsTo(ProductCategory::class, 'jenis');
    }
	public function getHppAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
	public function getHargaJualAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}