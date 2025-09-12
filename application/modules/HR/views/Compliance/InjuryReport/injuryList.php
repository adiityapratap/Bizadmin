<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0 text-black">Injury Report</h5>
              <a class="btn btn-primary" type="button" href="<?php echo base_url('/HR/Injury/AddInjuryReport') ?>"><i class="ri-user-add-line"></i> Add Injury report</a>
            </div>
            <div class="card-body">
             <table id="reportList" class="table dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead class="table-light">
                  <tr>
                    <th>Work Area</th>
                    <th>Date </th>
                    <th>Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($reportLists) && !empty($reportLists)) { foreach($reportLists as $reportList) { ?>
                  <tr data-delete-id="<?php echo $reportList['Injury_Report_id']; ?>">
                    <td><?php echo $reportList['work_area']; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($reportList['injury_date'])); ?></td>
                    <td><?php echo $reportList['injury_time']; ?></td>
                   <td>
                     <ul class="list-inline hstack gap-2 mb-0">
                         <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View/Edit">
                        <a class="text-success d-inline-block" href="<?php echo '/HR/Injury/AddInjuryReport/'.$reportList['Injury_Report_id'] ?>">
                            <i class="ri-pencil-fill fs-16"></i></a></li>
                          <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                            <a class="text-danger d-inline-block remove-item-btn" onclick="deleteRecord(this,<?php echo $reportList['Injury_Report_id']; ?>)">
                              <i class="ri-delete-bin-5-fill fs-16"></i>
                            </a>
                          </li>
                        </ul>
                     
                    </td>
                  </tr>
                  <?php }  } ?>
                </tbody>
              </table>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

                                      
  <div class="modal fade flip" id="deleteRecord" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                                        style="width:90px;height:90px"></lord-icon>
                                                    <div class="mt-4 text-center">
                                                        <h4 class="text-black">You are about to delete a injury report ?</h4>
                                                        <p class="text-black fs-15 mb-4">Deleting your report will remove
                                                            all of the information from our database.</p>
                                                        <div class="hstack gap-2 justify-content-center remove">
                                                            <button
                                                                class="btn btn-link link-success fw-medium text-decoration-none"
                                                                data-bs-dismiss="modal"><i
                                                                    class="ri-close-line me-1 align-middle"></i>
                                                                Close</button>
                                                                <input class="deletedRecordId" type="hidden">
                                                             
                                                            <button class="btn btn-danger" id="delete-record">Yes,
                                                                Delete It</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                           

<script>
let table = $('#reportList').DataTable({
    pageLength: 10,
});

function deleteRecord(obj, recordId){
     $("#deleteRecord").modal('show');   
     $(".deletedRecordId").val(recordId);
    }    
    
$('#delete-record').click(function(){
    
     let deletedRecordId =  $(".deletedRecordId").val();
     $.ajax({
     type: "POST",
      "url" : "/HR/Injury/delete",
      data:'Injury_Report_id='+deletedRecordId,
      success: function(data){
      $("tr[data-delete-id='" + deletedRecordId + "']").remove();
      $("#deleteRecord").modal('hide');
      }
      });

});
 
</script>
