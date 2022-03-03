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

class SalesRequest extends FormRequest
{
    public function rules()
    {
        return [
            "nama"=>[
				"required"
			],
			"metode_pembayaran"=>[
				"required"
			],
			"status_pembayaran"=>[
				"required"
			],
			"jumlah"=>[
				"integer",
				"required"
			],
			"tanggal"=>[
				'date_format:"'.config('admiko_config.table_date_time_format').'"',
				"required"
			]
        ];
    }
    public function attributes()
    {
        return [
            "nama"=>"Nama",
			"metode_pembayaran"=>"Metode Pembayaran",
			"status_pembayaran"=>"Status Pembayaran",
			"jumlah"=>"Jumlah",
			"tanggal"=>"Tanggal"
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