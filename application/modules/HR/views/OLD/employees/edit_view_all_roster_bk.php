<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/table_design.css">

	<div class="row item">
			</div>

    
    

	<div  class="col-md-12 page-head border-bottom">
		<span class="text-center">
				<h3>VIEW ROSTER</h3>
			</span>
			
				<span class="extra_icons">
				<a href="javascript:send_email();"><i class="material-icons" data-toggle="tooltip" title="Mail">&#xe158;</i></a>
		         <a href="javascript:window.print();" ><i class="material-icons" data-toggle="tooltip" title="Print">&#xe8ad;</i></a>
		         
			</span>
	
	</div><!--.col-md-12 -->
	<?php $week_days = array('mon','tues','wed','thus','fri','sat','sun'); $count = 0; ?>.
	<?php 	foreach($roster as $key=>$roster_value){ 

	
	?>
   <div class="container ct-view-roster ct-view-roster1" style="max-width: 1350px !important;width:100%;margin:auto;">

<div class="dt-outer">
		<div class="form-group roster-dt">
		<div class="dt-inner">
         <span class="budget_span"> Roster Name:  </span> <span class="budget_span_value"> <input  id="budget_input_<?php echo $key?>" readonly class="form-control" type="text" value="<?php echo (isset($roster_value[0]->roster_name)) ? $roster_value[0]->roster_name : ''; ?>"></span>
		 </div>
		 <div class="dt-inner">
         <span class="budget_span"> Start Date:  </span> <span class="budget_span_value"> <input  id="start_<?php echo $key?>" readonly class="form-control" type="text" value="<?php echo (isset($roster_value[0]->start_date)) ? $roster_value[0]->start_date : ''; ?>"></span>
		 </div>
		 <div class="dt-inner">
         <span class="budget_span"> End Date:  </span> <span class="budget_span_value"> <input  id="end_<?php echo $key?>" readonly class="form-control" type="text" value="<?php echo (isset($roster_value[0]->end_date)) ? $roster_value[0]->end_date : ''; ?>"></span>
		 </div>
		 <?php if($count < 2){ ?>
		<div class="dt-inner">
         <span class="budget_span"> Budget:  </span> <span class="budget_span_value"> <input  id="budget_input_<?php echo $key?>" readonly class="form-control" type="text" value="<?php echo (isset($budget) && $budget != '') ? '$'.$budget.'.00' : ''; ?>"></span>
		 </div>
          <div class="dt-inner">
	  <span class="budget_span"> Cost:  </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="totall_cost_<?php echo $key?>" value="<?php echo (isset($week_earning)) ? '$'.$week_earning : ''; ?>" readonly></span>
	  </div>
	  </div>
	  <div class="form-group roster-dt">
	  <div class="dt-inner">
	 <span class="budget_span">Variance: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="balance_<?php echo $key?>" value="<?php echo "$".$variance; ?>" readonly></span>
	 </div>
	 <div class="dt-inner">
	  <span class="budget_span">Hours Allocated: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="hours_worked_<?php echo $key?>" value="<?php echo (isset($total_hrs_of_all_emp_of_this_roster)) ? $total_hrs_of_all_emp_of_this_roster : ''; ?>" readonly></span>

     </div>
     
     <div class="dt-inner">
	  <span class="budget_span">Budget/Cost Percentage: </span> <span class="budget_span_value"> <input  class="form-control" type="text" id="Percentage_<?php echo $key?>" value="<?php echo (isset($percenatge)) ? $percenatge. ' %' : ''; ?>" readonly></span>

     </div>
     <?php } ?>
     </div>
     </div>
     	<hr><br>
  
</div>

<div class="container ct-view-roster" style="max-width: 1350px !important;width:100%;">
<div class="row weekday_line">
  <div class="ct-scroll">
  <form class="form-inline" role="form" method="post" action="<?php echo base_url(); ?>index.php/admin/update_multiple_roster" enctype="multipart/form-data">
	<table class="blueTable">
   <thead>
   <tr>
  <th style="text-align: center;">EMPLOYEE</th> <th style="text-align: center;">MON</th><th style="text-align: center;">TUE</th>  <th style="text-align: center;">WED</th>  <th style="text-align: center;">THU</th> <th style="text-align: center;">FRI</th> <th style="text-align: center;">SAT</th> <th style="text-align: center;">SUN</th>
</tr>
</thead>

<tbody>

<?php 	foreach($roster_value as $row){ ?>
<input type='hidden' class="form-control" name="roster_id[]" value="<?php echo $row->roster_id; ?>" >
	<input type='hidden' class="form-control" name="roster_group_id" value="<?php echo $row->roster_group_id; ?>" >
	<input type='hidden' class="form-control" name="edit_view_all_roster" value='<?php echo $all_roster_group_ids; ?>' >
	
<tr>
<td class="start_end"><b></a><?php echo $row->emp_name; ?></b> <p><span><?php echo $row->emp_hours_worked_this_week.' Hrs'; ?></span></p></td>

<?php  for ($i = 0; $i < 7; $i++) { ?>
<td class="start_end">
<table>
<tr>
      <td class="child">Start</td>
      <td class="child">End</td>
      <td class="child">Break</td>
      <td class="child">Outlet</td>
      <!--<td class="child">Cost</td>-->
      </tr>
<tr>
      <?php $start_nameofday = $week_days[$i].'_start_time'; ?>
      <?php $start_name = $week_days[$i].'_start[]'; ?>
      <?php $end_name = $week_days[$i].'_end[]'; ?>
      <?php $break_name = $week_days[$i].'_break[]'; ?>
      <?php $outlet_name = $week_days[$i].'_layout[]'; ?>
      <?php $end_nameofday = $week_days[$i].'_end_time'; ?>
      <?php $break_nameofday = $week_days[$i].'_break_time'; ?>
       <?php $layout_nameofday = $week_days[$i].'_layout'; ?>
     
      <td class="child start_height date datetimepicker3">
     
      <input class="editable_field" readonly type='text' name="<?php echo $start_name;  ?>" value="<?php if($row->$start_nameofday == 0 && $row->$end_nameofday ==0) { echo '   ';  } else {   echo date ('H:i',strtotime($row->$start_nameofday)); } ?>">
     </td>
      
      <td class="child start_height date datetimepicker3">
      <input  class="editable_field" type='text' readonly name="<?php echo $end_name;  ?>" value="<?php if($row->$end_nameofday == 0 && $row->$end_nameofday ==0) {  echo '   '; } else {   echo date ('H:i',strtotime($row->$end_nameofday)); }?>">
      </td>
      
      <td class="child start_height">
     <input  class="editable_field" type='text' readonly name="<?php echo $break_name;  ?>" value="<?php if($row->$break_nameofday > 0) { echo $row->$break_nameofday;  } else {  echo '   '; }?>"> 
      </td>
      
      <td class="child start_height">
          <input class="editable_field" type='text' readonly name="<?php echo $outlet_name;  ?>" value="<?php if(!empty($row->$layout_nameofday)) { echo $row->$layout_nameofday;  } else {  echo '   '; }?>">
      </td>
     
    
   </tr>
   </table>
   </td>
   <?php } ?>
   
</tr>
  <?php $count++; } ?>

</tbody>

</form>
<input type="submit" value="Update" class="add_field_button">
<a  onclick='make_field_editable(this)' >Edit</a>
   
</table>


    </div>
    <?php } ?>

  <br>
	
</body>
<script>
 $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm A'
                });
                
function make_field_editable(obj){
$(obj).next().find(".editable_field").removeAttr("readonly");
$(obj).next().find(".start_height ").css("border","2px solid #1b1818");
$(obj).next().find(".editable_field:first").focus();

}

var budget = Number.parseFloat($("#total_budget").val());
var cost = Number.parseFloat($("#total_cost").val());
var balance = Number(budget) - Number(cost) ;

$("#totall_cost").val('$'+cost.toFixed(2));
if(Number(budget) < Number(cost)){
$("#balance").val('<font color="red">$'+balance.toFixed(2)+'</font>');
}else{
$("#balance").val('$'+balance.toFixed(2));
}

$("#hours_worked").val($("#total_hrs_of_all_employee").val());

</script>
</html>
