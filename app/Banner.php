<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'city',
        'location',
        'status',
        'type',
        'price_type',
        'price',
    ];

    protected $appends = ['diff_date', 'price_format', 'title_format', 'cat_format','phone'];

    public function diff_date()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    //Accessor
    public function getDiffDateAttribute()
    {
        return $this->diff_date();
    }

    public function price_format()
    {
        if ($this->price_type == 1) {
            return $this->price . ' تومان ';
        } elseif ($this->price_type == 2) {
            return 'رایگان';
        } elseif ($this->price_type == 3) {
            return 'توافقی';
        }
    }

    public function getPriceFormatAttribute()
    {
        return $this->price_format();
    }

    public function title_format()
    {
        $array = explode(' ', $this->title);
        return implode('-', $array);
    }

    public function getTitleFormatAttribute()
    {
        return $this->title_format();
    }

    public function phone()
    {
        $user = User::find($this->user_id);
        return $user->phone;
    }

    public function getPhoneAttribute()
    {
        return $this->phone();
    }

    public function cat_format()
    {
        $cat = '';
        if(array_key_exists($this->category_id,categoriesKey())){
            $cat = categoriesKey()[$this->category_id];
        }
        return $cat;
    }

    public function getCatFormatAttribute()
    {
        return $this->cat_format();
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    //Scope
    public static function LocatedAt($city, $id, $title)
    {
        $title = str_replace(' ', '-', $title);
        return static::where(['id' => $id, 'city' => $city, 'title' => $title])->first();
    }


    public function getDescriptionAttribute($description)
    {
        return nl2br($description);
    }

    public function addPhoto(Photo $photo)
    {
        $this->photos()->save($photo);
    }

    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }


}
