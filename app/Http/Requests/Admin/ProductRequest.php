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

class ProductRequest extends FormRequest
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
			"hpp"=>[
				"numeric",
				"required"
			],
			"harga_jual"=>[
				"numeric",
				"required"
			],
			"deskripsi"=>[
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "nama"=>"Nama",
			"jenis"=>"Jenis",
			"hpp"=>"HPP",
			"harga_jual"=>"Harga Jual",
			"deskripsi"=>"Deskripsi"
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