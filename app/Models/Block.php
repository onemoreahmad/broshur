<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Elegantly\Media\Concerns\HasMedia;
use Elegantly\Media\Contracts\InteractWithMedia;
use Elegantly\Media\MediaCollection;
use App\Traits\Tenantable;
 
class Block extends Model implements InteractWithMedia
{
    use HasShortflakePrimary, HasMedia, Tenantable;
 
    protected $casts = [
        'config' => SchemalessAttributes::class,
        'active' => 'boolean',
    ];
     
    protected $guarded = false;
     
    public function registerMediaCollections(): array
    {
        return [
            new MediaCollection(
                name: 'block-editor-images',
                single: false, // If true, only the latest file will be kept
                acceptedMimeTypes: [ // (optional) Specify accepted file types
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    'image/svg+xml',
                    'image/tiff',
                    'image/webp',
                    'image/avif',
                    'image/heic',
                    'image/heif',
                    'image/webp'
                ]
            )
        ];
    }
 
}
