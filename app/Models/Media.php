<?php

namespace App\Models;

use Elegantly\Media\Models\Media as BaseMedia;
use Kra8\Snowflake\HasShortflakePrimary;
use App\Traits\Tenantable;
use Illuminate\Support\Str;


class Media extends BaseMedia
{
    use HasShortflakePrimary, Tenantable;
 
    public function makeFreshPath(
        ?string $conversion = null,
        ?string $fileName = null
    ): string {
        /** @var string $prefix */
        // $prefix = config('media.generated_path_prefix') ?? '';
        $prefix = 'media/'.tenant('hashId').'/';

        $root = Str::of($prefix)
            ->when($prefix, fn ($string) => $string->finish('/'))
            ->append($this->collection_name.'/')
            ->append($this->uuid)
            ->finish('/');

        if ($conversion) {
            return $root
                ->append('conversions/')
                ->append(str_replace('.', '/conversions/', $conversion))
                ->finish('/')
                ->append($fileName ?? '')
                ->value();
        }

        return $root->append($fileName ?? '')->value();
    }
}
