<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Muszaki
 *
 * @property int $azonosito
 * @property int $auto_azonosito
 * @property Carbon $mettol
 * @property Carbon $meddig
 *
 * @package App\Models
 */
class Biztositas extends Model
{
	protected $table = 'biztositas';
	protected $primaryKey = 'azonosito';
	public $timestamps = false;

	protected $casts = [
		'auto_azonosito' => 'int'
	];

	protected $dates = [
		'mettol',
		'meddig'
	];

	protected $fillable = [
		'auto_azonosito',
		'mettol',
		'meddig'
	];
}
