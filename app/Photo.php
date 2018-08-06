<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'banner_photos';
    protected $fillable = ['name', 'path', 'thumbnail_path'];
    protected $file;

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public static function fromFile(UploadedFile $file,$make_unique)
    {
        $photo = new static;

        $photo->file = $file;

        $photo->fill([
            'name' => $photo->fileName($make_unique),
            'path' => $photo->filePath($make_unique),
            'thumbnail_path' => $photo->thumbnailPath($make_unique)
        ]);

        return $photo;
    }

    public function fileName($make_unique)
    {
        $name = sha1($this->file->getClientOriginalName());

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}-{$make_unique}.{$extension}";
    }

    public function filePath($make_unique)
    {
        return $this->baseDir() . '/' . $this->fileName($make_unique);
    }

    public function thumbnailPath($make_unique)
    {
        return $this->baseDir() . '/tn-' . $this->fileName($make_unique);

    }

    public function baseDir()
    {
        return 'images/photos';
    }
    
    public function delete()
    {
        parent::delete();


        File::delete([
            $this->path,
            $this->thumbnail_path
        ]);
    }

    public static function firstPhoto($banner_id)
    {
        $banner = Banner::find($banner_id)->photos->first()->path;
        return $banner;
    }
}
