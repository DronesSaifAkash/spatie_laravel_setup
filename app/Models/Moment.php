<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    use HasFactory;
    protected $table = 'tbl_moment';

    protected $fillable = [
        'momentid',
        'userId',
        'isBusinessMoment',
        'businessId',
        'heading',
        'description',
        'permalink',
        'imageName',
        'comment',
        'ispublic',
        'latitude',
        'longitude',
        'distance',
        'publishTime',
        'selfDestruct',
        'shareemail',
        'sharephone',
        'promourl',
        'display_order',
        'flag',
        'reason',
        'status',
        'entryDate',
        'position',
        'created_at',
        'updated_at' 	 	 	
        // Add other fillable attributes here if needed
    ];
    
}
