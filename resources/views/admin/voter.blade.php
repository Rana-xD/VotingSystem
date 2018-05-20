@extends('admin.layouts.app')

@section('mainpanel')
	<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title ">Meeting</h4>
						<p class="card-category"> Here is a subtitle for this table</p>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead class=" text-primary">
									<th>
										HIN/SRN
									</th>
									<th>
										Name
									</th>
								</thead>
								<tbody>
									<tr>
										<td>
											112312
										</td>
										<td>
											ABC Company
										</td>
									</tr>
									<tr>
										<td>
											221252
										</td>
										<td>
											IBM
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('sidebar')
	@include('admin/partials/sidebar')
@endsection