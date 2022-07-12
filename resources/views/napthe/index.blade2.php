@extends('master')
@section('title')
    Nạp Thẻ
@endsection
@section('content')
    <div class="row">
           
        <div class="col-md-4">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            <h6>Nạp thẻ cào</h6>
            <br>
           
            <form action="{{ route('nap-card') }}" method="post" >
                    @csrf
                    <input name="user_id" type="hidden" value=" {{ Auth::user()->id}}">
                    <input name="user_phone" type="hidden" value=" {{ Auth::user()->phone_number}}">
                    <input type="hidden" name="nap_the" value="1">
                <div class="form-group">
                  <label for="formGroupExampleInput">Loại Thẻ</label>
                    <select name="card_type" class="form-control" id="card_type" onchange="cardDiscount(this)"  required>
                        @foreach($result as $key)
                            <option  value="{{ $key->card_code }}">{{ $key->card_name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Mã Pin</label>
                  <input required type="number" class="form-control" name="card_pin" id="" placeholder="Mã Pin">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Mã Seria</label>
                  <input required type="number" class="form-control"name="card_seria" id="" placeholder="Mã Seria">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Mệnh giá</label>
                  <select required class="form-control" name="card_price">
                    <option value="10000">10.000&nbsp;₫</option>
                    <option value="20000">20.000&nbsp;₫</option>
                    <option value="30000">30.000&nbsp;₫</option>
                    <option value="50000">50.000&nbsp;₫</option>
                    <option value="100000">100.000&nbsp;₫</option>
                    <option value="200000">200.000&nbsp;₫</option>
                    <option value="300000">300.000&nbsp;₫</option>
                    <option value="500000">500.000&nbsp;₫</option>
                    <option value="1000000">1.000.000&nbsp;₫</option>
                 </select>
                </div>
                <button type="submit" class="btn-sm btn btn-primary">Nạp thẻ</button>
              </form>
              <br>
        </div>
        <div class="col-md-4">
            <h6>Nạp qua ảnh</h6>
                        <br>
                        <form action="{{ route('nap-card') }}" method="post"enctype="multipart/form-data" >
                                @csrf
                                <input name="user_id" type="hidden" value=" {{ Auth::user()->id}}">
                                <input name="user_phone" type="hidden" value=" {{ Auth::user()->phone_number}}">
                                <input type="hidden" name="nap_the" value="2">
                            <div class="form-group">
                              <label for="formGroupExampleInput">Loại Thẻ</label>
                                <select name="card_type" class="form-control" id="card_type" onchange="cardDiscount(this)"  required>
                                    @foreach($result as $key)
                                        <option  value="{{ $key->card_code }}">{{ $key->card_name }}</option>
                                    @endforeach
                                </select>
            
                            </div>
                           
                            <div class="form-group">
                              <label for="">Upload Ảnh</label>
                              <input required type="file" class="form-control"name="img" id="img" placeholder="Mã Seria">
                            </div>
                            <div class="form-group">
                              <label for="formGroupExampleInput2">Mệnh giá</label>
                              <select required class="form-control" name="card_price">
                                <option value="10000">10.000&nbsp;₫</option>
                                <option value="20000">20.000&nbsp;₫</option>
                                <option value="30000">30.000&nbsp;₫</option>
                                <option value="50000">50.000&nbsp;₫</option>
                                <option value="100000">100.000&nbsp;₫</option>
                                <option value="200000">200.000&nbsp;₫</option>
                                <option value="300000">300.000&nbsp;₫</option>
                                <option value="500000">500.000&nbsp;₫</option>
                                <option value="1000000">1.000.000&nbsp;₫</option>
                             </select>
                            </div>
                            <p>
                                    Vui lòng cào lớp bạc và chụp đầy đủ ảnh bao gồm <strong>số Seri</strong> và <strong>mã thẻ</strong>.
                            </p>
                            <button type="submit" class="btn-sm btn btn-primary">Nạp thẻ</button>
                          </form>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default panel-table">
                <h4>Phí đổi thẻ</h4>
                 <div class="panel-body">
                    <table class="table table-striped table-borderless">
                       <thead>
                          <tr>
                             <th>TT</th>
                             <th>Nhà mạng</th>
                             <th class="number">Mua 100K giảm</th>
                             <th class="number">Trạng thái</th>
                          </tr>
                       </thead>
                       <tbody class="no-border-x">
                         @foreach ($card as $value)
                            <tr>
                                <td>{{ $value->cat_id }}</td>
                                <td>{{ $value->card_name }}</td>
                                <td class="number">{{ $value->card_discount }}000 vnđ</td>
                                <td class="number">
                                  @if($value->card_status == 1)
                                    <span class="label label-success">Hoạt động</span>
                                  @else 
                                    <span class="label label-warning">Bảo trì</span>
                                  @endif
                                </td>
                            </tr>
                         @endforeach
                         
                       </tbody>
                    </table>
                 </div>
              </div>
        </div>
    </div>
          <div class="row" >
            <div class="col-md-12">
              <h6>Danh sách thẻ chờ duyệt </h6>
				<div class="table-responsive">
                 <table class="table table-sm" style="margin-bottom:3em"id="lichsu">
                    <thead>
                        <tr>
                            <th>Loại Thẻ</th>
                            <th>Mã Pin</th>
                            <th>Mã Seria</th>
                            <th>Mệnh giá</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hsitory as $item)
                        <form action="{{ route('delete-card') }}" method="GET">
                            <input type="hidden" value="{{ $item->payment_id }}" name="id" id="id">
                            <tr>
                                    <td>{{ $item->card_name }}</td>
                                    <td>{{ $item->pin }}</td>
                                    <td>{{ $item->serial }}</td>
                                    <td>{{ number_format($item->price) }} đ</td>
                                    <td> <span class="btn btn-sm btn-primary">Chờ duyệt</span></td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-danger">Hủy</button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach        
                        
                    </tbody>
                </table>
				</div>    
            <br>
             </div>      
        </div>    
       
    <script>
        function cardDiscount(selected){
            var a = selected.value;
        }
    </script>
@endsection