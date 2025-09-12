<button type="button" data-toast="" data-toast-text="Settings Updated successfully" data-toast-gravity="top" data-toast-position="center"
    data-toast-classname="success" data-toast-duration="3000" class="btn btn-light w-xs d-none btnToastSuccess"></button>
<button type="button" data-toast="" data-toast-text="Error ! An error occurred." data-toast-gravity="top"
    data-toast-position="center" data-toast-classname="danger" data-toast-duration="3000" class="btn btn-light w-xs btnToastErr">Error</button>

<div class="main-content">
     <div id="loader-overlay">
    <div class="spinner"></div>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" class="form-horizontal mt-5" id="settingsForm">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <h4 class="card-title mb-0 text-uppercase fw-bold text-black">Settings</h4>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end gap-2">
                                            <button type="submit" class="btn btn-success btn-label waves-effect waves-light btnsave"><i class="ri-save-3-fill label-icon align-middle fs-16 me-2"></i>Save</button>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="company_name" class="form-label fw-semibold">Company Name</label>
                                        <input type="text" name="company_name" value="<?php echo isset($configData['company_name']) ? $configData['company_name'] : ''; ?>" class="form-control">
                                    </div>
                                   
                                    <div class="col-md-6 col-sm-12">
                                        <label for="abn" class="form-label fw-semibold">ABN</label>
                                        <input type="text" name="abn" value="<?php echo isset($configData['abn']) ? $configData['abn'] : ''; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="company_address" class="form-label fw-semibold">Company Address</label>
                                        <input type="text" name="company_address" value="<?php echo isset($configData['company_address']) ? $configData['company_address'] : ''; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="company_bank_account_name" class="form-label fw-semibold">Company Bank Account Name</label>
                                        <input type="text" name="company_bank_account_name" value="<?php echo isset($configData['account_name']) ? $configData['account_name'] : ''; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="company_bsb_number" class="form-label fw-semibold">Company BSB Number</label>
                                        <input type="text" name="company_bsb_number" value="<?php echo isset($configData['bsb']) ? $configData['bsb'] : ''; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="company_account_number" class="form-label fw-semibold">Company Account Number</label>
                                        <input type="text" name="company_account_number" value="<?php echo isset($configData['account_number']) ? $configData['account_number'] : ''; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="payment_terms" class="form-label fw-semibold">Payment Terms</label>
                                        <input type="text" name="payment_terms" value="<?php echo isset($configData['payment_terms']) ? $configData['payment_terms'] : ''; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="contact_email" class="form-label fw-semibold">Contact Email</label>
                                        <input type="email" name="contact_email" value="<?php echo isset($configData['contact_email']) ? $configData['contact_email'] : ''; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label for="contact_phone" class="form-label fw-semibold">Contact Phone Number</label>
                                        <input type="text" name="contact_phone" value="<?php echo isset($configData['contact_phone']) ? $configData['contact_phone'] : ''; ?>" class="form-control">
                                    </div>
                                    
                                    
                                     <div class="col-md-6 col-sm-12">
                                        <label for="contact_phone" class="form-label fw-semibold">Merchant Id</label>
                                        <input type="text" name="merchant_id" value="<?php echo isset($configData['merchant_id']) ? $configData['merchant_id'] : ''; ?>" class="form-control">
                                    </div>
                                    
                                     <div class="col-md-6 col-sm-12">
                                        <label for="contact_phone" class="form-label fw-semibold">Merchant Pass</label>
                                        <input type="text" name="merchant_password" value="<?php echo isset($configData['merchant_password']) ? $configData['merchant_password'] : ''; ?>" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- container-fluid -->
        </div><!-- page-content -->
    </div><!-- main-content -->

    <script>
        $("#settingsForm").on("submit", function (e) {
            
            e.preventDefault();
            let formData = $(this).serialize();
            $(".btnsave").html('Saving...');

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Catering/saveSettings'); ?>",
                data: formData,
                success: function (response) {
                   
                    $('.btnToastSuccess').click();
                    $(".btnsave").html('<i class="ri-save-3-fill label-icon align-middle fs-16 me-2"></i>Save');
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                    $('.btnToastErr').click();
                }
            });
        });
    </script>