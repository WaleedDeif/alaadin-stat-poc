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
                <div class="title ">
                    اختبار ت  للمجموعات المرتبطة    
                </div>
                <form id="tForm">
                @csrf
                    <div class="card-body">
                      <div class="row offset-md-4"> 
                        <div class="form-group col-md-3">
                        <label for="before">القياس القبلى</label>
                        <textarea class="form-control" name="before" id="before" rows="10"></textarea>
                        </div>
                      <div class="form-group col-md-3">
                        <label for="after">القياس البعدى</label>
                        <textarea class="form-control" name="after" id="after" rows="10"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info btn-block"> احسب  </button>
                    </div>
                    <h4><span id="error" style="color: red"></span></h4>
                </form>   
                <br>
                <table class="table table-bordered" id="resultsTable">
                  <thead>
                    <tr>
                      <th class="text-center">القياس </th>
                      <th class="text-center">جم العينة </th>
                      <th class="text-center"> المتوسط الحسابى </th>
                      <th class="text-center"> الانحراف المعيارى </th>
                      <th class="text-center"> درجة الحرية</th>
                      <th class="text-center"> قيمة t </th>
                      <th class="text-center"> الدالة الاحصائية </th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td class="text-center">القبلى</td>
                      <td class="text-center" id="n1"></td>
                      <td class="text-center" id="mb"></td>
                      <td class="text-center" id="stdb"></td>
                      <td  class="text-center" rowspan="2" id="fd"></td>
                      <td class="text-center" rowspan="2" id="t">  </td>
                      <td class="text-center" rowspan="2">0.01</td>
                  </tr>
                  <tr>
                      <td class="text-center">البعدى</td>
                      <td class="text-center" id="n2"></td>
                      <td class="text-center" id="ma"></td>
                      <td class="text-center" id="stda"></td>
                  </tr>
                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('plugins/simple-statistics/simple-statistics.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->   
<script type="text/javascript">
$('#resultsTable').hide();
$('#tForm').submit(function(e){
    e.preventDefault();
    var before = $('textarea#before').val();
    var after = $('textarea#after').val();
    var befores = before.split('\n').map( Number );
    var afters = after.split('\n').map( Number )    ;
    var beforeNum = befores.length;
    var afterNum = afters.length;
    if(beforeNum != afterNum){
        $('#error').html('عدد العينات غير متساوى');        
    }
    else{
        var t = tTestTwoSample(befores, afters, 0);
        $('#n1').html(beforeNum);
        $('#n2').html(afterNum);
        $('#ma').html(mean(afters));
        $('#mb').html(mean(befores));
        $('#stda').html(standardDeviation(afters));
        $('#stdb').html(standardDeviation(befores));
        $('#fd').html((beforeNum-1));
        $('#t').html(t);
        $('#resultsTable').show();
    }
});
</script>