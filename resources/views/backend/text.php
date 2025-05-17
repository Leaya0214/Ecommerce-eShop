<?php
if ($employee_info) {
	$card_id         = $employee_info->card_id;

	$machine_id      = $employee_info->machine_id;
	$employee_name   = $employee_info->employee_name;
	$branch_name     = $employee_info->branch_name;
	$department_name = $employee_info->department_name;

	$grade_name = $employee_info->grade_name;
	$concern_name    = $employee_info->concern_name;
	$position_name   = $employee_info->position_name;
	$employee_id     = $employee_info->employee_id;
	$branch_id       = $employee_info->branch_id;

?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>

				<a href="<?php echo base_url(); ?>printJobCard/<?php echo $card_id; ?>/<?php echo $to_date; ?>/<?php echo $from_date; ?>"
					target="_blank" title="Click to Print" class="btn btn-info pull-left">Print</a>

				<tr>
					<td colspan='14'>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th colspan="4">
										<h3><?php echo $concern_name; ?></h3>
									</th>

								</tr>
							</thead>
							<tr>
								<th>Job Card Details</th>
								<th>Date <?php echo $from_date . " To " . $to_date ?></th>
								<th colspan='2'>Branch :<?php echo $branch_name; ?></th>
							</tr>
							<tr>
								<th>Employee ID</th>
								<th><?php echo $card_id; ?></th>
								<th>Department</th>
								<th><?php echo $department_name; ?></th>
							</tr>

							<tr>
								<th>Unique ID</th>
								<th><?php echo $machine_id; ?></th>
								<th>Grade</th>
								<th><?php echo $grade_name; ?></th>
							</tr>

							<tr>
								<th>Employee Name :</th>
								<th><?php echo $employee_name; ?></th>
								<th>Section</th>
								<th><?php echo $employee_info->section_name; ?></th>
							</tr>
							<tr>
								<th>Designation</th>
								<th><?php echo $position_name; ?></th>
								<th>Joining Date</th>
								<th>
									<?php
									$join = new DateTime($employee_info->joining_date);
									$diff = $join->diff(new DateTime());
									echo $join->format('d-M-Y') . ' | ' . "{$diff->y}Y-{$diff->m}M-{$diff->d}D";
									?>
								</th>

							</tr>
							<!--<tr>-->
							<!--	<th>Approved By</th>-->
							<!--	<th>Line Manager</th>-->
							<!--	<th>N/A</th>-->
							<!--	<th></th>-->
							<!--</tr>-->
							<tr>
								<th>Employee Type</th>
								<th><?php if ($employee_info->employee_type == 2) {
										echo "Permanent";
									} else {
										echo "Worker";
									} ?></th>


								<th>DOB </th>
								<th>
									<?php
									$dob = new DateTime($employee_info->date_of_birth);
									$age = $dob->diff(new DateTime());
									echo $dob->format('d-M-Y') . ' | ' . "{$age->y}Y-{$age->m}M-{$age->d}D";
									?>
								</th>

							</tr>


							<tr>
								<th>Religion</th>
								<th><?php echo $employee_info->religion; ?></th>


								<th>Gross Salary </th>
								<th><?php echo $employee_info->salary_range; ?></th>
							</tr>
						</table>
				</tr>
				<tr>
					<th style="text-align:Center; width:5%">SL</th>
					<th style="text-align:Center; width:15%">Date</th>
					<th style="text-align:Center; width:10%">WD</th>

					<!---<th style="text-align:left;">Schedule Time</th>--->
					<th style="text-align:center; width:5%">In-Time</th>
					<!--<th style="text-align:Right; width:5%">Late</th>-->
					<!--<th style="text-align:Right; width:10%">Gap T.</th>-->
					<th style="text-align:center; width:5%">Out-Time</th>

					<th style="text-align:center; width:10%">Work.H</th>
					<th style="text-align:center; width:10%">OT.H</th>
					<th style="text-align:center; width:10%">Shift Name</th>
					<th style="text-align:center; width:10%">TIF</th>
					<th style="text-align:center; width:10%">NIT</th>
					<th style="text-align:center; width:10%">NSB</th>
					<th style="text-align:center; width:10%">IFT</th>
					<th style="text-align:center; width:10%">FD/HD</th>

					<!--<th style="text-align:center; width:15%">Actual Status</th>-->
					<th style="text-align:center; width:15%">Status</th>
				</tr>

			</thead>
			<tbody>
				<tr>
					<?php
					$i                        = 1;
					$present                  = 0;
					$absent                   = 0;
					$holiday                  = 0;
					$restday                  = 0;
					$total                    = 0;
					$branch_type              = 0;
					$pl                       = 0;
					$cl                       = 0;
					$sl                       = 0;
					$ml                       = 0;
					$iom                      = 0;
					$lwp                      = 0;
					$udp                      = 0;
					$late_count               = 0;
					$total_late_count         = 0;
					$not_applicable_day       = 0;
					$grand_total_working_time = 0;
					$grand_total_over_time    = 0;

					//Not Applicable Part Start //
					$emaployee_joining_date = $employee_info->joining_date;
					$emaployee_joining      = date("Y-m", strtotime($emaployee_joining_date));
					$month_starting_date    = date("Y-m", strtotime($from_date));

					// 		$leave_result = $this->Attendance_report_model->select_by_id_by_join($employee_id, $date);

					$leave_result = $this->Attendance_report_model->select_by_id_by_join($employee_id, $from_date, $to_date);

					if ($emaployee_joining == $month_starting_date) {
						$from_date          = $employee_info->joining_date;
						$datetime1          = new DateTime($from_date);
						$datetime2          = new DateTime($emaployee_joining_date);
						$interval           = $datetime1->diff($datetime2);
						$not_applicable_day = $interval->days;
					}
					//Not Applicable Part End //
					$late_count  = 0;
					$late_count2 = 0;
					$cal_late    = 0;
					$total_late  = 0;
					$total_leave = 0;
					for (
						$date = $from_date;
						$date <= $to_date;
					) {

						$schedule_time       = 0;
						$gap_time            = 0;
						$rest_holiday_status = false;

						$value = $this->Attendance_report_model->selectAttendanceInTime_OutTime($employee_id, $date);
				// 		debugger($value);
						//Check Present list
						if ($this->db->affected_rows() > 0) {
							$status = "P";
							++$present;

							if ($value->late_time > 30 && $value->late_status == 1) {
								++$late_count2; //Calculatin for above every 30 minute.
							} elseif ($value->late_time < 30 && $value->late_status == 1) {
								$total_late += $value->late_time; //Calculatin for eveyday late.
								if ($total_late > 30) {
									++$late_count;
									$total_late = 0;
								}
							} else {
								$total_late = 0;
							}

							//IOM Status Setting //
							$imo_status = "OK";

							if ($value->late_status == 1 && $value->early_going == 1) {
								$imo_status = "Late + Early Going";
							} elseif ($value->late_status == 1) {
								$imo_status = "Late";
								$total_late_count += $value->late_time;
							} elseif ($value->early_going == 1) {
								$imo_status = "Early Going";
							}
							if($value->rest_holiday == 'h'){
								$actual_status = "WD";
							}else{
								$actual_status = "P";
							}
							// $actual_status = "P";
							if ($value->late_status == 1 && $value->early_going == 1) {
								$actual_status = "Late + Early Going";
							} elseif ($value->late_status == 1) {
								$actual_status = "Late";
							} elseif ($value->early_going == 1) {
								$actual_status = "Early Going";
							}

							//IOM Status Setting End //

							$gap_time     = $value->total_gap_time;
							$status_class = 'active';

							$schedule_time      = $value->schedule_name;
							$in_time            = $value->first_in_time;
							$out_time           = $value->out_time;
							$late_time          = $value->late_time;
							$overtime           = $value->over_time;
							$total_working_time = $value->total_working_time;
							$shift_name         = $value->schedule_name;
							$first_in_time      = 0;
							$branch_type        = $value->branch_type;

							if ($value->branch_type == "Factory") { //Factory Office
								$employee_works_time = $total_working_time - $overtime;
							} else { //Corporate office

								if (strtotime($in_time) > strtotime($employee_info->start_time)) { // In Time
									$temp_in_time = strtotime($value->first_in_time);
								} else {
									$temp_in_time = strtotime($employee_info->start_time);
								}
								$last_out_time = strtotime($out_time); // Out Time

								//Employee Schedule Time//
								$s_start_time = strtotime($employee_info->start_time);
								$s_end_time   = strtotime($employee_info->end_time);
								//Employee Schedule Time //

								//Calculate Working Time //
								$employee_works_schedule_time = round(abs($s_start_time - $s_end_time) / 60, 2);
								$employee_works_time          = $employee_total_works_time          = round(abs($temp_in_time - $last_out_time) / 60, 2);

								if ($employee_works_time > $employee_works_schedule_time) {
									$overtime_c          = $employee_works_time - $employee_works_schedule_time;
									$employee_works_time = round(abs($employee_total_works_time - $overtime_c));
								}
								//Calculate Working Time //
							}

							//New Code 09-04-2025

						} else {
							$schedule_group = $this->db->SELECT('*')
								->FROM('tbl_schedule_group_setup')
								->join('tbl_schedule', 'tbl_schedule.schedule_id=tbl_schedule_group_setup.schedule_id', 'left')
								->where('schedule_group_id', $employee_info->schedule_group_id)
								->where_in('rest_holiday', ['r', 'h'])
								->where('date', $date)
								->get()->row();

							//last_query();
							// debugger($schedule_group);

							//Check Leave

							$general_holiday_result = $this->Attendance_report_model->select_by_id_for_holiday($branch_id, $date);
							if ($this->db->affected_rows() > 0) {
								$status        = "Occasion off";
								$actual_status = $general_holiday_result->holiday_name;
							}
							$day_off_holiday_result = $this->Attendance_report_model->select_by_id_for_rotation_day('tbl_rotation_holiy_date', $employee_id, $date);
							if ($this->db->affected_rows() > 0) {
								$status        = "Day off";
								$actual_status = "Day off";
							}

							//$iom_result= $this->Attendance_report_model->select_pending_iom_request($employee_id,$date);

							$leave_result = $this->Attendance_report_model->select_by_id_by_join($employee_id, $date);
							$iom_result   = $this->Attendance_report_model->select_iom_by_date_id($employee_id, $date);

							// $leave_result = $this->Attendance_report_model->select_by_id_by_join($employee_id, $from_date, $to_date);
							// 	$iom_result = $this->Attendance_report_model->select_iom_by_date_id($employee_id, $from_date, $to_date);

							if ($leave_result) {
								if ($leave_result->leave_type_name == 'CL' || $leave_result->leave_type_name == 'cl') {
									++$cl;
									$actual_status = "Cl";
								} else if ($leave_result->leave_type_name == 'PL' || $leave_result->leave_type_name == 'pl') {
									++$pl;
									$actual_status = "PL";
								} else if ($leave_result->leave_type_name == 'ML' || $leave_result->leave_type_name == 'ml') {
									++$ml;
									$actual_status = "Cl";
								}

								$actual_status       = $leave_result->leave_type_name;
								$status              = "L";
								$schedule_time       = 'N/A';
								$status_class        = 'bg-primary';
								$imo_status          = "OK";
								$in_time             = "00:00:00";
								$out_time            = "00:00:00";
								$late_time           = "0";
								$overtime            = "0";
								$employee_works_time = "0";
								$shift_name          = "N/A";

								$total_leave++;
							} //Check Holiday
							elseif ($general_holiday_result || $day_off_holiday_result) {
								$temp_date    = date('Y-m-d', strtotime($date . ' - 1 days'));
								$leave_result = $this->Attendance_report_model->select_by_id_by_join($employee_id, $temp_date);
								if ($leave_result) {
									if ($leave_result->leave_type_name == 'CL' || $leave_result->leave_type_name == 'cl') {
										++$cl;
									} else if ($leave_result->leave_type_name == 'PL' || $leave_result->leave_type_name == 'pl') {
										++$pl;
									} else if ($leave_result->leave_type_name == 'ML' || $leave_result->leave_type_name == 'ml') {
										++$ml;
									}

									$status              = "L";
									$schedule_time       = 'N/A';
									$status_class        = 'bg-primary';
									$imo_status          = "OK";
									$in_time             = "00:00:00";
									$out_time            = "00:00:00";
									$late_time           = "0";
									$overtime            = "0";
									$employee_works_time = "0";
									$shift_name          = "N/A";
								} else {
									++$holiday;
									$schedule_time       = 'N/A';
									$status_class        = 'alert alert-info';
									$imo_status          = "OK";
									$in_time             = "00:00:00";
									$out_time            = "00:00:00";
									$late_time           = "0";
									$overtime            = "0";
									$employee_works_time = "0";
									$shift_name          = "N/A";
								}
							} elseif ($iom_result) {
								$status = "IMO";
								//++$absent;
								$schedule_time = 'N/A';
								$status_class  = 'alert alert-warning';
								++$iom; //IOM Count
								$imo_status          = "IMO";
								$actual_status       = "IMO";
								$in_time             = "00:00:00";
								$out_time            = "00:00:00";
								$late_time           = "0";
								$overtime            = "0";
								$employee_works_time = "0";
								$shift_name          = "N/A";
							} //Check Absent
							elseif ($schedule_group) {

								// debugger($holidayInOut);

								$in_time             = "00:00:00";
								$out_time            = "00:00:00";
								$late_time           = "0";
								$overtime            = "0";
								$employee_works_time = "0";
								$shift_name          = "N/A";
								$schedule_time       = 'N/A';
								$status_class        = 'alert alert-info';
								$imo_status          = "OK";
								$status              = "A"; // Default unless updated

								// Override status if it's a rest day or holiday
								if ($schedule_group->rest_holiday == 'r') {
									$actual_status = "HD";
									++$restday;
								} elseif ($schedule_group->rest_holiday == 'h') {
									$actual_status = "WD";
									++$holiday;
								}
							} else {
								$status = "A";
								++$absent;
								$schedule_time       = 'N/A';
								$status_class        = 'alert alert-danger';
								$imo_status          = "A";
								$actual_status       = "A";
								$in_time             = "00:00:00";
								$out_time            = "00:00:00";
								$late_time           = "0";
								$overtime            = "0";
								$employee_works_time = "0";
								$shift_name          = "N/A";
							}
						}

						if (isset($value->rest_holiday) && in_array($value->rest_holiday, ['r', 'h'])) {
							$schedule_time = 'N/A';
						}
						$total_work_hours = "00:00:00";
						$ex_l             = "00:00:00";
						$ex_l_class       = null;
						if ($in_time != "00:00:00" && $out_time) {
							$datetime_1 = $date . ' ' . $in_time;
							$datetime_2 = $date . ' ' . $out_time;
							if ($in_time > $out_time) {
								$decreament_date = strtotime("+1 day", strtotime($date));
								$decreament_date = date("Y-m-d", $decreament_date);
								$cdate           = $decreament_date;
								$datetime_2      = $cdate . ' ' . $out_time;
							}

							$start_datetime   = new DateTime($datetime_1);
							$gap_diff         = $start_datetime->diff(new DateTime($datetime_2));
							$total_work_hours = $gap_diff->h . ':' . $gap_diff->i;

							$work_hours = "08:00:00";
							$ex_l       = timeDifference($work_hours, $total_work_hours);
							if ($gap_diff->h < 8) {
								$ex_l       = $ex_l['hours'] . ':' . $ex_l['minutes'] . ':' . $ex_l['seconds'];
								$ex_l       = date('H:i', strtotime($ex_l));
								$ex_l       = '-' . $ex_l;
								$ex_l_class = 'text-danger bolder';
								//   $actual_status='Short Time';
								$imo_status = 'NOT OK';
							} else {
								$ex_l = $ex_l['hours'] . ':' . $ex_l['minutes'] . ':' . $ex_l['seconds'];
								$ex_l = date('H:i', strtotime($ex_l));

								//   $actual_status='Over Time';
								$imo_status = 'OK';
							}
						}

					?>

						<th style="text-align:center; width:5%"><?php echo $i; ?></th>
						<th style="text-align:center; width:15%" class="<?php echo $status_class; ?>"><?php echo $date; ?></th>
						<th style="text-align:center; width:10%"
							class="<?php echo $status_class; ?>"><?php echo date('D', strtotime($date)); ?></th>

						<!--<th style="text-align:center; width:5%" class="<?php echo $status_class; ?>">-->
						<!--	<?php echo $var = date('H:i', strtotime($in_time)); ?>-->
						<!--</th>-->

						<th style="text-align:center; width:5%" class="<?php echo $status_class; ?>">
							<?php echo $var = $in_time == '00:00:00' ? $in_time : date('h:i A', strtotime($in_time)); ?>
						</th>

						<!--<th style="text-align:right; width:5%" class="<?php echo $status_class; ?>">-->
						<!--	<?php echo intdiv($late_time, 60) . ':' . ($late_time % 60); ?>-->
						<!--</th>-->
						<!--<th style="text-align:right; width:10%"-->
						<!--	class="</?php echo $status_class; ?>"></?php if ($branch_type == "Factory") {-->
						<!--		echo $gap_time;-->
						<!--	} else {-->
						<!--		echo 0;-->
						<!--	} ?></th>-->


						<!--<td style="text-align:center; width:5%" class="<?php echo $status_class; ?>">-->
						<!--	<?php echo $var = date('H:i', strtotime($out_time)); ?>-->
						<!--</td>-->


						<th style="text-align:center; width:5%" class="<?php echo $status_class; ?>">
							<?php echo $var = ($out_time === null || $out_time === '00:00:00') ? '00:00:00' : date('h:i A', strtotime($out_time)); ?>
						</th>

						<td style="text-align:center; width:10%"
							class="<?php echo $status_class; ?>"><?php echo date('H:i', strtotime($total_work_hours)) ?></td>

						<!--<td style="text-align:right; width:10%"-->
						<!--	class="<?php echo $status_class; ?><?php echo $ex_l_class; ?>"><?php echo $ex_l ?></td>-->

						<td style="text-align:center; width:10%"
							class="<?php echo $status_class; ?>">
							<?php
                            // Configuration constants
                            $standard_w_min = 480; // 8 hours
                            $rest_deduction = 60; // 1 hour deduction for rest days/holidays
                            
                            $group_id = $employee_info->schedule_group_id;
                            
                            // Convert total work hours to minutes
                            list($t_hours, $t_minutes) = explode(":", $total_work_hours);
                            $total_minutes = ($t_hours * 60) + $t_minutes;
                            $grand_total_working_time += $total_minutes;
                            
                            // Calculate overtime based on work type
                            if (isset($value->rest_holiday) && in_array($value->rest_holiday, ['r', 'h'])) {
                                // debugger($value->rest_holiday);
                                // Rest day or holiday overtime calculation
                                $parts = explode(':', $value->total_work_hours ?? '0:0');
                                $hours = isset($parts[0]) ? (int)$parts[0] : 0;
                                $minutes = isset($parts[1]) ? (int)$parts[1] : 0;
                                
                                $total_work_minutes = ($hours * 60) + $minutes;
                                $ot_minutes = max($total_work_minutes - $rest_deduction, 0);
                                $total_ot = formatMinutesToTime($ot_minutes);
                            } else {
                                // Regular work day overtime calculation
                                $tb_mins = $value->tb_mins ?? 0;
                                $lb_mins = $value->lb_mins ?? 0;
                                $eb_mins = $value->eb_mins ?? 0;
                                $total_schedule_minutes = $standard_w_min + $eb_mins + $lb_mins + $tb_mins;
                            
                                $ot_minutes = max($total_minutes - $total_schedule_minutes, 0);
                                $total_ot = $ot_minutes > 0 ? formatMinutesToTime($ot_minutes) : "00:00";
                                
                                // Uncomment and modify if you need group-specific rules
                                /*
                                if ($ot_minutes > 0) {
                                    $min_ot_threshold = in_array($group_id, [5, 6, 7]) ? 30 : 120;
                                    if ($ot_minutes >= $min_ot_threshold) {
                                        $total_ot = formatMinutesToTime($ot_minutes);
                                    } else {
                                        $total_ot = "00:00";
                                    }
                                }
                                */
                            }
                            
                            echo $total_ot;
                            
                            // Track grand total overtime
                            list($t_ot_hours, $t_ot_minutes) = explode(":", $total_ot);
                            $total_ot_minutes = ($t_ot_hours * 60) + $t_ot_minutes;
                            $grand_total_over_time += $total_ot_minutes;
                            
                            /**
                             * Helper function to format minutes to HH:MM time string
                             */
                            function formatMinutesToTime($minutes) {
                                return sprintf('%02d:%02d', intdiv($minutes, 60), $minutes % 60);
                            }
                            ?></td>

						<td style="text-align:center; width:10%"
							class="<?php echo $status_class; ?>"><?php echo $schedule_time; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>

						<td style="text-align:center; width:15%" class="<?php echo $status_class; ?><?php echo $ex_l_class; ?>"
							style=''><?php echo $actual_status ?? $imo_status; ?></td>


						<!--<td style="text-align:center; width:15%" class="<?php echo $status_class; ?><?php echo $ex_l_class; ?>"-->
						<!--	style=''><?php echo $imo_status; ?></td>-->

				</tr>
			<?php $i++;
						$your_date = strtotime("1 day", strtotime($date));
						$date      = date("Y-m-d", $your_date);
					}
					// debugger($grand_total_over_time);
			?>
			<!-- <tr>
				<th colspan="5"> Total </th>
				<th style="text-align:right;"> <?php echo sprintf("%02d:%02d", floor($grand_total_working_time / 60), $grand_total_working_time % 60) ?> </th>
				<th style="text-align:right;"> <?php echo sprintf("%02d:%02d", floor($grand_total_over_time / 60), $grand_total_over_time % 60) ?> </th>
			</tr> -->
			</tbody>
		</table>
	</div>

	<table class="table table-bordered table-responsive">
		<tbody>
			<tr>
				<th class="">
					<div>
						<p style="display: flex; justify-content:space-between;"><strong>Total Present :</strong> <span><?php echo $present; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>Total Weekend :</strong> <span><?php echo $holiday; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>Total Holiday :</strong> <span><?php echo $restday; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>Total Absent :</strong> <span><?php echo $absent; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>Total NPD :</strong> <span><?php echo 0; ?></span></p>
					</div>
				</th>
				<th class="">
					<div>
						<p style="display: flex; justify-content:space-between;"><strong>CL :</strong> <span><?php echo 0; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>ML :</strong> <span><?php echo 0; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>EL :</strong> <span><?php echo 0; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>MTL :</strong> <span><?php echo 0; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>SP:</strong> <span><?php echo 0; ?></span></p>
					</div>
				</th>
				<th class="">
					<div>
						<p style="display: flex; justify-content:space-between;"><strong>Tiffin (TK) :</strong> <span><?php echo 0; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>NSB (TK) :</strong> <span><?php echo 0; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>Ifter (TK) :</strong> <span><?php echo 0; ?></span></p>
					</div>
				</th>
				<th class="">
					<div>
						<p style="display: flex; justify-content:space-between;"><strong>Total Attendance :</strong> <span><?php echo $total_days; ?></span></p>
						<p style="display: flex; justify-content:space-between;"><strong>Total OT. Hrs. :</strong> <span><?php echo sprintf("%02d:%02d", floor($grand_total_over_time / 60), $grand_total_over_time % 60); ?></span></p>
					</div>
				</th>

				<!-- <th class="alert alert-warning">Total Weekend : <?php echo $restday; ?></th>
				<th class="alert alert-info">Total Holiday : <?php echo $holiday; ?></th>
				<th class="alert alert-danger">Total Absent : <?php echo $absent; ?></th>
				<th class="alert alert-danger"><strong>Total NPD :</strong> 0</th> -->
			</tr>

			<!-- <tr>
				<td>CL : <?php echo $casual_leave; ?></td>
				<td>ML : <?php echo $medical_leave; ?></td>
				<td>EL : <?php echo $earned_leave; ?></td>
				<td>MTL : 0</td>
				<td>DJ : 0</td>
				<td>SP : 0</td>
			</tr>

			<tr>
				<td>Tiffin (Tk.) : <?php echo $tiffin_allowance; ?></td>
				<td>NSB (Tk.) : 0</td>
				<td>Ifter (Tk.) : 0</td>
				<td colspan="2">Total Attendance : <?php echo $present + $restday + $holiday; ?></td>
				<td>Total OT (Hrs) : <?php echo $total_ot_hours; ?></td>
			</tr>
			-->
			<tr>
				<td colspan="10" style="text-align: left; font-size: 11px; padding-top: 5px;">
					<strong>NPD :</strong> Non Payable Days |
					<strong>CL =</strong> Casual Leave |
					<strong>ML =</strong> Medical Leave |
					<strong>EL =</strong> Earn Leave |
					<strong>MTL =</strong> Maternity Leave |
					<strong>SP =</strong> Special Leave |
					<strong>NSB =</strong> Night Shift Bill |
					<strong>DJ =</strong> Delay Joining
				</td>
			</tr> 
		</tbody>
	</table>

<?php
} else {
	echo "Sorry !! Card No is Invalid";
}
?>
