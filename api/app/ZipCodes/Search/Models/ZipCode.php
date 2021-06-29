<?php

namespace App\ZipCodes\Search\Models;

use App\ZipCodes\Common\Traits\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ZipCode
 * @package App\ZipCodes\Models
 */
class ZipCode extends Model
{
    use SoftDeletes;
}
