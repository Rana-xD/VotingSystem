<!-- 
    
 -->
<div class="tab-content">
						<div class="tab-pane active" id="userTab">
							<div class="table-responsive">
								<table class="table UserEntry__table">
									<thead class=" text-primary">
										<th class="UserEntry__th">
											HIN/SRN
										</th>
										<th class="UserEntry__th">
											Role
										</th>
										<th class="UserEntry__th">
											PIN
										</th>
									</thead>
									<tbody class="MeetingEntry__tbody">
										@if(isset($usersBelongToMeeting) && $usersBelongToMeeting->count() > 0)
										@foreach($usersBelongToMeeting as $user)
										<tr class="MeetingEntry__record MeetingEntry__tr ObjectRecord">
											<td class="UserEntry__td">
												{{ isset($user->username) ? $user->username : __('Unknown') }}
											</td>
											<td class="MeetingEntry__td">
												{{ isset($user->role) ? $user->role : __('Unknown') }}

											</td>
											<td class="MeetingEntry__td">
												{{ isset($user->pin) ? $user->pin : __('Unknown') }}

											</td>

										</tr>
										@endforeach
										@endif

									</tbody>
								</table>
							</div>

							
						</div>