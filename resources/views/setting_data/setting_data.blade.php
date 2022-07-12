@if(isset($settingData))
    <div class="">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">TK</th>
                <th scope="col">STK</th>
                <th scope="col">STK2</th>
            </tr>
            </thead>
            <tbody>
            @foreach($settingData as $key => $value)
                <tr>
                    <th scope="row">{{++$key}}</th>
                    <td>{{$value->tigia}}</td>
                    <td>{{$value->usdt}}</td>
                    <td>{{$value->tentk}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$settingData->links()}}
@endif

@if(isset($settingData2))
    <div class="">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">TK</th>
                <th scope="col">STK</th>
                <th scope="col">STK2</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$settingData2->tigia}}</th>
                <td>{{$settingData2->usdt}}</td>
                <td>{{$settingData2->tentk}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif

