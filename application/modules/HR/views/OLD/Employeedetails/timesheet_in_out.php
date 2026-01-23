
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
.active_timesheet_day{
        width:370px;
    }
    .timesheet_inner_table{
        width:370px;
    }
    .timesheet_inner_table td{
        padding: 5px;
    }
    .pin-btn {
        border: 1px solid #ccc;
        padding: 3px 6px;
        text-align: center;
        color: #9d9d9d;
        border-radius: 0.25rem;
        font-size: 12px;
    }
</style>
<div class="main-content">

    <div class="page-content">
                
        <div id="rosterDetails">
            <div class="modal-header py-2 px-3 bg-primary bg-gradient">
                <div><h5 class="modal-title text-white" id="rosterDetailsLabel">Timesheet</h5></div>
                
            </div>
            <div class="card m-3">
                <div class="card-body">
                    <div class="row">
                <div class="col-xxl-4 col-lg-4">
                    <div>
                        <form id="timsheet_form" action="<?php echo base_url();?>index.php/Employeedetails/fetch_employee_for_timsheet" method="post">
                            <div class="control-group">
                              <label class="control-label">Select Roster</label>
                              <div class="controls">
                                <select name="roster_list" class ='form-control' id="roster_list" onchange="this.form.submit()">
                                    <option  selected="selected" > Select Timesheet</option>
                                    <?php if(isset($all_timesheets) && !empty($all_timesheets)) { foreach($all_timesheets as $all_timesheet) {  
                                      $start = date("d-m-Y", strtotime($all_timesheet->start_date));
                                      $end = date("d-m-Y", strtotime($all_timesheet->end_date));
                                    ?>
                                     
                                    <?php  if($all_timesheet->timesheet_id == $timesheet_id)  { ?>
                                        <option  selected="selected" value="<?php echo $all_timesheet->roster_group_id; ?>_<?php echo $all_timesheet->timesheet_id; ?>_<?php echo $all_timesheet->timesheet_type; ?>" ><?php echo $all_timesheet->timesheet_name; ?><b>( <?php echo $start; ?> To <?php echo $end; ?>)</b></option>
                            		<?php } else { ?>
                            		    <option value="<?php echo $all_timesheet->roster_group_id; ?>_<?php echo $all_timesheet->timesheet_id; ?>_<?php echo $all_timesheet->timesheet_type; ?>" ><?php echo $all_timesheet->timesheet_name; ?><b>( <?php echo $start; ?> To <?php echo $end; ?>)</b></option>
                            	    <?php }  }} ?>
                            		
                                 </select>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <?php
                    $datee = new DateTime($start_date);
                    $mondate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $tuedate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $weddate=  $datee->format('d-m-Y');  $datee->modify('+1 day'); $thudate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $fridate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $satdate=  $datee->format('d-m-Y'); $datee->modify('+1 day'); $sundate=  $datee->format('d-m-Y');   
                ?>
                <table class="gridjs-table table table-striped table-bordered ">
                     <thead class="bg-light">
                        <tr>
                            <td class="gridjs-td text-center" width="150">Full Name</th>
                            <td class="gridjs-td text-center" width="150">Outlet Name</th>
                            <td class="gridjs-td text-center">MON</td>   
                            <td class="gridjs-td text-center">TUE</td>  
                            <td class="gridjs-td text-center">WED</td>  
                            <td class="gridjs-td text-center">THU</td>  
                            <td class="gridjs-td text-center">FRI</td>  
                            <td class="gridjs-td text-center">SAT</td>  
                            <td class="gridjs-td text-center">SUN</td>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($all_emps)){ ?>
                    		<?php foreach($all_emps as $all_emp){ $outlet_name_without_space = str_replace(' ','',$all_emp->outlet_name); 
                        		if($all_emp->status == "Disable"){
                        		    continue;
                        		}
                    		?>
                            <tr>
                                <td><b><?php echo $all_emp->first_name.' '.$all_emp->last_name;  ?></b><input type="hidden" class="employee_id" value="<?php echo $all_emp->emp_id; ?>"></td>
                                <td><b><?php echo $all_emp->outlet_name;  ?></b></td>
                                <td>	
    			                    <?php if(date("l") =='Monday') { ?>
    			                    <table>	
                                        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
                                            <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
                                            <?php } else { ?>
                                       <input type="hidden" class="roster_id" value="<?php echo $all_emp->roster_id; ?>">     
                                        <td  style="display:none" class="monday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
                                        <td data-toggle="modal" data-target="#pinModal" class="monday_in_pintime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                            <?php } ?>
                                            
                                      
                                           
                                         <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
                                           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
                                            <?php } else { ?>
                                           <td  style="display:none"  class="monday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="monday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                        <?php } ?>
                                          
                                         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
                                            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
                                           <?php }else{ ?>
                                            <td  style="display:none"  class="monday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="monday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                         <?php } ?>
                                         
                                         <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
                                            <?php } else { ?>
                                            <td  style="display:none"  class="monday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
                                            <td class="monday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                        <?php } ?>
                                          
                                            
                                            </tr></tbody>
                                
                                
                                            </table>
    			                    <?php } ?>
    			                </td>
    			                <td>
    			                    <?php if(date("l") =='Tuesday') { ?>
    			                    <table>	
                                        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
                                             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
                                            <?php } else { ?>
                                            <td  style="display:none" class="tuesday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
                                            <td data-toggle="modal" data-target="#pinModal" class="tuesday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                            <?php } ?>
                                            
                                          
                                             
                                           <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
                                           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
                                            <?php } else { ?>
                                           <td  style="display:none"  class="tuesday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="tuesday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                        <?php } ?>
                                          
                                         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
                                            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
                                           <?php }else{ ?>
                                            <td  style="display:none"  class="tuesday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="tuesday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                         <?php } ?>
                                         
                                           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
                                            <?php } else { ?>
                                            <td  style="display:none"  class="tuesday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
                                            <td class="tuesday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
                                             <?php } ?>
                                            
                                            </tr></tbody>
                                
                                
                                        </table>
    			                    <?php } ?>
    			                </td>
    			                <td>
    			                    <?php if(date("l") =='Wednesday') { ?>
    			                    <table>	
                                        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
                                             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
                                            <?php } else { ?>
                                            <td  style="display:none" class="wednesday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
                                            <td data-toggle="modal" data-target="#pinModal" class="wednesday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                               <?php } ?>
                                               
                                           
                                            
                                             <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
                                           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
                                            <?php } else { ?>
                                           <td  style="display:none"  class="wednesday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="wednesday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                        <?php } ?>
                                          
                                         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
                                            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
                                           <?php }else{ ?>
                                            <td  style="display:none"  class="wednesday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="wednesday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                         <?php } ?>
                                         
                                           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
                                            <?php } else { ?>  
                                            <td  style="display:none"  class="wednesday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
                                            <td class="wednesday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
                                            <?php } ?>
                                         
                                            </tr></tbody>
                                
                                
                                            </table>
    			                    <?php } ?>
    			                </td>
    			                <td>
    			                    <?php if(date("l") =='Thursday') { ?>
    			                    <table class="table timesheet_inner_table">	
                                        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th><th>Break Out</th>	<th>OUT</th></tr></thead><tbody>	<tr>
                                             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
                                            <?php } else { ?>
                                            <td  style="display:none" class="thursday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
                                            <td data-toggle="modal" data-target="#pinModal" class="thursday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                            <?php } ?>
                                            
                                           
                                             
                                             <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
                                           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
                                            <?php } else { ?>
                                           <td  style="display:none"  class="thursday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="thursday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                        <?php } ?>
                                          
                                         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
                                            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
                                           <?php }else{ ?>
                                            <td  style="display:none"  class="thursday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="thursday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                         <?php } ?>
                                         
                                           <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
                                            <?php } else { ?>  
                                            <td  style="display:none"  class="thursday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
                                            <td class="thursday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
                                             <?php } ?>
                                              
                                            </tr></tbody>
                                
                                
                                            </table>	
    			                    <?php } ?>
    			                </td>
    			                <td <?php if(date("l") =='Friday') { ?> class="active_timesheet_day" <?php } ?> >
    			                    <?php if(date("l") =='Friday') { ?>
    			                    <table class="timesheet_inner_table">		
                                        <thead>	<tr class=""><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead>
                                        <tbody>	
                                            <tr>
                                                <!--in time-->
                                                <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
                                                    <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
                                                <?php } else { ?>
                                                    <td  style="display:none" class="friday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
                                                    <td><div data-bs-toggle="modal" data-bs-target="#pinModal" class="pin-btn friday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</div></td>	
                                                <?php } ?>
                                                
                                                <!--break in time-->
                                                <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
                                                    <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
                                                <?php } else { ?>
                                                    <td  style="display:none"  class="friday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                                    <td><div class="pin-btn friday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</div></td>	
                                                <?php } ?>
                                                
                                                <!--break out time-->
                                                <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
                                                    <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
                                                <?php }else{ ?>
                                                    <td  style="display:none"  class="friday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                                    <td><div class="pin-btn friday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</div></td>	
                                                <?php } ?>
                                                
                                                <!--out time-->
                                                <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
                                                    <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
                                                <?php } else { ?>  
                                                    <td  style="display:none"  class="friday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
                                                    <td><div class="pin-btn friday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</div></td>		
                                                <?php } ?>
                                               
                                            </tr>
                                        </tbody>
                                    </table>	
    			                    <?php } ?>
    			                </td>
    			                <td>
    			                    <?php if(date("l") =='Saturday') { ?>
    			                    <table>	
                                        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
                                             <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
                                            <?php } else { ?>
                                            <td  style="display:none" class="saturday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
                                            <td data-toggle="modal" data-target="#pinModal" class="saturday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                             <?php } ?>
                                             
                                          
                                             
                                              <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
                                           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
                                            <?php } else { ?>
                                           <td  style="display:none"  class="saturday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="saturday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                        <?php } ?>
                                          
                                         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
                                            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
                                           <?php }else{ ?>
                                            <td  style="display:none"  class="saturday_breakouttime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="saturday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                         <?php } ?>
                                         
                                             <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
                                            <?php } else { ?>  
                                            <td  style="display:none"  class="saturday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
                                            <td class="saturday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
                                             <?php } ?>
                                           
                                            </tr></tbody>
                                
                                
                                            </table>
    			                    <?php } ?>
    			                </td>
    			                <td>
    			                    <?php if(date("l") =='Sunday') { ?>
    			                    <table>	
                                        <thead>	<tr class="ct-in-header"><th>IN</th><th>Break In</th> <th>Break Out</th><th>OUT</th>	</tr></thead><tbody>	<tr>
                                            <?php if(isset($all_emp->in_time) && $all_emp->in_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->in_time)); ?></td> 
                                            <?php } else { ?>
                                            
                                        <td  style="display:none" class="sunday_intime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#myModal" onclick="show_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')"><i class="material-icons"></i></td> 
                                        <td data-toggle="modal" data-target="#pinModal" class="sunday_in_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>" onclick="show_pin_modal('myModal',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                             <?php } ?>
                                            
                                             
                                              
                                            <?php if(isset($all_emp->break_in_time) && $all_emp->break_in_time !='00:00:00'){ ?>  
                                           <td><?php echo date("H:i", strtotime($all_emp->break_in_time)); ?></td> 
                                            <?php } else { ?>
                                           <td  style="display:none"  class="sunday_breaktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_time" onclick="show_modal('break_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="sunday_break_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_in_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                        <?php } ?>
                                          
                                         <?php if(isset($all_emp->break_out_time) && $all_emp->break_out_time !='00:00:00'){ ?>   
                                            <td><?php echo date("H:i", strtotime($all_emp->break_out_time)); ?></td> 
                                           <?php }else{ ?>
                                            <td  style="display:none"  class="sunday_breaoutktime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#break_out_time" onclick="show_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>				            
                                            <td class="sunday_break_pinouttime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('break_out_time',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>	
                                         <?php } ?>
                                         
                                         <?php if(isset($all_emp->out_time) && $all_emp->out_time !='00:00:00'){ ?>
                                            <td><?php echo date("H:i", strtotime($all_emp->out_time)); ?></td> 
                                            <?php } else { ?>  
                                            <td  style="display:none"  class="sunday_outtime<?php echo $all_emp->emp_id; ?><?php echo $all_emp->roster_id; ?>" data-toggle="modal" data-target="#clockout" onclick="show_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>)"><i class="material-icons"></i></td>	
                                            <td class="sunday_out_pintime<?php echo $all_emp->emp_id?><?php echo $all_emp->roster_id; ?>"data-toggle="modal"  data-target="#pinModal" onclick="show_pin_modal('clockout',<?php echo $all_emp->emp_id; ?>,this,<?php echo $all_emp->roster_id; ?>,'<?php echo $outlet_name_without_space; ?>')">ENTER PIN</td>		
                                              <?php } ?>
                                            
                                            </tr></tbody>
                                
                                
                                            </table>
    			                    <?php } ?>
    			                </td>
                            </tr>
                          <?php } ?>
                          <?php } ?>
                      </tbody>
              </table>
            </div>
           
        </div>
    </div>
        <!-- End Page-content -->

        
    </div>
    <!-- end main content-->
    <div class="modal fade" id="pinModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          
          <h5 class="modal-title">Enter Your Pin Number</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-xxl-12">
                    <div>
                        <input type="password" id="employee_pin_entered" name="employee_pin" class="form-control border-success" autocomplete="new-password">
                    </div>
                </div><!--end col-->
            </div>
          
          <input type="hidden" id="pin_emp_id">
          <input type="hidden" id="rosterID_emp">
          <input type="hidden" id="type_empclick">
          <input type="hidden" id="outletname_emp">
          <input type="hidden" id="objectreference">
          
          <input type="hidden" id="current_in_time">
          <input type="hidden" id="current_pin_time"></p>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="verify_pin()" class="btn btn-success btn-ph" id="pin_submit" data-dismiss="modal">Verify</button>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade" id="myModal" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Clock In Time</h4>
        </div>
        <div class="modal-body">
          <p><button type="button" onclick="setTime_in_time();" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:auto;background-color: #337ab7;">CLOCK IN TIME</button></p>
        </div>
        <div class="modal-footer">
		<input type="text" id="display_in_time" name="in_time" style="font-size:30px;border:none;width:100%;">
		<input type="hidden" class="unique_roster_id" value="">
        <button type="button" onclick="save_record(this,'myModal')" class="btn btn-success btn-ph" id="in_time" data-dismiss="modal">Save</button>
          <input type="hidden" class="myModal">
         
        </div>
      </div>
    </div>  </div>
  
  
  
   <div class="modal fade" id="clockout" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Clock Out Time</h4>
        </div>
        <div class="modal-body">
         <p><button type="button" onclick="setTime_out_time();" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:auto;background-color: #337ab7;">CLICK OUT TIME</button></p>
        </div>
        <div class="modal-footer">
		<input type="text"  id="display_out_time" name="out_time" style="font-size:30px;border:none;width:100%">
			<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" id="out_time" onclick="save_record(this,'clockout')">Save</button>
          
           <input type="hidden" class="clockout">
        </div>
      </div>
    </div>
  </div>
  
  
  
   <div class="modal fade" id="break_time" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record Break In Time </h4>
        </div>
        <div class="modal-body">
        <button type="button" id="break_in" onclick="breaksetTime_in_time(this);" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:100px;background-color: #337ab7;">IN</button> 
       
        <input type="hidden" id="breaktime_class">
        </div>
        <div class="modal-footer">
		<input type="text" id="break_in_time" name="break_in_time" style="font-size:30px;border:none;width:100%">
		<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" onclick="save_break_record(this,'break_time','breaktime_class')">Save</button>
          
          
          <input type="hidden" class="break_time">
          <input type="hidden" id="type" value="break_in_time">
          
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="break_out_time" role="dialog" style="opacity: inherit !important;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Record Break Out Time </h4>
        </div>
        <div class="modal-body">
       
        <button type="button" id="break_out" onclick="breaksetTime_in_time(this);" class="btn btn-info btn-lg" style="height:35px;font-size:16px;width:100px;background-color: #337ab7;">OUT</button>
        <input type="hidden" id="breaktime_class">
        </div>
        <div class="modal-footer">
		<input type="text" id="display_break_out_time" name="break_in_time" style="font-size:30px;border:none;width:100%">
		<input type="hidden" class="unique_roster_id" value="">
          <button type="button" class="btn btn-success btn-ph" data-dismiss="modal" onclick="save_break_record(this,'break_time','breaktime_class')">Save</button>
          <input type="hidden" class="break_time">
          <input type="hidden" id="type"  value="break_out_time">
        </div>
      </div>
    </div>
  </div>
            
</div>
<!-- END layout-wrapper -->
 <script>
    //   setInterval(function() {
    //               window.location.reload();
    //   }, 60000); 
  function show_modal(modal_id,emp_id,obj,roster_id,outletname=''){
      
       $("."+modal_id).val(emp_id+'_'+outletname);
      $("#"+modal_id).show();
     
      var new_class_to_enable = $(obj).attr('class');
      $(".unique_roster_id").val(roster_id);
      $("#current_in_time").val(new_class_to_enable);
      $("#breaktime_class").val(new_class_to_enable);
      $("#break_in_time,#break_out_time,#display_in_time,#display_out_time").val('');
  }
  
  function show_pin_modal(type,emp_id,class_to_enable,rosterID,outletname){
      console.log('clicked');
      $("#pin_emp_id").val(emp_id);
      $("#rosterID_emp").val(rosterID);
      $("#type_empclick").val(type);
      $("#outletname_emp").val(outletname);
      
      
      var new_class_to_enable = $(class_to_enable).prev('td').attr('class');
       var new_class_to_disable = $(class_to_enable).attr('class');
       $("#employee_pin_entered").val('');
      $("#current_in_time").val(new_class_to_enable);
       $("#current_pin_time").val(new_class_to_disable);
  }
  
  function verify_pin(){
     var emp_id= $("#pin_emp_id").val();
      var rosterID_emp= $("#rosterID_emp").val();
      var type_empclick= $("#type_empclick").val();
      var outletname_emp= $("#outletname_emp").val();
       console.log("e==t  -> ".type_empclick);
      
     var emp_pin= $("#employee_pin_entered").val();
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/verify_pin",
		method:"POST",
		data:{emp_id:emp_id,emp_pin:emp_pin},
	    success:function(data){
	        if(data=="verified"){
	           $class_to_enable = $("#current_in_time").val();
	           $class_to_disable = $("#current_pin_time").val();
	           $("."+$class_to_enable).show();
	           $("."+$class_to_disable).hide();
	           
	           
	       //    swal({
        //   text: "Your Pin has been Verified Succesfully",
        //   icon: "success",
        //   timer: 500
        //   }); 
     
        if(type_empclick=="break_out_time" || type_empclick=="break_in_time"){
            
            save_break_record(type_empclick,rosterID_emp,emp_id);
        }else{
            save_record(type_empclick,rosterID_emp,emp_id,outletname_emp);
        }
        
	        }else{
	            
	            swal({
          text: "Incorrect Pin, Please contact your adminstrator.",
          icon: "warning",
          }); 
	        }

			}
	});
  }
  
  function save_record(classname,roster_id,emp_id,outletname){
      
     
     
    //   var time = $(obj).val();
    if(classname == "myModal"){
         setTime_in_time();
          var time = $("#in_time").val();
           var type = "in_time";
    }else if(classname == "clockout"){
        setTime_out_time();
          var time = $("#out_time").val();
          var type = "out_time";
    }
   
   
    //   var emp_id  = $("."+classname).val();
      var roster_group_id = $("#roster_list").val();
    //   var outletname = $("#outletname").val();
      
      
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_record",
		method:"POST",
		data:{in_time:time,type:type,emp_id:emp_id,roster_group_id:roster_group_id,outletname:outletname,roster_id:roster_id},
	    success:function(response){
	        if(response =='Early'){
	            console.log(response);
	             swal({
          text: "Login time not must not exceed 15 mins as per your rosterd time.Please Try again in some time.",
          icon: "warning",
           timer: 3300
          });
          
	        }else{
	   
	         $class_to_enable = $("#current_in_time").val();
	         $("."+$class_to_enable).html('');
	         $("."+$class_to_enable).removeAttr('data-toggle');
	         
	         if($("#out_time").val() !=''){
	           $("."+$class_to_enable).html($("#out_time").val());  
	         }else{
	            $("."+$class_to_enable).html($("#in_time").val());
	         }
	         
		  swal({
          text: "Time Recorded",
          icon: "success",
           timer: 1300
          });
	        }
          
          
          
			}
	});
  }
  
  function save_break_record(break_type,roster_id,emp_id){
       
     
      var break_in_time = $("#break_in_time").val(); 
     
      if(break_in_time){
       var break_time = getTimeStamp_in_time();    
      }else{
          var break_time = getTimeStamp_in_time(); 
      }
   
   
      var roster_group_id = $("#roster_list").val();
     
    //   if(break_type == 'break_out_time'){
         
    //      $class_to_enable = $("#breaktime_class").val();
    //      console.log($class_to_enable);
    //      $("."+$class_to_enable).html(break_time); 
    //       $("."+$class_to_enable).removeAttr('data-toggle');
         
    //   }else{
    //         $("."+$class_to_enable).html(break_time);
    //         $("."+$class_to_enable).removeAttr('data-toggle');
    //   }
      $("."+$class_to_enable).html(break_time);
            $("."+$class_to_enable).removeAttr('data-toggle');
      $.ajax({
		url:"<?php echo base_url();?>index.php/Employeedetails/save_break_record",
		method:"POST",
		data:{break_time:break_time,break_type:break_type,roster_group_id:roster_group_id,roster_id:roster_id},
	    success:function(data){
		swal({
          text: "Break Time Recorded",
          icon: "success",
          timer: 1300
          });
			}
			
	});
  }
  

  
  
function getTimeStamp_in_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())));
}

function setTime_in_time() {
    $("#display_in_time,#in_time").val(getTimeStamp_in_time()); 
}




function getTimeStamp_out_time() {
       var now = new Date();
       return (now.getHours() + ':'+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())));
}

function setTime_out_time() {
    $("#display_out_time,#out_time").val(getTimeStamp_out_time());
}
</script>

<!--  for break time clockin and clokout record -->
  <script>


function breaksetTime_in_time(obj) {
    var id = $(obj).attr("id");
    var id = id+"_time";
  
    if(id =="break_in_time"){
        $("#break_in_time").val(getTimeStamp_in_time());
    }else if(id =="break_out_time"){
      $("#display_break_out_time").val(getTimeStamp_in_time());  
    
      
    }
    
    $("#type").val(id);
}

</script>