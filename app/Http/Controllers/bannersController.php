<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Http\Requests\BannerRequest;
use App\Photo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class bannersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['showBanner','search']]);
        Carbon::setLocale('fa');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(BannerRequest $request)
    {
        $banner = Banner::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'city' => $request->city,
            'location' => $request->location,

            'type' => $request->type,
            'price_type' => $request->price,
            'price' => $request->fixedprice,
        ]);
        return view('banners.photo_upload', compact('banner'));
    }

    public function update(BannerRequest $request, $id)
    {
        $banner = Banner::find($id);
        $banner->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'city' => $request->city,
            'location' => $request->location,

            'type' => $request->type,
            'status' => 0,
            'price_type' => $request->price,
            'price' => $request->fixedprice,
        ]);
        return redirect()->route('banners.mybanners');
    }

    public function show()
    {
        $banners = Banner::with('photos')->where(['user_id' => auth()->user()->id])->get();
        return view('banners.mybanners', compact('banners'));
    }

    public function showBanner($city, $id, $title)
    {
        $banner = Banner::find($id);
        $same_banners = Banner::with('photos')->where(['category_id' => $banner->category_id,'status' => 1])->take(16)->get();
        $user = User::find($banner->user_id);
        return view('banners.show', compact('banner', 'user','same_banners'));
    }

    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())->move($file);
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banners.edit',compact('banner'));
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (count($banner->photos)>0){
            foreach ($banner->photos as $photo) {
                Photo::find($photo->id)->delete();
            }
        }
        $banner->delete();
        return redirect()->route('banners.mybanners');
    }

    public function mail($banner_id)
    {
        $banner = Banner::find($banner_id);
        $user = User::find($banner->user_id);
        $data = 'ایمیل از طرف مشتری';
        $email = Mail::send('emails.mail', ['data' => $data, 'banner' => $banner, 'user' => $user], function ($message) use ($data, $banner, $user) {
            $message->from($user->email, $data);
            $message->to($user->email)->subject($banner->title . "|" . 'سایت یونی سیل من ');
        });

        if ($email) {
            return "ایمیل با موفقیت ارسال شد.";
        }
        return "خطا در ارسال ایمیل لطفا تلاش کنید.";
    }

    public function unverifiedBanners()
    {
        $banners = Banner::where(['status' => 0])->with('photos')->get();
        return view('admin.banners.unverified', compact('banners'));
    }

    public function showBannerAdmin($city, $id, $title)
    {
        $banner = Banner::find($id);
        $user = User::find($banner->user_id);
        return view('admin.banners.show', compact('banner', 'user'));
    }

    public function verified($id)
    {
        $banner = Banner::find($id);
        $banner->status = 1;
        $banner->save();
        return back();
    }

    public function unverified($banner_id,$reason_id)
    {
        $banner = Banner::find($banner_id);
        $banner->status = 2;
        $banner->reason_reject = $reason_id;
        $banner->save();
        return back();
    }

    public function userBanner($city, $id, $title)
    {
        $banner = Banner::find($id);
        $user = User::find($banner->user_id);
        return view('banners.user_banner', compact('banner', 'user'));
    }

    public function getForm(Request $request)
    {
        if ($request->ajax()) {
            $category_id = $request->id;
            $parent = explode('_',$category_id)[0];
            switch ($parent){
                case 'k':
                    return response(view('banners.forms.first', compact('category_id')));
                break;
                case 'kh':
                    return response(view('banners.forms.first', compact('category_id')));
                    break;
                case 'es':
                    return response(view('banners.forms.first', compact('category_id')));
                    break;
                case 'el':
                    return response(view('banners.forms.first', compact('category_id')));
                    break;
                case 'm':
                    return response(view('banners.forms.first', compact('category_id')));
                    break;
                case 's':
                    return response(view('banners.forms.first', compact('category_id')));
                case 'am':
                    return response(view('banners.forms.first', compact('category_id')));
            }
        }
    }


    public function bannersData($search,$province,$category)
    {
        if ($province == '' && $category != ''){
            $banners = Banner::where(function ($query) use ($search,$province,$category) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('city', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            })
                ->where('category_id', $category)
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')->get();
        }elseif ($province != '' && $category == ''){
            $banners = Banner::where(function ($query) use ($search,$province,$category) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('city', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            })
                ->where('city', 'LIKE', '%' . $province . '%')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')->get();
        }elseif ($province == '' && $category == ''){
            $banners = Banner::where(function ($query) use ($search,$province,$category) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('city', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            })
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')->get();
        }else{
            $banners = Banner::where(function ($query) use ($search,$province,$category) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('city', 'LIKE', '%' . $search . '%')
                    ->orWhere('location', 'LIKE', '%' . $search . '%');
            })
                ->where('status', 1)
                ->where('city', 'LIKE', '%' . $province . '%')
                ->where('category_id', $category)
                ->orderBy('created_at', 'DESC')->get();
        }

        return $banners;
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->search;
            $province = $request->province;
            $category = $request->category;
            $banners = $this->bannersData($search,$province,$category);
            return response(view('banners.getSearchList', compact('banners', 'search'))->render());
        }
    }

    public function getCategory(Request $request)
    {
        if ($request->ajax()){
            return response()->json(categories(), 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function getCity(Request $request)
    {
        $cities = [0=>provinces(),1=>cities()];
        if ($request->ajax()){
            return response()->json($cities, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
}
