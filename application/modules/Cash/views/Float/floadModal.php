  <div id="FloatConfirmModal" class="modal fade flip" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
                                                   <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                               
                                                <form class="tablelist-form" autocomplete="off">
                                                    <div class="modal-body">
                                                        
                                                        <div class="row g-3">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <div class="position-relative d-inline-block">
                                                                        <div class="position-absolute  bottom-0 end-0">
                                                                            <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                                        </div>
                                                                        <div class="avatar-lg p-1">
                                                                            <div class="avatar-title bg-light rounded-circle">
                                                                                <img src="<?php echo base_url() ?>/assets/images/users/user-dummy-img.jpg" id="customer-img" class="avatar-md rounded-circle object-cover">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-6">
                                                <div>
                                                    <label for="exampleFormControlTextarea5" class="form-label">Please enter comments</label>
                                                    <textarea class="form-control" id="floatcomments" rows="3"></textarea>
                                                </div>
                                            </div>
                                                            </div>
                                                            
                                                           
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-success" onclick="confirmFloat()" data-bs-dismiss="modal">Confirm</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                                </div>
