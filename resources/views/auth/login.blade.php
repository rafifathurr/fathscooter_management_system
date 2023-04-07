<!doctype html>
<html lang="en">
  <head>
    <title>FathScooter Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('login/style.css') }}">

    <link rel="icon" href="{{ asset('img/fath_2.png') }}" type="image/x-icon" />

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(img/bg-1.png);background-size: contain;margin: 10px;">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In Account</h3>
			      		</div>
			      	</div>
				<form action="{{route('login.authenticate')}}" method="post">
                {{ csrf_field() }}
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Email</label>
			      			<input type="email" name="email" id="email" placeholder="Email" class="form-control" autofocus required value="{{ old('email') }}">
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" id="password" placeholder="Password" class="form-control" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
                  	@if (session()->has('gagal'))
                    <div role="alert" style="color:red;">
                      <b>{{ session('gagal') }}</b>
                    </div>
                    <br>
                	@endif
					@if (session()->has('success'))
                    <div role="alert" style="color:green;">
                      <b>{{ session('success') }}</b>
                    </div>
                    <br>
                	@endif
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	{{-- <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
								<input type="checkbox" checked>
								<span class="checkmark"></span>
							</label> --}}
						</div>
						<div class="w-50 text-md-right">
							<a href="{{route('forgot.index')}}"><i>Forgot Password  </i> </a>
						</div>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

