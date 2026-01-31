 <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    <?php if ($this->session->flashdata('success_message')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success_message'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error_message')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error_message'); ?>
    </div>
<?php endif; ?>

           <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                  <div class="card-header">
                                      
                                      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 text-black">Rosters</h4>
    <?php if(!isset($roleId) || $roleId != 4) { ?>
                                    <div class="page-title-right">
                                        <div class="d-flex justify-content-sm-end">
                                         
                                            <div class="d-flex justify-content-sm-end">
                                                <a href="/HR/rosterForm" class="btn btn-primary" > <i class="ri-add-line fs-14 align-bottom me-1"></i>Add Roster</a>
                                               
                                            </div>
                                        </div>
                                    </div>
    <?php }  ?>
                                      </div>
                                      </div>

                                    <div class="card-body">
                                        <div id="siteList">
                                           
                                            
                                            <div class="table-responsive table-card mb-1">
                                                <table class="table align-middle table-nowrap" id="rosterListDatatable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th data-sort="customer_name">Roster Id</th>
                                                             <th data-sort="customer_name">Roster Name</th>
                                                            <th class="sort" data-sort="customer_name">Roster Week</th>
                                                            <!--<th class="sort" data-sort="status">Status</th>-->
                                                            <th class="no-sort" >Action</th>
                                                            </tr>
                                                    </thead>
                                                     <tbody class="list form-check-all">
                                                        <?php if(!empty($rosterList)) {  ?>
                                                        <?php foreach($rosterList as $roster){  ?>
                                                        <tr id="row_<?php echo  $roster['roster_id']; ?>" >
                                                            <?php
                                                            $start_datetime = new DateTime($roster['start_date']);
                                                            $end_datetime = new DateTime($roster['end_date']);
                                                            
                                                            $start_formatted = $start_datetime->format('jS F');
                                                            $end_formatted = $end_datetime->format('jS F');

                                                             $week_range = $start_formatted . ' - ' . $end_formatted;
                                                            ?>
                                                            <td class="week"><?php echo  $roster['roster_id']; ?></td>
                                                         <td class="week">
<?php
$dates = explode(' to ', $roster['rosterName']);

$from = date('d-m-Y', strtotime($dates[0]));
$to   = date('d-m-Y', strtotime($dates[1]));

echo $from . ' to ' . $to;
?>
</td>

                                                            <td class="week"><?php echo $week_range; ?></td>
                                                            <!--<td>-->
                                                            <!--<div class="form-check form-switch form-switch-custom form-switch-success">-->
                                                            <!--<input class="form-check-input toggle-demo" type="checkbox" role="switch" id="<?php echo  $roster['roster_id']; ?>" <?php if(isset($roster['status']) && $roster['status']  == '1'){ echo 'checked'; }?>>-->
                                                            <!--</div>-->
                                                            <!--</td>-->

      
     <td>
     <div class="d-flex gap-2">
         <a href="/HR/rosterView/<?php echo  $roster['roster_id']; ?>" class="btn btn-success btn-sm"> <i class="ri-eye-2-line align-bottom me-1"></i>View</a>
   <?php if(!isset($roleId) || $roleId != 4) { ?>
    <button class="btn btn-orange btn-sm" data-bs-toggle="modal" onclick="showRosterRecreateModal(<?php echo $roster['roster_id'] ?>)"><i class=" ri-creative-commons-sa-fill align-bottom me-1"></i> Recreate</button>
     
    <a class="btn btn-danger btn-sm remove-item-btn"  data-rel-id="<?php echo  $roster['roster_id']; ?>"><i class="ri-delete-bin-5-fill align-bottom me-1"></i> Delete</a>
      <?php }  ?>
   
    </div>
     </td>

  
                                                        </tr>
                                                        <?php } ?>
                                                          <?php } ?>
                                                    </tbody>
                                                </table>


                                                <div class="noresult" style="display: none">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                            colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                        </lord-icon>
                                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                                       <p class="text-muted mb-0">We did not find any record for you search.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                    </div><!-- end card -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end col -->
                        </div>
                        </div>
       
                </div>
        </div>
        



        <div class="modal fade" id="recreateRosterModal" tabindex="-1" aria-labelledby="recreateRoster" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="recreateRoster">Select date for roster</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                         <form action="<?php echo base_url('/HR/recreateRoster') ?>" method="post" id="recreateRosterForm">
                                                        <div class="modal-body">
                                                          <input type="hidden" name="roster_id" class="recreate_roster_id">
                                                                <div class="mb-3">
                                                                    <label for="startDate" class="col-form-label">Roster Start Date:</label>
                                                                    <input type="text" name="start_date" id="startdatepicker" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="endDate" class="col-form-label">Roster End Date:</label>
                                                                  <input type="text" name="end_date" id="enddatepicker" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d M, Y" readonly="readonly">
                                                                </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Recreate</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>        
        <script>
        // Remove roster localstorage that we save while creating
        window.onload = function() {
    const keysToRemove = Object.keys(localStorage).filter(key => key.startsWith('emp_'));
    keysToRemove.forEach(key => localStorage.removeItem(key));

};
$(document).ready(function(){
    // Automatically close flash messages after 5 seconds
    setTimeout(function() {
        $(".alert").fadeOut("slow");
    }, 4000);
  
    flatpickr("#startdatepicker", {
        dateFormat: "d M, Y",
        disable: [
            function(date) {
                // Disable all days except Mondays for roster start date selection
                return (date.getDay() !== 1);
            }
        ]
    });
    
    flatpickr("#enddatepicker", {
        dateFormat: "d M, Y",
        disable: [
            function(date) {
                // Disable all days except Sunday for roster end date selection
                return (date.getDay() !== 0);
            }
        ]
    });
    

    $('#recreateRosterForm').on('submit', function() {
        $('#loaderContainer').show();
    });

});

function showRosterRecreateModal(roster_id){
  $(".recreate_roster_id").val(roster_id);
  $("#recreateRosterModal").modal("show");
}
</script>
<script>
    $('#rosterListDatatable').DataTable({
    pageLength: 100,
    bPaginate: false,
    bInfo: false,
    lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
    columnDefs: [{
        targets: 'no-sort',
        orderable: false
    }],
    order: [[0, 'desc']] // Sort by the first column in descending order
});

$(document).on("click", ".remove-item-btn" , function() {
                let rosterId = $(this).attr('data-rel-id');
                    Swal.fire({
                      title: "Are you sure?",
                      icon: "warning",
                      showCancelButton: !0,
                      confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                      cancelButtonClass: "btn btn-danger w-xs mt-2",
                      confirmButtonText: "Yes, delete it!",
                      buttonsStyling: !1,
                      showCloseButton: !0,
                  }).then(function (e) {
                      if (e.value) {
                        $.ajax({
                            type: "POST",
                            url: "/HR/Roster/deleteRoster",
                            data:'rosterId='+rosterId,
                            success: function(data){
                              $('#row_'+rosterId).remove();
                            }
                        });
                      }
                  })
                
                
            });
        </script>
 