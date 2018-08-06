<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Http\Requests\ChangeBannerRequest;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class photosController extends Controller
{
    public function store($banner_id,ChangeBannerRequest $request){
        $banner = Banner::with('photos')->find($banner_id);
        if (count($banner->photos)>3){
            return flash('خطا','بیشتر از 4 عکس برای آگهی مجاز نمی باشد.');
        }
        $image = $request->file('photo');
        $make_unique = str_random(5);
        $img_path = 'images/photos/'.sha1($image->getClientOriginalName())."-".$make_unique.".".$image->getClientOriginalExtension();
        $thumbnail_path = 'images/photos/tn-'.sha1($image->getClientOriginalName())."-".$make_unique.".".$image->getClientOriginalExtension();
        
        $img = Image::make($image->getRealPath());
        $img->resize(400,400)->save($thumbnail_path);
        $img->resize(2000,2000)->save($img_path);

        $photo = Photo::fromFile($image,$make_unique);
        Banner::find($banner_id)->addPhoto($photo);
        return $photo;
    }

    public function destroy($id)
    {
        Photo::findOrFail($id)->delete();

        return back();
    }
}
