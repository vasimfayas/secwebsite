<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Support\RichText;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public const STATUS_ONGOING = 'ongoing';
    public const STATUS_DELIVERED = 'completed';

    /**
     * "Ongoing" is a yes/no flag on every project (stored in the `status` column),
     * independent of the project's category.
     */
    protected function isOngoing(): Attribute
    {
        return Attribute::get(fn () => $this->status === self::STATUS_ONGOING);
    }

    public function scopeOngoing(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ONGOING);
    }

    public function scopeDelivered(Builder $query): Builder
    {
        return $query->where('status', '!=', self::STATUS_ONGOING);
    }

    /**
     * Filter by the public "status" filter value: 'ongoing', 'delivered' or null (all).
     */
    public function scopeWithPublicStatus(Builder $query, ?string $status): Builder
    {
        return match ($status) {
            'ongoing' => $query->ongoing(),
            'delivered' => $query->delivered(),
            default => $query,
        };
    }

    /** Admin-defined display order first (lower = earlier), newest after that. */
    public function scopeDisplayOrder(Builder $query): Builder
    {
        return $query->orderByRaw('sequence IS NULL, sequence')->latest('id');
    }

    /**
     * Description as safe HTML (formatted text from the admin editor, or legacy plain text with line breaks).
     */
    protected function descriptionHtml(): Attribute
    {
        return Attribute::get(fn () => RichText::toHtml($this->description));
    }

    /**
     * Description as plain text, for excerpts on cards.
     */
    protected function descriptionText(): Attribute
    {
        return Attribute::get(fn () => RichText::toText($this->description));
    }

    /**
     * Public URL of the card image of the latest ongoing project, used as the
     * cover for "Ongoing Projects" teasers. Falls back to a static photo.
     */
    public static function ongoingCoverUrl(): string
    {
        static $url;

        return $url ??= ($img = static::ongoing()
            ->whereNotNull('card_img')
            ->where('card_img', '!=', '')
            ->latest('id')
            ->value('card_img'))
            ? asset('storage/' . $img)
            : asset('images/optimized/lulu-960.webp');
    }
}