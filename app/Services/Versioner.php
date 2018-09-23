<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class Versioner
{
    /**
     * Generates the versioning table from the class and saves a copy of the
     * model to it
     *
     * @param  Model  $model
     * @return void
     */
    public function make(Model $model)
    {
        $class = get_class($model);
        $versionClass = sprintf('%sVersion', $class);

        $version = new $versionClass;

        $primaryKey = substr($model->getTable(), 0, -1) . '_id';

        $model->$primaryKey = $model->id;
        $model->updated_by = app('AuthenticatedUser')->id;
        unset($model->id);

        $version->create($model->getAttributes());
    }
}
