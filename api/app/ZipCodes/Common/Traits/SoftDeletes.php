<?php

namespace App\ZipCodes\Common\Traits;

use Illuminate\Database\Eloquent\SoftDeletes as EloquentSoftDeletes;

trait SoftDeletes
{
    use EloquentSoftDeletes;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->trashed();
    }
}
