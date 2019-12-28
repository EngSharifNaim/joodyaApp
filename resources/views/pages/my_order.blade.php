@extends("app")

@section('head_title', 'طلباتي' .' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
 
<div class="sub-banner" style="background:url({{ URL::asset('upload/'.getcong('page_bg_image')) }}) no-repeat center top;">
    <div class="overlay">
      <div class="container">
        <h1>طلباتي</h1>
      </div>
    </div>
  </div>
 
 <div class="white_for_login">
    <div class="container margin_60">
      <div class="col-md-offset-2 col-md-9">                
        <div class="box_style_2">
      <h2 class="inner">قائمة الطلبات</h2>
      <table class="table table-striped nomargin">
      <tbody>
        <tr>
        <th>التاريخ</th>
        <th>الإجمالي</th>
        <th>المحتويات</th>

        </tr>


        @foreach($order_list as $i => $order_item)
            <tr>
                <td>{{ $order_item->created_at->format('Y-m-d') }}</td>

                <td>
                <td>
                <ul>
                @foreach($order_item->items as $i => $item)
                 <li>{{ $item->item_name  . '  -  الحجم : {'  . $item->item_size .' } '     }}  
                 
                 @if( $item->features)
                    {{ 'الإضافات : { '}}
                      foreach (json_decode( $item->features, true) as $feature){
                            {{ ' { '.$feature->name.' - '.$feature->price.' - ' }}{{getcong('currency_symbol').' } - '}}  
                      }
                      {{ ' } '}}

                @endif

                 {{  ' الحالة : ' .'  { '.$item->status.' }' }}
                 
                  </li>




                @endforeach
                </ul>
                </td>


            


              <!--  <td> <a class="btn" href="{{ url('order/view/'.$order_item->id) }}" ><i class="fa fa-search"></i></a></td>  -->
            </tr>
           @endforeach
             



        
         
      </tbody>
      </table>
      <br>
    </div>

      </div>
    </div>
  </div>

@endsection
