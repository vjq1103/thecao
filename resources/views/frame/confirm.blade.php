<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử nạp thẻ</title>
    <!-- Bootstrap core CSS-->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body style="background:#efeded;flex:1;display:flex;f">
       <div class="container" style="width:600px; height: 350px; border:1px solid #eee;background:#fff;padding-left:5%;padding-right: 5%">
            <div class="row">
                    <div class="col-md-12 col-xs-12" style="margin:0 auto;padding:0;width:100%;text-align:center" >
                        <br>
                        <h4 class="text-center">Thông tin nạp thẻ</h4>
                        <p class="text-success">{{ $mess }}</p>
                        <p class="text-danger">Nhập vào số điện thoại, bạn vừa nhập ở phần nạp tiền, để kiểm tra trạng thái thẻ nạp</p>
                            <input type="hidden" value="{{ $link_id }}" name="link_id" id="link_id">
                            <input type="number" name="phone_number" id="phone_number" placeholder="Nhập vào số điện thoại" required>
                            <button type="button"  onclick="search()" class="btn-primary">Search</button>
                    </div>
            </div>
            <br>
            <section id="tabs">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-xs-12 ">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Kết quả</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Lịch sử</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">DS Thẻ</a>
                                    <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Thông tin</a>
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <p class="text-center"  id="ketqua"></p>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <span class="text-left" id="log_title"></span>
                                    <span class="text-left" id="log_content"></span>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                                </div>
                                <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </section>
       
       <button onclick="goBack()" class="btn btn-sm btn-primary">Quay lại</button>

       </div>

</body>
<script>
    function goBack() {
        window.history.back();
    }
    function search()
    {
        var phone_number = document.getElementById('phone_number').value;
        var link_id = document.getElementById('link_id').value;
        $.ajax({
            url: "{{ route('api.search') }}",
            type: "get",
            data:{
                'phone_number':phone_number, 
                'link_id':link_id
            },
            dataType: "text",
            success: function(result) {
                var mess = "";
                var log_title = "";
                var log_content = "";
                var JSONObject  = JSON.parse(result)
                  var dataResult  = JSONObject.data;
                Object.keys(dataResult).forEach(function(key) {
                   mess = dataResult.mess;
                   $('#ketqua').html("").html(mess)
                   for (var i  in dataResult.log) {
                        console.log(dataResult.log.title);
                        log_title = dataResult.log.title;
                        log_content = dataResult.log.content;
                        $('#log_title').html("").html(log_title);
                        $('#log_content').html("").html(log_content);

                    }
                 
                })
               
                
            }
        });
      
       
    }
</script>
</html>