<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $title
 */
class Census extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'census';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['id', 'title'];
    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = ['id' => 'integer'];

    public static function labels()
    {
        return [
            'id' => 'id',
            'title' => 'title',
        ];
    }
}