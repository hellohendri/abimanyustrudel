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

class BalanceRequest extends FormRequest
{
    public function rules()
    {
        return [
            "kategori"=>[
				"nullable"
			],
			"jumlah"=>[
				"numeric",
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "kategori"=>"Kategori",
			"jumlah"=>"Jumlah"
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