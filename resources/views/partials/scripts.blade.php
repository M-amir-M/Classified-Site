<script>
    var categories;
    var provinces;
    var cities;
    var baseUrl = 'http://localhost:8000'

    //فرستادن ای دی آگهی رد شونده به مدال
    $(document).ready(function () {
        $('body').on("click", ".modal-reject-btn", function () {
            var bannerid = $(this).data('bannerid');
            $("#reason-id-input").val(bannerid);
        });
    });

    $(document).ready(function () {
        $('body').on("click", "#modal-reject .list-group-item", function () {
            var index = $(this).data('index');
            var bannerid = $('#reason-id-input').val();
            window.location.href = '/banners/unverified/' + bannerid + "/" + index;
        });
    });


    // گرفتن دسته ها و شهرها
    $(document).ready(function () {
        $.ajax({
            url: '{{ url('/categories/getCategory') }}',
            type: 'get',
            data: {},
            success: function (data) {
                categories = data;
            }
        });
        $.ajax({
            url: '{{ url('/banners/getCity') }}',
            type: 'get',
            data: {},
            success: function (data) {
                provinces = data[0]
                cities = data[1];
            }
        });
    });


    function showCat($obj) {
        var list = '';
        for (var index in $obj) {
            if (typeof $obj[index] === 'object') {
                var child = JSON.stringify($obj[index]);
                list = list + "<button data-label='" + index + "' data-child='" + child + "' class='list-group-item' > <span class='fa fa-chevron-left pull-left'></span>" + index + "</button>";
            } else {
                list = list + "<button data-dismiss='modal' data-label='" + index + "' data-child='" + $obj[index] + "' class='list-group-item' > " + index + "</button>";
            }
        }
        $('#modal-cat .list-group').html(list);
    }


    function showCity($obj) {
        var list = '';
        for (var index in $obj) {
            list = list + "<button data-label='' data-name='" + $obj[index] + "' data-child='" + index + "' class='list-group-item' > <span class='fa fa-chevron-left pull-left'></span>" + $obj[index] + "</button>";
        }
        $('#modal-city .list-group').html(list);
    }

    //برگرداندن دسته های مادر وقتی روی دسته ها در قسمت ساخت اگهی کلیک میشود
    $(document).ready(function () {
        $('body').on('click', '#btn-category', function () {
            showCat(categories);
        });

    });

    //برگرداندن استان وقتی روی شهرها در قسمت ساخت اگهی کلیک میشود
    $(document).ready(function () {
        $('body').on('click', '#btn-city', function () {
            showCity(provinces);
        });

    });

    // گرفتن لیست دسته ها و زیر دسته ها به صورت ایجکس
    $(document).ready(function () {
        $('body').on('click', '#modal-cat .list-group-item', function () {
            var child = $(this).data('child');
            var label = $(this).data('label');
            if (typeof child != 'object') {
                $("#btn-category").html(label);
                //گرفتن فرم مورد نظر
                $.ajax({
                    url: '{{ url('/banners/banner-form/get') }}',
                    type: 'get',
                    data: {'id': child},
                    success: function (data) {
                        $('#banner-form').html(data);
                    }
                });
            }
            showCat(child);
        });
    });

    // گرفتن لیست شهرها ها
    $(document).ready(function () {
        $('body').on('click', '#modal-city .list-group-item', function () {
            var label = $(this).data('label');
            var child = $(this).data('child');
            var name = $(this).data('name');
            var city;
            if (child != "") {
                for (var index in cities) {
                    if (index == child) {
                        city = cities[index];
                    }
                }
                var list = '';
                for (var index in city) {
                    list = list + "<button data-dismiss='modal' data-child='' data-label='" + name + "," + city[index] + "' class='list-group-item' >" + city[index] + "</button>";
                }
                $('#modal-city .list-group').html(list);
            } else {
                $('#btn-city').html(label);
                $('#city_id').val(label);
            }

        });
    });

    //آپلود عکس
    Dropzone.options.addPhotoForm = {
        paramName: 'photo',
        maxFilesize: 2,
        dictDefaultMessage: "عکسی برای آگهی خود انتخاب کنید.حداکثر 4 عکس می توانید انتخاب کنید.",
        dictFileTooBig:"حجم عکس زیاد است",
        maxFiles: 4,
        acceptedFiles: '.jpg,.jpeg',
        success: function (file, response) {
            if(file.status = "success"){
                handleDropzoneFileUpload.handleSuccess(response);

            }
            else {
                handleDropzoneFileUpload.handleError(response);
            }
        },
        complete: function(file) {
            if (file.size > 2*1024*1024) {
                alert("حجم عکس بیشتر از 2 مگابایت است.");
                return false;
            }
        },
        init: function () {
            this.on("maxfilesexceeded", function (file) {
                swal({
                    title: "اُخ!!",
                    text: "فقط 4 عکس می توانید انتخاب کنید",
                    type: "error",
                    confirmButtonText: "باشه"
                });
            });
        }
    }

    var handleDropzoneFileUpload = {
        handleError : function (response) {
            console.log(response);
        },
        handleSuccess : function (response) {
            var imageList = $('#image-gollery');
            var imageUrl = baseUrl+"/"+response.thumbnail_path;
            imageList.append('<div class="col-md-3 gallery-image"><button type="submit" class="btn btn-sm btn-danger label">&times;</button><a href="'+baseUrl+"/"+response.path+'" ><img src="'+imageUrl+'" alt=""></a></div>');
        }
    }


    //فرم فرستادن ایمیل بیننده نیازمندی به صاحب آگهی
    $(document).on("click", ".send-email", function () {
        var action = $(this).data('action');
        var title = $(this).data('title');
        $(".modal-header #send-email-title").html(title);
        $(".modal-body #send-email-form").attr('action', action);
    });


    //فرستادن ای دی آگهی رد شونده به مدال
    $(document).ready(function () {
        $('body').on("click", ".modal-reject-btn", function () {
            var bannerid = $(this).data('bannerid');
            $("#reason-id-input").val(bannerid);
        });
    });


    $(document).ready(function () {
        $('body').on("click", "#modal-reject .list-group-item", function () {
            var index = $(this).data('index');
            var bannerid = $('#reason-id-input').val();
            window.location.href = '/banners/unverified/' + bannerid + "/" + index;
        });
    });

    //داشبورد
    $(document).ready(function () {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });

    //نمایش اینپوت قیمت در حالت قیمت مقطوع و پنهان کردن
    $(document).ready(function () {
        $('body').on('change', '#price', function () {
            var id = $(this).find("option:selected").attr("id");
            switch (id) {
                case "fixed-price":
                    $("#fixedprice").toggleClass('hide');
                    break;
                case "free-price":
                    $("#fixedprice").addClass('hide');
                    break;
                case "adptive-price":
                    $("#fixedprice").addClass('hide');
                    break;
            }
        });
    });


    //اسلایدر آگهی های مشابه در پایین صفحه نمایش آگهی
    $(document).ready(function () {
        $('#sameAgahiCarousel').carousel({
            interval: 6000
        })
    });




    $('.selectpicker').selectpicker({
        style: 'btn-success',
        size: 4,
        mobile: true
    });





</script>