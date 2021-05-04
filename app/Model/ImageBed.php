<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $title 图片标题
 * @property string $image 图片地址
 */
class ImageBed extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'image_bed';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['id', 'title', 'image'];
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
            'image' => 'image',
        ];
    }
}