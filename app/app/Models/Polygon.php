<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polygon extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "polygons";

    /**
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        "oblast",
        "geom",
    ];
}
