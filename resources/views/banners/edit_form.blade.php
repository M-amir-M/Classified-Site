{{ csrf_field() }}
{{ method_field('PATCH') }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group  label-floating">
            <label for="city" class="control-label">شهر</label>
            <div class="form-group  label-floating">
                <a class="btn btn-primary btn-block" id="btn-city" data-toggle="modal" href="#modal-city">شهر</a>
                <input type="hidden" id="city_id" name="city" value="">
            </div>
        </div>

        <div class="form-group label-floating">
            <label for="location" class="control-label">محله</label>
            <input type="text" class="form-control" name="location" id="location" value="{{ $banner->location }}">
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group  label-floating">
            <a class="btn btn-primary btn-block" id="btn-category" data-toggle="modal" href="#modal-cat">دسته</a>
        </div>
        <div class="form-group label-floating">
            <label for="title" class="control-label">عنوان</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $banner->title }}">
        </div>

        <div id="banner-form">

        </div>

        <div class="form-group  label-floating">
            <label for="description" class="control-label">توضیحات</label>
                <textarea name="description" id="description" class="form-control"
                          rows="5">{{ $banner->description }}</textarea>
        </div>


    </div>
</div>

<div class="row">
    <div class="col-md-12">

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">بعدی</button>
        </div>
    </div>
</div>
