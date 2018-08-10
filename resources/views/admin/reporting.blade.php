@extends('admin.layouts.app')

@section('mainpanel')

<div class="content MeetingEntry">
	<div class="container-fluid">
		
		<div class="row Voted___User">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title ">Voted User </h4>
						<p class="card-category">Listed of all voted user in this meeting</p>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover MeetingEntry__table">
								<thead class=" text-primary">
									<th class="MeetingEntry__th">
										HIN/SRN
									</th>
									<th class="MeetingEntry__th">
										NAME
									</th>
									<th class="MeetingEntry__th">
										ADDRESS
									</th>
									<th class="MeetingEntry__th">
										NUMBER OF SHARES
									</th>
								</thead>
								<tbody class="MeetingEntry__tbody">
									@if(isset($users))
									@foreach($users as $user)

									<tr class="MeetingEntry__record MeetingEntry__tr ObjectRecord">									
										<td class="MeetingEntry__td">
											{{ $user->username }}
										</td>
										<td class="MeetingEntry__td">
											{{ $user->name }}
										</td>
										<td class="MeetingEntry__td">
											{{ $user->address }}
										</td>
										<td class="MeetingEntry__td">
											{{ $user->number_of_share }}
										</td>
									</tr>

									@endforeach
									@endif

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row Total__Voted">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title ">Proxy Appointed</h4>
						<p class="card-category">Proxy Appointed Listing and votes</p>
					</div>

					<div class="card-body">
						<div class="table-responsive Proxy__Appointed">
							@if(isset($proxy))
							@foreach($proxy as $resolution => $votes)
							<table class="table table-striped mt-5">
								<thead>
									<tr class="table-secondary border-bottom">
										<th scope="col" class="text-dark">{{ $resolution }}</th>
									</tr>
									<tr class="">
										<th scope="col"></th>
										<th scope="col" class="text-center">FOR</th>
										<th scope="col" class="text-center">AGANIST</th>
										<th scope="col" class="text-center">ABSTAINED</th>
										<th scope="col" class="text-center">OPENVOTE</th>
										<th scope="col" class="text-center">EXCLUDED</th>
									</tr>
								</thead>
								<tbody>
									
									<tr>
										@if(isset($votes['proxy']))
										<th scope="row">{{ $votes['proxy'] }}</th>	
										@endif
										@foreach($votes['answers'] as $answer => $amount)										
										<td class="text-center">{{ $amount }}</td>
										@endforeach
									</tr>
								</tbody>
							</table>
							@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row Total__Voted">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title ">Total Voted Result</h4>
						<p class="card-category">Detailing Voted Result</p>
					</div>

					<div class="card-body">
						<div class="table-responsive Total__Voted__Result">
							@if(isset($answers))
							@foreach($answers as $resolution => $votes)
							<table class="table table-striped mt-5">
								<thead>
									<tr class="table-secondary border-bottom">
										<th scope="col" class="text-dark">{{ $resolution }}</th>
									</tr>
									<tr class="">
										<th scope="col"></th>
										<th scope="col" class="text-center">FOR</th>
										<th scope="col" class="text-center">AGANIST</th>
										<th scope="col" class="text-center">ABSTAINED</th>
										<th scope="col" class="text-center">OPENVOTE</th>
										<th scope="col" class="text-center">EXCLUDED</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">Number of shares</th>	
										@if(isset($votes["nominee"]))
										@foreach($votes["nominee"] as $answer => $count)
										<td class="text-center">{{ $count }}</td>
										@endforeach
										@endif
									</tr>
									<tr>
										<th scope="row">Number of Holders</th>
										@if(isset($votes["shareholder"]))
										@foreach($votes["shareholder"] as $answer => $count)
										<td class="text-center">{{ $count }}</td>
										@endforeach
										@endif
									</tr>
									<tr>
										<th scope="row">Percentage</th>
										@foreach($votes["percentage"] as $answer => $count)
										<td class="text-center">{{ $count }}</td>
										@endforeach
									</tr>
								</tbody>
							</table>
							@endforeach
							@endif
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<div class="row HowHolder__Voted">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title ">Holder Voted Behavior</h4>
						<p class="card-category">How holders votes on each resolution</p>
					</div>

					<div class="card-body">
						<div class="table-responsive Holder__Voted__Behavior">
							@if(isset($voteBehavior))
							@foreach($voteBehavior as $name => $votes)
							<table class="table table-striped mt-5">
								<thead>
									<tr class="table-secondary border-bottom">
										@if($votes['proxy'] == 'Chairman')
										<th scope="col" class="text-dark">{{ $name }} nominated to Chairman</th>
										@else
										<th scope="col" class="text-dark">{{ $name }} nominated to proxy {{ $votes['proxy'] }}</th>
										@endif
									</tr>
									<tr class="">
										<th scope="col">{{ $name }}</th>
										<th scope="col" class="text-center">FOR</th>
										<th scope="col" class="text-center">AGANIST</th>
										<th scope="col" class="text-center">ABSTAINED</th>
										<th scope="col" class="text-center">OPENVOTE</th>
										<th scope="col" class="text-center">EXCLUDED</th>
									</tr>
								</thead>
								<tbody>
									@foreach($votes['answers'] as $resolution => $answer)
									<tr>
										<th scope="col">{{ $resolution }}</th>
										@foreach($answer as $check => $count)
										<td class="text-center" colspan="" rowspan="" headers="">{{ $count }}</td>
										@endforeach
									</tr>
									@endforeach
								</tbody>
							</table>
							@endforeach
							@endif
						</div>
						
					</div>
				</div>
			</div>
		</div>

		@if(isset($meeting_uuid))
		<a class="btn btn-outline-primary pull-right" href="/admin/export/{{ $meeting_uuid }}">
								Export</a>
		@endif
	</div>
</div>

@endsection
@section('execute_script')
<script>
jQuery(document).ready(function($){

	var uuid = "<?php echo $meeting_uuid?>";
	DP.main.listenToNewVote(uuid);
	
});
</script>
@endsection