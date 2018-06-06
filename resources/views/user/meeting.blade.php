@extends('user.layouts.app')

@section('mainpanel')
<div class="msf-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 msf-form">

				<form action="" method="post" class="form-inline">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<fieldset>
						<h4>Introduction <span class="step">(Step 1 / 3)</span></h4>

						<div class="container">
							<div class="row">

								<div class="col-md">
									<div class="jumbotron">
										<h1 class="display-4">DormPro Soluction</h1>
										<p class="lead">Welcome to bla bla bla company</p>
										<hr class="my-4">
										<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
										<a class="btn btn-primary btn-lg" href="#" role="button">Start Now</a>
									</div>
								</div>

							</div>
						</div>

						<br>
						<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
					</fieldset>

					<fieldset>
						<h4>Place and Date of Birth <span class="step">(Step 2 / 3)</span></h4>

						<div class="container">
							<div class="row">

								<div class="col-md-6">
									<div class="jumbotron">
										<h1 class="display-4">Proxy</h1>
										<p class="lead">Welcome to bla bla bla company</p>
										<hr class="my-4">
										<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
										<a class="btn btn-primary btn-lg" href="#" role="button">Start Now</a>
									</div>
								</div>

								<div class="col-md-6">
									<div class="jumbotron">
										<h1 class="display-4">Resolution</h1>
										<p class="lead">Welcome to bla bla bla company</p>
										<hr class="my-4">
										<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
										<a class="btn btn-primary btn-lg" href="#" role="button">Start Now</a>
									</div>
								</div>

							</div>
						</div>

						<br>
						<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
						<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
					</fieldset>

					<fieldset>
						<h4>Summary <span class="step">(Step 3 / 3)</span></h4>

						<h1>Finish to submit the vote!!</h1>

						<br>
						<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
						<button type="submit" class="btn">Submit</button>
					</fieldset>

				</form>

			</div>
		</div>
	</div>
</div>
@endsection