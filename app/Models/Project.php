<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'client_id',
        'consultant_id',
        'location',
        'status',
        'visible',
        'description',
        'card_img',
        'featured',
        'size',
        'completed_year',
        'duration',
        'slug',
        'sequence',
        'project_code'
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('position');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function consultant()
    {
        return $this->belongsTo(Consultant::class, 'consultant_id');
    }

    /**
     * Public URL of the card image of the latest ongoing project, used as the
     * cover for "Ongoing Projects" teasers. Falls back to a static photo.
     */
    public static function ongoingCoverUrl(): string
    {
        static $url;

        return $url ??= ($img = static::where('status', 'ongoing')
            ->whereNotNull('card_img')
            ->where('card_img', '!=', '')
            ->latest('id')
            ->value('card_img'))
            ? asset('storage/' . $img)
            : asset('images/optimized/lulu-960.webp');
    }
}