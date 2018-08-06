<input type="hidden" value="{{ $category_id }}" name="category_id">

<div class="form-group  label-floating">
    <label for="price" class="control-label">قیمت</label>
    <select id="price" name="price" class="form-control">{{ old('city') }}
        <option id="fixed-price" value="1">مقطوع(به تومان)</option><!-- fixed == 1-->
        <option id="free-price" value="2">رایگان</option><!-- free == 2-->
        <option id="adptive-price" value="3">توافقی</option><!-- Adaptive == 3-->
    </select>
</div>

<div class="form-group label-floating" id="fixedprice">
    <label for="fixedprice" class="control-label">قیمت</label>
    <input type="number" placeholder="5,000 تومان" class="form-control" name="fixedprice" value="{{ old('price') }}">
</div>

<div class="form-gruop">نوع
    <div class="radio">
        <label>
            <input name="type"
                   checked="true"
                   type="radio"
                   value="1"
            >فروشی
            <span class="circle"></span>
            <span class="check"></span>
        </label>
    </div>
    <div class="radio">
        <label>
            <input name="type"
                   type="radio"
                   value="2"
            >
            <span class="circle"></span>
            <span class="check"></span>درخواستی
        </label>
    </div>
</div>