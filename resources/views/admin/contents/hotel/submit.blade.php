@extends('admin.layouts.dashboard')
@section('title')
    Thêm mới khách sạn
@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                </div>
                <!-- Card stats -->
                <span class="mask bg-gradient-default opacity-8"></span>
                <!-- Header container -->
                <div class="container-fluid d-flex align-items-center">
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Thêm mới khách sạn </h3>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('admin.hotel.store') }}" method="post">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Thông tin</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="country_id">Quốc gia</label><br>
                                            <select id="country" name="country" class="selectpicker"
                                                    data-style="btn-neutral"
                                                    data-live-search="true">
                                                <option value="" selected disabled>Quốc gia</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="province_id">Tỉnh/Thành
                                                phố</label><br>
                                            <select id="province" name="province" class="selectpicker"
                                                    data-style="btn-neutral"
                                                    data-live-search="true">
                                                <option value="" selected disabled>Tỉnh/Thành phố</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="category_id">Loại chỗ
                                                nghỉ</label><br>
                                            <select id="category_id" name="category_id" class="selectpicker"
                                                    data-style="btn-neutral"
                                                    data-live-search="true">
                                                <option>Tom Foolery</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_name">Tên khách sạn</label>
                                            <input type="text" id="hotel_name" name="hotel_name" class="form-control"
                                                   placeholder="Hotel name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_phone">Điện thoại</label>
                                            <input type="text" id="hotel_phone" name="hotel_phone" class="form-control"
                                                   placeholder="Phone" pattern="09|03|07|08|05)+([0-9]{8}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_email">Email</label>
                                            <input type="text" id="hotel_email" name="hotel_email" class="form-control"
                                                   placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_website">Website</label>
                                            <input type="text" id="hotel_website" name="hotel_website"
                                                   class="form-control" placeholder="Website"
                                                   pattern="09|03|07|08|05)+([0-9]{8}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_image">Ảnh</label>
                                            <input id="hotel_image" name="hotel_image" class="form-control"
                                                   placeholder="Address" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="description">Mô tả</label>
                                            <input id="description" name="description" class="form-control"
                                                   placeholder="Description" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-offset-2">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('#country').change(function () {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.hotel.list_provinces')}}?country_id=" + country_id,
                    success: function (res) {
                        if (res) {
                            $('#province').html('');
                            $('#province').append('<option value="" selected disabled>Tỉnh/Thành phố</option>');
                            $.each(res, function (key, value) {
                                console.log(value.province_name);
                                $('#province').append('<option value="' + value.id + '">' + value.province_name + '</option>');
                            });

                        } else {
                            $('#province').html('');
                        }
                    }
                });
            } else {
                $('#province').html('');
                $('#city').html('');
            }
        });
    </script>
@endsection
