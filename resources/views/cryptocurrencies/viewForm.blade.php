<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cryptocurrencies</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
  <script src="main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  {!! Html::style('assets/bootstrap/css/bootstrap.min.css') !!}
  {!! Html::style('css/cryptocurrencies/styles.css') !!}
  {!! Html::style('assets/bootstrap/css/bootstrap-theme.min.css') !!}
  {!! Html::script('assets/bootstrap/js/bootstrap.min.js') !!}
</head>
<body>

  <!--si el formulario contiene errores de validación-->
  @if(isset($error))
    <div class="message messageError" id="errorMessage">
      <!--recorremos los errores en un loop y los mostramos-->
      <p>{{ $error }}</p>
    </div>
  @endif
  
  {!! Form::open(array('route' => 'cryptocurrencies.compare', 'method' => 'POST'), array('role' => 'form')) !!}
  <div class="container" style="margin-top: 20px;">
    <div class="row">
      <div class="message messageInfo form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <span>If you want to check more than one information, please put the information comma separated</span>
      </div>
    </div>

    <div class="row" style="margin-top: 20px;">
      <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2" >
        <span>Amount:</span>
      </div>
      <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" >
        <input type="text" name="amount" value="{{old('amount')}}" class="form-control">
      </div>
    </div>

    <div class="row" style="margin-top: 20px;">
      <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2" >
        <span>Currency:</span>
      </div>
      <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" >
        <input type="text" name="currency" value="{{old('currency')}}" class="form-control">
      </div>
    </div>

    <div class="row" style="margin-top: 20px;">
      <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2" >
        <span>Cryptocurrency:</span>
      </div>
      <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" >
        <input type="text" name="cryptocurrency" value="{{old('cryptocurrency')}}" class="form-control">
      </div>
    </div>
        
    <div class="row" style="margin-top: 20px;">
      <div class="form-group col-xs-12 col-xs-push-0 col-sm-2 col-sm-push-5 col-md-2 col-md-push-5 col-lg-2 col-lg-push-5" >
        <input type="submit" id="" value="Submit" class="btn2">
      </div>
    </div>

  </div>
  {!! Form::close() !!}

  @if(isset($comparings))
    <div class="container">
      <div class="row">
        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" >
          @foreach($comparings AS $oneAmount => $key)
            <div class="row" style="margin-top: 20px;">
              <div class="form-group col-xs-12 col-sm-2 col-md-2 col-lg-2" >
                <span>Amount: {{number_format($oneAmount, 2, '.', ',')}}</span>
              </div>
            </div>
            @foreach($key AS $data)
              <div class="row">
                <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" >
                <span>{{$oneAmount}} {{$data['currency']}} = {{$data['totalBought']}} {{$data['cryptocurrency']}}</span>
                </div>
              </div>
            @endforeach
          @endforeach
        </div>
      </div>
    </div>
  @endif

  <script type="text/javascript">
    setTimeout(function() {
        $('#errorMessage').fadeOut('slow');
      }, 5000);
  </script>

</body>
</html>