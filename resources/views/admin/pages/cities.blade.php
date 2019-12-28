@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">


            <h2>المدن</h2>
        </div>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>الاسم</th>

                        <th class="text-center width-100">أدوات</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($cities as $i => $city)
                        <tr>
                           <td>{{$city->id}}</td>
                           <td>{{$city->name}}</td>
                           <td><a href="deleteCity/ {{$city->id}}" class="btn btn-danger">حذف</a> </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <hr>
                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>الاسم</th>
                        <th>المدينة</th>

                        <th class="text-center width-100">أدوات</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($areas as $i => $area)
                        <tr>
                            <td>{{$area->id}}</td>
                            <td>{{$area->name}}</td>
                            <td>{{$area->city_id}}</td>
                            <td><a href="{{url('deleteArea/' . $area->id)}}" class="btn btn-danger">حذف</a> </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
            <div class="container">
                <form method="post" action="addCity">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col col-md-10">
                            <input type="text" class="form-control" name="name" id="name_id" placeholder="اسم المدينة">
                        </div>
                        <div class="col col-md-2">
                            <button type="submit" class="btn btn-success" name="sub_button" value="city">اضافة مدينة</button>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col col-md-5">
                            <input type="text" class="form-control" name="areaName" id="areaName_id" placeholder="اسم المنطقة">
                        </div>
                        <div class="col col-md-5">
                            <select name="city" class="form-control">
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col col-md-2">
                            <button type="submit" class="btn btn-success" name="sub_button" value="area">اضافة منطقة</button>
                        </div>
                    </div>


                </form>
            </div>
            <hr>
            <div class="clearfix"></div>
        </div>

    </div>

@endsection
