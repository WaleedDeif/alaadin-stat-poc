<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

  <!-- srris chart -->
  <!-- jvectormap -->
  <!-- time picker -->
  <!-- toastr notifications -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-rtl.min.css')}}">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css')}}">

        <title>Alaadin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">      
            <div class="content">
                <div class="title m-b-md">
                    Calculate t value
                </div>
                <form id="tForm">
                @csrf
                    <div class="card-body">
                      <div class="row">المجموعة الاولى 
                        <div class="form-group col-md-3">
                        <label for="m1">المتوسط الحسابى</label>
                        <input type="number" class="form-control" id="m1" name="m1" step="any">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="sd1">الانحراف المعيارى</label>
                        <input type="number" class="form-control" id="sd1" name="sd1" step="any">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="n1">حجم العينة</label>
                        <input type="number" class="form-control" id="n1" name="n1" step="any">
                        </div>
                      </div>
                      <div class="row">المجموعة الثانية 
                        <div class="form-group col-md-3">
                        <label for="m2">المتوسط الحسابى</label>
                        <input type="number" class="form-control" id="m2" name="m2" step="any">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="sd2">الانحراف المعيارى</label>
                        <input type="number" class="form-control" id="sd2" name="sd2" step="any">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="n2">حجم العينة</label>
                        <input type="number" class="form-control" id="n2" name="n2" step="any">
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info btn-block"> احسب  </button>
                    </div>
                    <div class="card-footer">
                        <h3><span id="result">result</span></h3>
                    </div>
                </form>   
                </div>
            </div>
        </div>
    </body>
</html>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->   
<script src='https://unpkg.com/simple-statistics@7.1.0/dist/simple-statistics.min.js'></script>

<script type="text/javascript">
    
$('#tForm').submit(function(e){
    e.preventDefault();
    var t;
    var m1 = $('#m1').val(); 
    var m2 = $('#m2').val(); 
    var n1 = $('#n1').val(); 
    var n2 = $('#n2').val(); 
    var sd1 = $('#sd1').val(); 
    var sd2 = $('#sd2').val();
    var h2 = (Math.pow(sd1, 2) /n1);
    var i2 = (Math.pow(sd2, 2) /n2);
    var j2 = Math.pow((h2+i2), 0.5);
    var bast = m1-m2;
    t = bast / j2;
    $('#result').html(t.toFixed(4));
});


</script>