@extends('admin.layouts.app')

@section('mainpanel')
@include('admin/partials/navpanel')
<div class="content MeetingEntry">
	<div class="container-fluid">
		<a class="nav-link" href="{{ url('admin/meeting/add') }}">
			<button type="button" class="btn btn-dark">New Meeting</button>
		</a>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title ">Meeting Entry</h4>
						<p class="card-category">All meeting entries listing here.</p>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover MeetingEntry__table">
								<thead class=" text-primary">
									<th class="MeetingEntry__th">
										Meeting ID
									</th>
									<th class="MeetingEntry__th">
										Company
									</th>
									<th class="MeetingEntry__th">
										Logo
									</th>
									<th class="MeetingEntry__th">
										Start Date
									</th>
									<th class="MeetingEntry__th">
										Close Date
									</th>
									<th class="MeetingEntry__th">
										Status
									</th>
									<th>
										
									</th>
								</thead>
								<tbody class="MeetingEntry__tbody">
								@if(isset($meetings) && $meetings->count() > 0)
									@foreach($meetings as $meeting)
									<tr class="MeetingEntry__record MeetingEntry__tr ObjectRecord">
										<td class="MeetingEntry__td">
											{{ $meeting->meeting_uuid }}
										</td>
										<td class="MeetingEntry__td">
											{{ isset($meeting->company_name) ? $meeting->company_name : __('Unknown') }}
										</td>
										<td class="MeetingEntry__td">
											@if(isset($meeting->logo))<img width="60" height="60" src="{{ asset($meeting->logo) }}">@else{{ __('NONE') }}@endif
										</td>
										<td class="MeetingEntry__td">
											{{ isset($meeting->date_of_meeting) ? $meeting->date_of_meeting->format('jS \o\f F, Y g:i a') : __('----') }}
										</td>
										<td class="MeetingEntry__td">
											{{ isset($meeting->expired_date) ? $meeting->expired_date->format('jS \o\f F, Y g:i a') : __('----') }}
										</td>
										<td class="MeetingEntry__td">
											{{ $meeting->isExpired ? __('Closed') : __('On Going') }}
										</td>
										<td class="MeetingEntry__td report-btn">
											<a href="/admin/reporting/{{ $meeting->meeting_uuid }}">
												<button type="button" class="btn btn-primary btn-sm">Report</button>
											</a>
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
	</div>
</div>
@endsection
@section('execute_script')
<script type="text/javascript">
	jQuery(document).ready(function($){
		// meeting row clicked, then go to details page
		$('.MeetingEntry__tr .report-btn').on('click', DP.main.ignoreClickInTableRow);
		$('.MeetingEntry__tr').on('click', DP.main.meetingListClickedHandler);
	});
</script>
@endsection