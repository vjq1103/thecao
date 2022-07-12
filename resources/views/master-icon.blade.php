<!DOCTYPE html>
<html lang="en">

  <head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>@yield('title') Đổi thẻ tự động - gạch thẻ nhanh - gạch thẻ động qua API Mã nhúng Embed</title>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128077888-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-128077888-1');
		</script>

    <!-- Bootstrap core CSS-->
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="https://doithe.pro/assets/img/favicon_32x32.png">
    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

	<!--SEO--><meta name="description" content="Cổng thanh toán trực tuyến 8pay.pro 8pay.vn webpay.vn smspay.vn doithecao247.vn doithe365.vn thecaosieure.com, thecaoplus.com | Cung cấp dịch vụ thanh toán online, tích hợp nạp thẻ, thu mua thẻ cào chiết khấu thấp nhất thị trường, Đổi Thẻ Cào Sang Tiền ATM | Uy Tín - Rút Tiền Nhanh - Đổi Thẻ Cào Thành Tiền Uy Tín | Rút Tiền Nhận Ngay 5-10p‎ - đổi thẻ cào thành tiền san the 247 doi the cao doithe247 nap 247 thu mua thẻ cào thecao247 banthe247 thecao247- doi the cao thanh tien mat, doi the cao, doi card, đổi thẻ điện thoại thành tiền, đổi thẻ điện thoại thành tiền mặt, đổi thẻ thành tiền mặt, đổi thẻ điện thoại, doi the cao thanh tien mat, đổi thẻ viettel , doi the dien thoai sang tien mat, đổi thẻ sang tiền mặt, đổi thẻ, đổi tiền điện thoại sang tiền mặt , đổi thẻ game, đổi thẻ điện thoại ra tiền mặt, đổi tiền từ thẻ điện thoại, đổi thẻ ra tiền mặt , đổi mã thẻ điện thoại ra tiền mặt, cách đổi thẻ điện thoại sang tiền mặt, hướng dẫn đổi thẻ điện thoại ra tiền mặt , đổi thẻ nhanh, đổi thẻ viettel sang tiền mặt, đổi thẻ cào thành tiền, đổi tiền từ thẻ điện thoại sang tiền mặt, cách đổi tiền điện thoại sang tiền mặt, đổi thẻ cào, đổi tiền từ tài khoản điện thoại, đổi thẻ cào thành tiền mặt">
	<meta name="keywords" content="doithe, doithe.vn, doithe.pro, 8pay.vn webpay.vn smspay.vn doithecao247.vn doithe365.vn thecaosieure.com, doi the cao, doi card thanh the game, doi the thanh tien, thu mua mã thẻ, thu mua ma the, doi the, đổi thẻ, charging nho">
	<meta property="og:title" content="Thu mua mã thẻ - Đổi thẻ - Thu mua thẻ cào trực tuyến. Cung cấp dịch vụ thanh toán online, thu mua thẻ cào chiết khấu thấp nhất thị trường.">
	<meta property="og:description" content="- Thu mua thẻ cào trực tuyến. Cung cấp dịch vụ thanh toán online, thu mua thẻ cào chiết khấu thấp nhất thị trường., đổi thẻ điện thoại thành tiền, đổi thẻ điện thoại thành tiền mặt , đổi thẻ thành tiền mặt, đổi thẻ điện thoại, doi the cao thanh tien mat, đổi thẻ viettel , doi the dien thoai sang tien mat, đổi thẻ sang tiền mặt, đổi thẻ, đổi tiền điện thoại sang tiền mặt , đổi thẻ game, đổi thẻ điện thoại ra tiền mặt, đổi tiền từ thẻ điện thoại, đổi thẻ ra tiền mặt , đổi mã thẻ điện thoại ra tiền mặt, cách đổi thẻ điện thoại sang tiền mặt, hướng dẫn đổi thẻ điện thoại ra tiền mặt , đổi thẻ nhanh, đổi thẻ viettel sang tiền mặt, đổi thẻ cào thành tiền, đổi tiền từ thẻ điện thoại sang tiền mặt , cách đổi tiền điện thoại sang tiền mặt, đổi thẻ cào, đổi tiền từ tài khoản điện thoại, đổi thẻ cào thành tiền mặt"> <meta property="og:keywords" content="doithe.vn, thu mua mã thẻ, thu mua ma the, doi the, đổi thẻ">





	<meta name="robots" content="index, follow" />
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

       <a class="navbar-brand mr-1" href="/">DOITHE</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-home"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">

        </div>
      </form>


<!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        @if(Auth::guest())
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="/register">
            Đăng Ký
          </a>
        </li>
		<li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="/login">

            Đăng Nhập
          </a>
        </li>

        @else
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name}}  
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('user.profle') }}">Thông tin tài khoản</a>
            <a class="dropdown-item" href="#">Số tiền:  {{ number_format(Auth::user()->money_1) }}  đ</a>
            <a class="dropdown-item" href="#">Tạm giữ:  {{ number_format(Auth::user()->tam_giu) }}  đ</a>
             
            <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">Đăng xuất</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
          </div>
        </li>
        @endif
      </ul>

    </nav>
    <div id="wrapper">

      <!-- Sidebar -->


      <ul class="sidebar navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="/">
            <i class="fas fa-fw fa-flag"></i>
            <span>Trang chủ</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('nap-the') }}">
              <i class="fas fa-fw fa-star-half-alt"></i>
              <span>Nạp Thẻ</span></a>
          </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('mua-the.index') }}">
              <i class="fas fa-fw fa-thumbs-up"></i>
              <span>Mua Thẻ</span></a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('nap-tien.index') }}">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Nạp tiền</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('nap-the.history-card') }}">
              <i class="fas fa-fw fa-award"></i>
              <span>Lịch sử</span></a>
          </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('rut-tien') }}">
            <i class="fas fa-fw fa-hashtag"></i>
            <span>Rút tiền</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('chuyen-tien.index') }}">
            <i class="fas fa-fw fa-heart"></i>
            <span>Chuyển tiền</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frame.index') }}">
            <i class="fas fa-fw fa-toggle-on"></i>
            <span>Mã nhúng API</span></a>
        </li>


        <li class="nav-item">
                <a class="nav-link" href="{{ route('mySearch') }}">
                  <i class="fas fa-fw fa-toggle-on"></i>
                  <span>Check thẻ xcoin</span></a>
              </li>


          @if(Auth::user() && Auth::user()->is_Admin > 0)
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>AdminCP</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              @if(Auth::user()->is_Admin == 2 || Auth::user()->is_Admin == 10  || Auth::user()->is_Admin == 8)
                <a class="dropdown-item" href="{{ route('admin.danh-sach-the-cao') }}">Danh sách thẻ nạp</a>
              @endif
              @if(Auth::user()->is_Admin == 3 || Auth::user()->is_Admin == 10 || Auth::user()->is_Admin == 8)
                <a class="dropdown-item" href="{{ route('admin.danh-sach-rut-tien') }}">Danh sách rút tiền</a>
                @endif
                @if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('admin.nap-tien') }}">Danh sách nạp tiền</a>
                @endif
                @if(Auth::user()->is_Admin == 5 || Auth::user()->is_Admin == 10 || Auth::user()->is_Admin == 8)
                <a class="dropdown-item" href="{{ route('admin.mua-the') }}">Danh sách mua thẻ</a>
                @endif

                @if(Auth::user()->is_Admin == 5 || Auth::user()->is_Admin == 10 || Auth::user()->is_Admin == 8)
                <a class="dropdown-item" href="{{ route('danh-sach-listmoneyrozen') }}">Tiền tạm giữ</a>
                @endif
                @if(Auth::user()->is_Admin == 5 || Auth::user()->is_Admin == 10 || Auth::user()->is_Admin == 8)
                <a class="dropdown-item" href="{{ route('danh-sach-listmoney') }}">Danh sách tiền</a>
                @endif


              </div>
            </li>

          @endif


			<!--- --->
			 @if(Auth::user() && Auth::user()->is_Admin > 0)
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>SAdmin</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">

                 @if(Auth::user()->is_Admin > 5)
                <a class="dropdown-item" href="{{ route('list-member') }}">List member</a>
                @endif
				@if(Auth::user()->is_Admin > 5)
                <a class="dropdown-item" href="{{ route('list-frame') }}">List Frame</a>
                @endif

				@if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('user.role') }}">User Manager</a>
                @endif
                @if(Auth::user()->is_Admin > 5)
                <a class="dropdown-item" href="{{ route('news.create') }}">Thêm tin tức</a>
                @endif


				@if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('danh-sach-log-payment') }}">List LogPayment</a>
                @endif

				@if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('danh-sach-log') }}">Danh sách Log</a>
                @endif


				@if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('danh-sach-adxs') }}">List Adxs</a>
                @endif

				@if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('danh-sach-tempuser') }}">User phone temp </a>
                @endif

				@if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('danh-sach-listmoney') }}">Tiền của thành viên </a>
                @endif

				@if(Auth::user()->is_Admin == 9 || Auth::user()->is_Admin == 10)
                <a class="dropdown-item" href="{{ route('danh-sach-listmoneyrozen') }}">Tiền tạm giữ user </a>
                @endif


              </div>
            </li>










          @endif

      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
           
          <!-- Breadcrumbs-->
          <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/">Trang Chủ</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
          </ol>-->


          <!-- Page Content -->

          <hr>
         @yield('content')

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
               <span style="font-size:18px;">  <a href="/" title="đổi thẻ cào thành tiền mặt uy tín đổi thẻ cào sang thẻ game gạch thẻ nhanh gạch thẻ viettel">Đổi thẻ tự động </a> <br/><br/></span>
<span>Cung cấp dịch vụ thanh toán online, tích hợp nạp thẻ, thu mua thẻ cào chiết khấu thấp nhất thị trường</span><style type="text/css">.thunho{background-color:#fff;color:#000;height:10px;overflow:auto;}</style>
<div class="thunho">Các bạn biết rằng, việc đổi thẻ cào trực tuyến mang tính rủi rõ khá lớn, bởi người sử dụng thực hiện giao dịch hoàn toàn thông qua hình thức Các tìm kiếm liên quan đến doithe cao doi the cao đổi thẻ cào thành tiền mặt phí thấp gạch thẻ cào là gì đổi thẻ cào thành tiền mặt uy tín đổi thẻ cào sang thẻ game gạch thẻ chậm gạch thẻ viettel banthe247 doi the 247, doi the nhanh , doi the 123, doi the cao ra tien mat, , doi the card vn , doi the cao cham , đổi thẻ game, gạch thẻ cào là gì thu mua ma the cao, doithe88, doithe12 , napthengay, đỗi thẻ chậm, doi the viettel thanh vinaphone doi the cao mobi sang viettel, doi the gmobile sang the viettel, săn thẻ 247 vn , doi the viettel thanh vinaphone, doi the gmobile sang the viettel, săn thẻ 247 vn, đổi thẻ vina sang garena, thecao247 vb, đổi tiền điện thoại sang thẻ cào vinaphone , Nạp ATM Online. Nạp tiền vào tài khoản bằng Internet Banking qua tài khoản Đông Á bank. Nạp tiền vào tài khoản bằng Internet Banking qua tài khoản BIDV ... Đổi thẻ thành tiền mặt Đổi thẻ cào điện thoại, thẻ game thành tiền mặt giá tốt nhất, rút tiền về tài khoản nhanh chóng tới 22h00 tất cả các ngày, đổi thẻ Viettel, vina, mobi đổi thẻ 123 Gamebank - Thu mua nạp đổi thẻ cào game, điện thoại sang vnđ; Trang chủ · Nạp tiền · Rút tiền · Chuyển tiền · Lịch sử giao dịch · Biểu phí · Tin tức; Dịch vụ; Box mua bán · Trung gian. Nạp thẻ cào ... Phí đổi thẻ ... Gamebank - Dịch vụ thu mua thẻ cào thẻ game, thẻ điện thoại, nạp đổi thẻ thành tiền nhanh chóng phí thấp, link nạp tự động, đa dạng mod tích hợp. Mọi người cũng tìm kiếm thu mua thẻ cào trực tuyến gamebank cvn card gamebank thanh toán gamebank gamebank kiem the id gamebank doi the 365 đổi thẻ cào thành tiền chậm vcard 365 đổi thẻ 123 đổi thẻ cào vietnamobile sang viettel đổi thẻ cào thành tiền mặt phí thấp Gamebank - Dịch vụ thu mua thẻ cào thẻ game, thẻ điện thoại, nạp đổi thẻ thành tiền nhanh chóng phí thấp, link nạp tự động, đa dạng mod tích hợp. Mọi người cũng tìm kiếm thu mua thẻ cào trực tuyến gamebank cvn card gamebank thanh toán gamebank gamebank kiem the id gamebank thu mua ma the cao doithe88 Kết quả tìm kiếm VCARD365 - Mua Bán Trao Đổi Thẻ Cào Thẻ Game banthe24hcom Vcard365 chuyên mua bán trao đổi thẻ cào thẻ nạp thẻ game bao gồm nạp thẻ điện thoại, mua mã thẻ, nạp tiền game, đổi thẻ cào các loại thẻ như garena, zing, Đổi thẻ cào thành tiền mặt nhanh, đơn giản doithenhanhcom false đ Trang chủ; Nạp tiền; Chuyển tiền; Rút tiền; Dịch vụ Nạp tiền điện thoại; Mua thẻ điện thoại; Mua thẻ Game Mua thẻ Carot; Bảng giá Chiết khấu đổi thẻ: Đổi thẻ cào - AZPRO azprovndich-vuvien-thong Thông Báo: Gạch thẻ viettel: Hoạt động ưu tiên mệnh giá 200k (Sai mệnh giá -30% mệnh giá thẻ) Gạch thẻ viettel (dự phòng ) : hoạt động Gạch thẻ vina: Hoạt Mọi người cũng tìm kiếm azpro thẻ game doi the gmobile sang the viettel săn thẻ 247 vn doi the viettel thanh vinaphone đổi thẻ viettel sang garena đổi tiền điện thoại sang thẻ cào vinaphone Đổi thẻ cào thành tiền mặt phí thấp - Dịch vụ mua bán thẻ cào nhanh key24hcom Đổi thẻ cào thành tiền mặt phí thấp - Dịch vụ mua bán thẻ cào nhanh, uy tín doithevn doithevn đổi thẻ điện thoại thành tiền, đổi thẻ điện thoại thành tiền mặt , đổi thẻ thành tiền mặt, đổi thẻ điện thoại, doi the cao thanh tien mat, đổi thẻ viettel , doi the dien Gamebank - Thu mua nạp đổi thẻ cào game, điện thoại sang vnđ svgamebankvn Gamebank - Dịch vụ thu mua thẻ cào thẻ game, thẻ điện thoại, nạp đổi thẻ thành tiền nhanh chóng phí thấp, link nạp tự động, đa dạng mod tích hợp ĐỔI THẺ CÀO ĐIỆN THOẠI RA THẺ GAME - ĐỔI THẺ RA TIỀN MẶT, … doi the

			  <script id="_wau78g">var _wau = _wau || []; _wau.push(["dynamic", "2gziijojlb", "78g", "c4302bffffff", "small"]);</script><script async src="//waust.at/d.js"></script>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/">Logout</a>
          </div>
        </div>
      </div>
    </div>




			<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5bd1381a19b86b5920c0cf7d/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>

  </body>

</html>
