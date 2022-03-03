<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Response;

class RawMaterialRequest extends FormRequest
{
    public function rules()
    {
        return [
            "nama"=>[
				"string",
				"required"
			],
			"jumlah"=>[
				"integer",
				"required"
			],
			"satuan"=>[
				"string",
				"required"
			],
			"harga"=>[
				"numeric",
				"required"
			],
			"tanggal_pembelian"=>[
				'date_format:"'.config('admiko_config.table_date_format').'"',
				"required"
			],
			"keterangan"=>[
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "nama"=>"Nama",
			"jumlah"=>"Jumlah",
			"satuan"=>"Satuan",
			"harga"=>"Harga",
			"tanggal_pembelian"=>"Tanggal Pembelian",
			"keterangan"=>"Keterangan"
        ];
    }
    
    public function authorize()
    {
        if (!auth("admin")->check()) {
            return false;
        }
        return true;
    }
}