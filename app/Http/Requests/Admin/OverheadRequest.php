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

class OverheadRequest extends FormRequest
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
			"harga"=>[
				"numeric",
				"required"
			],
			"tanggal"=>[
				'date_format:"'.config('admiko_config.table_date_format').'"',
				"required"
			],
			"image"=>[
				"image",
				"file_extension:jpg,png,jpeg",
				"mimes:jpg,png,jpeg",
				"nullable"
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
			"harga"=>"Harga",
			"tanggal"=>"Tanggal",
			"image"=>"Image",
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