<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name', 'address', 'latitude', 'longitude', 'creator_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
        'coordinate',
    ];

     /**
     * Get outlet name_link attribute.
     *
     * @return string
     */
    // public function getNameLinkAttribute()
    // {
    //     $title = __('app.show_detail_title', [
    //         'name' => $this->name, 'type' => __('outlet.outlet'),
    //     ]);
    //     $link = '<a href="'.route('outlets.show', $this).'"';
    //     $link .= ' title="'.$title.'">';
    //     $link .= $this->name;
    //     $link .= '</a>';

    //     return $link;
    // }

    /**
     * Outlet belongs to User model relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get outlet coordinate attribute.
     *
     * @return string|null
     */
    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude.', '.$this->longitude;
        }
    }


}
