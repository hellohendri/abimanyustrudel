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

class ProductionHistoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            "nama"=>[
				"string",
				"required"
			],
			"jenis"=>[
				"required"
			],
			"jumlah"=>[
				"integer",
				"required"
			],
			"hpp"=>[
				"integer",
				"required"
			],
			"tanggal_produksi"=>[
				'date_format:"'.config('admiko_config.table_date_format').'"',
				"required"
			],
			"tanggal_expired"=>[
				'date_format:"'.config('admiko_config.table_date_format').'"',
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "nama"=>"Nama",
			"jenis"=>"Jenis",
			"jumlah"=>"Jumlah",
			"hpp"=>"HPP",
			"tanggal_produksi"=>"Tanggal Produksi",
			"tanggal_expired"=>"Tanggal Expired"
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