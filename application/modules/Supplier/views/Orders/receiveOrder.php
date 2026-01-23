<style>
        .kbw-signature { width: 350px; height: 150px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
        <!-- Success and Error Alerts -->
        <div class="alert alert-success shadow d-none" role="alert">
            <strong>Success!</strong> Order Received successfully.
        </div>
        <div class="alert alert-danger shadow mb-xl-0 d-none" role="alert">
            <strong>Something went wrong!</strong> Please try after some time!
        </div>

        <div class="row d-flex align-items-stretch">
            <?php
            // Determine column class based on showInvoice setting
            $className = 'col-xl-12 col-lg-12';
            if (isset($configData['showInvoice']) && $configData['showInvoice'] == 1) {
                $className = 'col-xl-7 col-lg-7';
            }
            ?>

            <div class="<?php echo htmlspecialchars($className, ENT_QUOTES); ?>">
                <div class="card">
                    <div class="card-header bg-white py-3">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-8">
                                <h4 class="mb-1 text-black">
                                    <?php echo isset($supplierName) ? ucfirst(htmlspecialchars($supplierName, ENT_QUOTES)) : 'Supplier Name'; ?>
                                </h4>
                                <p class="mb-0 text-black">
                                    <strong>P.O Number:</strong> #
                                    <?php
                                    $orderId = '';
                                    if (isset($orderData) && is_array($orderData) && !empty($orderData) && isset($orderData[0]['id'])) {
                                        echo htmlspecialchars($orderData[0]['id'], ENT_QUOTES);
                                        $orderId = htmlspecialchars($orderData[0]['id'], ENT_QUOTES);
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                      |   
                                    <strong>Order Total:</strong> $
                                    <?php echo isset($orderData[0]['order_total']) ? number_format(floatval($orderData[0]['order_total']), 2) : '0.00'; ?>
                                </p>
                            </div>

                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <button onclick="window.print()" class="btn btn-success me-2">
                                    <i class="ri-printer-line me-1"></i> Print
                                </button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="ri-add-line me-1"></i> Add Product
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap align-middle table-borderless mb-0">
                                <thead class="table-light text-white px-2">
                                    <tr>
                                        <th scope="col" class="text-white">Product Code</th>
                                        <th scope="col" class="text-white">Product Name</th>
                                        <th scope="col" class="text-white">Order Quantity</th>
                                        <th scope="col" class="text-white">Product Check</th>
                                        <th scope="col" class="text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="px-2">
                                    <?php
                                    $count = 1;
                                    if (isset($orderData) && is_array($orderData) && !empty($orderData)) {
                                        foreach ($orderData as $orderInfo) {
                                            // Safely assign variables with defaults
                                            $orderTotal = isset($orderInfo['order_total']) ? floatval($orderInfo['order_total']) : 0;
                                            $requireTC = isset($orderInfo['requireTC']) ? $orderInfo['requireTC'] : 0;
                                            $supplier_name = isset($orderInfo['supplier_name']) ? htmlspecialchars($orderInfo['supplier_name'], ENT_QUOTES) : '';
                                            $supplier_id = isset($orderInfo['supplier_id']) ? htmlspecialchars($orderInfo['supplier_id'], ENT_QUOTES) : '';
                                            $order_comments = isset($orderInfo['order_comments']) ? htmlspecialchars($orderInfo['order_comments'], ENT_QUOTES) : '';
                                            $delivery_info = isset($orderInfo['delivery_info']) ? htmlspecialchars($orderInfo['delivery_info'], ENT_QUOTES) : '';
                                            $delivery_date = isset($orderInfo['delivery_date']) && $orderInfo['delivery_date'] != '' ? date('d-m-Y', strtotime($orderInfo['delivery_date'])) : '';

                                            // Ensure product-related fields exist
                                            $product_id = isset($orderInfo['product_id']) ? htmlspecialchars($orderInfo['product_id'], ENT_QUOTES) : '';
                                            $product_code = isset($orderInfo['product_code']) ? htmlspecialchars($orderInfo['product_code'], ENT_QUOTES) : '';
                                            $product_name = isset($orderInfo['product_name']) ? htmlspecialchars($orderInfo['product_name'], ENT_QUOTES) : '';
                                            $product_unit_price = isset($orderInfo['product_unit_price']) ? htmlspecialchars($orderInfo['product_unit_price'], ENT_QUOTES) : '0';
                                            $price = isset($orderInfo['price']) ? htmlspecialchars($orderInfo['price'], ENT_QUOTES) : '0';
                                            $qty = isset($orderInfo['qty']) ? htmlspecialchars($orderInfo['qty'], ENT_QUOTES) : '0';
                                            $is_approved = isset($orderInfo['is_approved']) ? $orderInfo['is_approved'] : 0;
                                    ?>
                                            <tr class="product_row_<?php echo $product_id; ?> productNewRow">
                                                <input type="hidden" class="orderId" value="<?php echo $orderId; ?>">
                                                <td><?php echo $product_code; ?></td>
                                                <td><?php echo $product_name; ?></td>
                                                <td>
                                                    <div class="input-step step-success cartQtyChange">
                                                        <input class="itemUnitPrice" type="hidden" value="<?php echo $product_unit_price; ?>">
                                                        <button type="button" class="minus shadow" onclick="addNewProductToOrder(this, '<?php echo $product_code; ?>', '<?php echo $product_name; ?>', '<?php echo $product_id; ?>', '<?php echo $product_unit_price; ?>', 'minus')">–</button>
                                                        <input type="number" min="0" max="100000" class="product-quantity" name="orderQty_<?php echo $product_id; ?>" value="<?php echo $qty; ?>" oninput="addNewProductToOrder(this, '<?php echo $product_code; ?>', '<?php echo $product_name; ?>', '<?php echo $product_id; ?>', '<?php echo $price; ?>')">
                                                        <button type="button" class="plus shadow" onclick="addNewProductToOrder(this, '<?php echo $product_code; ?>', '<?php echo $product_name; ?>', '<?php echo $product_id; ?>', '<?php echo $product_unit_price; ?>', 'add')">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch form-switch-success">
                                                        <input class="form-check-input updateStatus" type="checkbox" rel-id="<?php echo $product_id; ?>" role="switch" id="is_unapprove_<?php echo $product_id; ?>" <?php echo $is_approved == '1' ? 'checked' : ''; ?>>
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block remove-item-btn" onclick="deleteProduct(<?php echo $product_id; ?>)" href="#deleteOrder">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                    <?php
                                            $count++;
                                        }
                                    } else {
                                        // Display a message if no order data is available
                                        echo '<tr><td colspan="5" class="text-center">No products found in this order.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <h5 class="card-title flex-grow-1 mb-4 text-black mt-4">Receiving Details</h5>

                            <?php if (isset($requireTC) && $requireTC == 1) { ?>
                                <div class="col-md-3 col-lg-3 col-sm-6">
                                    <label for="temp_record" class="form-label">Temperature Recording <span style="color:red">*</span></label>
                                    <input type="number" class="form-control" id="temp_record" required value="">
                                </div>
                            <?php } ?>

                            <div class="col-md-3 col-lg-3 col-sm-6">
                                <label for="date_created" class="form-label">Order Date</label>
                                <input id="date_created" type="text" readonly class="form-control" value="<?php echo (isset($orderData[0]['date_created']) && $orderData[0]['date_created'] != '') ? date('d-m-Y', strtotime($orderData[0]['date_created'])) : ''; ?>">
                            </div>

                            <div class="col-md-3 col-lg-3 col-sm-6">
                                <label for="delivery_date" class="form-label">Delivery Date</label>
                                <input type="text" id="delivery_date" readonly class="form-control" value="<?php echo (isset($orderData[0]['delivery_date']) && $orderData[0]['delivery_date'] != '') ? date('d-m-Y', strtotime($orderData[0]['delivery_date'])) : ''; ?>">
                            </div>

                            <div class="col-md-3 col-lg-3 col-sm-6">
                                <label for="receiving_person" class="form-label">Receiving Person <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="receiving_person" required value="">
                            </div>

                            <div class="col-md-3 col-lg-3 col-sm-6">
                                <div class="form-check form-switch form-switch-success mt-4">
                                    <label for="paid_in_cash" class="form-label">Paid In Cash</label>
                                    <input class="form-check-input" type="checkbox" id="paid_in_cash" role="switch" <?php echo (isset($orderInfo[0]['paid_in_cash']) && $orderInfo[0]['paid_in_cash'] == '1') ? 'checked' : ''; ?>>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <?php if (isset($order_comments) && $order_comments != '') { ?>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <h6 class="card-title mb-0 text-black"><i class="ri-message-3-fill me-4 align-middle me-1 text-black"></i>Order Comments</h6>
                                    <ul class="list-unstyled vstack gap-2 fs-13 mt-2">
                                        <li class="fw-medium fs-14"><?php echo $order_comments; ?></li>
                                    </ul>
                                </div>
                            <?php } ?>

                            <?php if (isset($orderData[0]['supplierComments']) && $orderData[0]['supplierComments'] != '') { ?>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <h6 class="card-title mb-0 text-black"><i class="ri-message-fill me-4 align-middle me-1 text-black"></i>Supplier Comments</h6>
                                    <ul class="list-unstyled vstack gap-2 fs-13 mt-2">
                                        <li class="fw-medium fs-14"><?php echo htmlspecialchars($orderData[0]['supplierComments'], ENT_QUOTES); ?></li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-lg-5 col-sm-12">
                                <div class="form-check form-switch form-switch-success mt-4">
                                    <label for="any_damaged_goods" class="form-label">Any Damaged Goods?</label>
                                    <input class="form-check-input" type="checkbox" id="any_damaged_goods" role="switch" <?php echo (isset($orderInfo[0]['any_damaged_goods']) && $orderInfo[0]['any_damaged_goods'] == '1') ? 'checked' : ''; ?>>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 col-lg-4 col-sm-12 damagedGoodsCol <?php echo (isset($orderInfo[0]['any_damaged_goods']) && $orderInfo[0]['any_damaged_goods'] == '1') ? '' : 'd-none'; ?>">
                               
                                <?php if (isset($orderData[0]['damaged_goods_attachment']) && $orderData[0]['damaged_goods_attachment'] != '') { ?>
                                    <div class="d-flex gap-2 mb-2 mt-2">
                                        <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['damaged_goods_attachment'], ENT_QUOTES); ?>" target="_blank">View File</a>
                                        <a type="button" class="btn btn-sm btn-danger" data-filename="damaged_goods_attachment" onClick="delete_row(this, '<?php echo $orderId; ?>', '<?php echo htmlspecialchars($orderData[0]['damaged_goods_attachment'], ENT_QUOTES); ?>');"><i class="ri-close-fill mt-2"></i> Delete</a>
                                    </div>
                                <?php } else { ?>
                                 <h6 class="text-black"> Upload Damaged goods attachment</h6>
                                    <form action="<?php echo base_url('/Supplier/Orders/uploadInvoice/damaged_goods_attachment/' . $orderId); ?>" class="dropzone" id="myDropzone">
                                        <div class="dz-message needsclick fs-10">
                                            <div class="mb-3">
                                                <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                            </div>
                                            <h6 class="text-black">Upload damaged goods attachment.</h6>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                            
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                
                                <?php if (isset($orderData[0]['delivery_docket_attachment']) && $orderData[0]['delivery_docket_attachment'] != '') { ?>
                                    <div class="d-flex gap-2 mb-2 mt-2">
                                        <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['delivery_docket_attachment'], ENT_QUOTES); ?>" target="_blank">View Delivery Docket</a>
                                        <a type="button" class="btn btn-sm btn-danger" data-filename="delivery_docket_attachment" onClick="delete_row(this, '<?php echo $orderId; ?>', '<?php echo htmlspecialchars($orderData[0]['delivery_docket_attachment'], ENT_QUOTES); ?>');"><i class="ri-close-fill mt-2"></i> Delete</a>
                                    </div>
                                <?php } else { ?>
                                <h6 class="text-black"> Upload delivery docket</h6>
                                    <form action="<?php echo base_url('/Supplier/Orders/uploadInvoice/delivery_docket_attachment/' . $orderId); ?>" class="dropzone" id="myDropzone">
                                        <div class="dz-message needsclick fs-10">
                                            <div class="mb-3">
                                                <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                            </div>
                                            <h6 class="text-black">Upload delivery docket.</h6>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12 d-none">
                                <label for="signature64" class="form-label">Receiving Person Signature</label>
                                <div id="sig"></div><br>
                                <textarea id="signature64" name="receiver_sign" style="display: none"></textarea>
                                <button class="btn btn-sm btn-danger mt-3 clearSign"><i class="ri-close-fill me-2 align-middle"></i>Clear Signature</button>
                            </div>
                        </div>

                        <div class="row mt-2 text-end">
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <a href="#" class="btn btn-success btn-md btnAfterAjax" onclick="receiveOrder()"><i class="ri-shopping-basket-line align-middle me-1"></i>Receive Order</a>
                                <button type="button" class="btn btn-blue btn-load btnBeforeAjax">
                                    <span class="d-flex align-items-center">
                                        <span class="spinner-grow flex-shrink-0" role="status">
                                            <span class="visually-hidden">Saving...</span>
                                        </span>
                                        <span class="flex-grow-1 ms-2">
                                            Saving...
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($configData['showInvoice']) && $configData['showInvoice'] == 1) { ?>
                <div class="col-xl-5 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0 text-black">Invoices</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#inv" role="tab" aria-selected="false">Invoice</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#inv1" role="tab" aria-selected="false">Invoice 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#inv2" role="tab" aria-selected="false">Invoice 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#inv3" role="tab" aria-selected="true">Invoice 3</a>
                                </li>
                            </ul>
                            <div class="tab-content text-black">
                                <!-- Invoice Tab -->
                                <div class="tab-pane active" id="inv" role="tabpanel">
                                    <?php if (isset($orderData[0]['invoice']) && $orderData[0]['invoice'] != '') { ?>
                                        <div class="d-flex gap-2 mb-2 mt-2">
                                            <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice'], ENT_QUOTES); ?>" target="_blank">View Invoice</a>
                                            <a type="button" class="btn btn-sm btn-danger" data-filename="invoice" onClick="delete_row(this, '<?php echo $orderId; ?>', '<?php echo htmlspecialchars($orderData[0]['invoice'], ENT_QUOTES); ?>');"><i class="ri-close-fill mt-2"></i> Delete</a>
                                        </div>
                                        <embed src="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice'], ENT_QUOTES); ?>" style="width:100%;min-height:400px;" alt="image1" class="upload-file">
                                    <?php } else { ?>
                                        <form action="<?php echo base_url('/Supplier/Orders/uploadInvoice/invoice/' . $orderId); ?>" class="dropzone dropzoneInv">
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                                </div>
                                                <h4 class="text-black">Drop your images here or click to upload.</h4>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>

                                <!-- Invoice 1 Tab -->
                                <div class="tab-pane" id="inv1" role="tabpanel">
                                    <?php if (isset($orderData[0]['invoice1']) && $orderData[0]['invoice1'] != '') { ?>
                                        <div class="d-flex gap-2 mb-2 mt-2">
                                            <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice1'], ENT_QUOTES); ?>" target="_blank">View Invoice</a>
                                            <a type="button" class="btn btn-sm btn-danger" data-filename="invoice1" onClick="delete_row(this, '<?php echo $orderId; ?>', '<?php echo htmlspecialchars($orderData[0]['invoice1'], ENT_QUOTES); ?>');"><i class="ri-close-fill mt-2"></i> Delete</a>
                                        </div>
                                        <embed src="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice1'], ENT_QUOTES); ?>" style="width:100%;min-height:400px;" alt="image1" class="upload-file">
                                    <?php } else { ?>
                                        <form action="<?php echo base_url('/Supplier/Orders/uploadInvoice/invoice1/' . $orderId); ?>" class="dropzone" id="myDropzone">
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                                </div>
                                                <h4 class="text-black">Drop your images here or click to upload.</h4>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>

                                <!-- Invoice 2 Tab -->
                                <div class="tab-pane" id="inv2" role="tabpanel">
                                    <?php if (isset($orderData[0]['invoice2']) && $orderData[0]['invoice2'] != '') { ?>
                                        <div class="d-flex gap-2 mb-2 mt-2">
                                            <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice2'], ENT_QUOTES); ?>" target="_blank">View Invoice</a>
                                            <a type="button" class="btn btn-sm btn-danger" data-filename="invoice2" onClick="delete_row(this, '<?php echo $orderId; ?>', '<?php echo htmlspecialchars($orderData[0]['invoice2'], ENT_QUOTES); ?>');"><i class="ri-close-fill mt-2"></i> Delete</a>
                                        </div>
                                        <embed src="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice2'], ENT_QUOTES); ?>" style="width:100%;min-height:400px;" alt="image1" class="upload-file">
                                    <?php } else { ?>
                                        <form action="<?php echo base_url('/Supplier/Orders/uploadInvoice/invoice2/' . $orderId); ?>" class="dropzone" id="myDropzone">
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                                </div>
                                                <h4 class="text-black">Drop your images here or click to upload.</h4>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>

                                <!-- Invoice 3 Tab -->
                                <div class="tab-pane" id="inv3" role="tabpanel">
                                    <?php if (isset($orderData[0]['invoice3']) && $orderData[0]['invoice3'] != '') { ?>
                                        <div class="d-flex gap-2 mb-2 mt-2">
                                            <a class="btn btn-sm btn-success" href="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice3'], ENT_QUOTES); ?>" target="_blank">View Invoice</a>
                                            <a type="button" class="btn btn-sm btn-danger" data-filename="invoice3" onClick="delete_row(this, '<?php echo $orderId; ?>', '<?php echo htmlspecialchars($orderData[0]['invoice3'], ENT_QUOTES); ?>');"><i class="ri-close-fill mt-2"></i> Delete</a>
                                        </div>
                                        <embed src="<?php echo base_url(); ?>uploaded_files/<?php echo isset($tenantIdentifier) ? htmlspecialchars($tenantIdentifier, ENT_QUOTES) : ''; ?>/Supplier/Invoices/<?php echo htmlspecialchars($orderData[0]['invoice3'], ENT_QUOTES); ?>" style="width:100%;min-height:400px;" alt="image1" class="upload-file">
                                    <?php } else { ?>
                                        <form action="<?php echo base_url('/Supplier/Orders/uploadInvoice/invoice3/' . $orderId); ?>" class="dropzone" id="myDropzone">
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-black ri-upload-cloud-2-fill"></i>
                                                </div>
                                                <h4 class="text-black">Drop your images here or click to upload.</h4>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
                     </div>
                     
                      <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Add Product</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                               
                                                              <div class="table-responsive table-card mt-4">
                                        <table class="table table-bordered align-middle mb-0 customtable" id="newProductTable">
                                            <thead class="table-light text-muted">
                                                <tr>
                                                    <th  scope="col">Product Code</th>
                                                    <th  scope="col">Product Name</th>
                                                    <th scope="col" >Qty</th>
                                                    <th scope="col" ></th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody class="prdctWithZeroOrderQty">
                                           <?php if(isset($suppProducts) && !empty($suppProducts)) {  ?>
                                           <?php foreach($suppProducts as $suppProduct) { ?>
                                           <tr class="productNewRow">
                                           <td><?php echo $suppProduct['product_code']; ?></td>
                                           <td><?php echo $suppProduct['product_name']; ?></td>
                                           <td>
                                         <div class="input-step step-success cartQtyChange">
                                          <input class="itemUnitPrice" type="hidden" value="<?php echo $suppProduct['price']; ?>">
                                          <button type="button" class="minus shadow">–</button>
                                          <input type="number" min="0" max="100000" class="product-quantity" name="orderQty_<?php echo $suppProduct['product_id']; ?>" value="1" oninput="addNewProductToOrder(this,'<?php echo $suppProduct['product_code']; ?>','<?php echo $suppProduct['product_name']; ?>','<?php echo $suppProduct['product_id']; ?>','<?php echo $suppProduct['price']; ?>')">
                                           <button type="button" class="plus shadow">+</button>
                                           </div>      
                                           </td>
                                           <td>
 <a  class="btn btn-primary" href="#" onclick="addNewProductToOrder(this,'<?php echo $suppProduct['product_code']; ?>','<?php echo $suppProduct['product_name']; ?>','<?php echo $suppProduct['product_id']; ?>','<?php echo $suppProduct['price']; ?>')">
                                          <i class=" ri-shopping-basket-2-fill align-middle me-1"></i>+
                                          </a>
                                          </td>
                                           </tr>
                                           <?php } ?>
                                             <?php } ?>   
                                               
                                            </tbody>
                                            </table>
                                                                  </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                               
                                                            </div>
        
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->     
               
<input typr="hidden" id="supplierEmail" value="<?php echo (isset($orderData[0]['supplier_email'])  ? $orderData[0]['supplier_email'] : '') ?>">
<input typr="hidden" id="supplierId" value="<?php echo (isset($orderData[0]['supplier_id'])  ? $orderData[0]['supplier_id'] : '') ?>">
<script>

$(document).on('click', '.plus', function() {
    let input = $(this).parent().find('.product-quantity');
    let currentValue = parseInt(input.val());
    let currentQty = parseInt(input.val());
     input.val(currentValue + 1); 
    
    // let itemUnitPrice = $(this).parent().find('.itemUnitPrice').val(); 
    // let itemUpdatedPrice = itemUnitPrice * currentQty; 
   
    
});

$(document).on('click', '.minus', function() {
    var input = $(this).parent().find('.product-quantity');
    var currentValue = parseInt(input.val());
    input.value = currentValue;
     if (currentValue >= 1) {
        input.val(currentValue - 1);
    }
});


$(document).ready(function() {
    $(".btnBeforeAjax").hide();
    
    
    // Toggle visibility on checkbox change
    $('#any_damaged_goods').on('change', function() {
        if ($(this).is(':checked')) {
            $('.damagedGoodsCol').removeClass("d-none");
        } else {
            $('.damagedGoodsCol').addClass("d-none");
        }
    });
    
});
     
let approvedProducts = localStorage.getItem('approvedProducts') ? JSON.parse(localStorage.getItem('approvedProducts')) : [];

$(document).on("change", ".updateStatus" , function() {   
    let productId = $(this).attr('rel-id');
   
    if ($(this).prop('checked')) {
        if (approvedProducts.indexOf(productId) === -1) {
            approvedProducts.push(productId);
        }
    } else {
        approvedProducts = approvedProducts.filter(function(item) {
            return item !== productId;
        });
    }

    localStorage.setItem('approvedProducts', JSON.stringify(approvedProducts));
});

function getApprovedProducts() {
    return JSON.parse(localStorage.getItem('approvedProducts')) || [];
}
    function receiveOrder(){
         
      let orderId = $(".orderId").val();
      let temperature = $("#temp_record").val();
      let any_damaged_goods = $("#any_damaged_goods").prop('checked');
      let paid_in_cash = $("#paid_in_cash").prop('checked');
      let receiving_person = $("#receiving_person").val();
      let supplierId = $("#supplierId").val();
      let supplierEmail = $("#supplierEmail").val();
      let receiver_sign = sig.signature('toDataURL');
     
      if((temperature && temperature.length > 0 && temperature =='') || receiving_person == ''){
          alert("Please enter required fields before receiving order");
          return false;
      }
      
      let updatedApprovedProducts = getApprovedProducts();
    
      
       $(".btnBeforeAjax").show();
        $(".btnAfterAjax").hide(); 
            $.ajax({
                url: '/Supplier/Orders/receiveOrder',
                type: 'POST',
                data: { 
                    order_id: orderId,
                    supplierId: supplierId,
                    supplierEmail: supplierEmail,
                    temp: temperature,
                    any_damaged_goods: any_damaged_goods,
                    paid_in_cash: paid_in_cash,
                    receiving_person: receiving_person,
                    updatedApprovedProducts:JSON.stringify(updatedApprovedProducts),
                    receiver_sign: receiver_sign
                    
                },
                success: function(response) {
                    $(".btnBeforeAjax").hide();$(".btnAfterAjax").show();
                    $(".alert-success").removeClass('d-none');
                    localStorage.removeItem('approvedProducts');
                    window.location.href = '/Supplier/<?php echo $this->session->userdata('system_id'); ?>';
                }
            });
}

 var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('.clearSign').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
    
//   Dropzone.autoDiscover = false; // To prevent Dropzone from automatically discovering the dropzone elements on the page
// for more info see cafeadmin supplier receiver order page Js

    var dropzone = document.querySelectorAll('.dropzone');
      // Loop through each element and initialize Dropzone
      dropzone.forEach(function(element) {
       new Dropzone(element, {
        // Your Dropzone configuration options go here
        maxFilesize: 5, // MB
        acceptedFiles: 'image/*',
        dictDefaultMessage: 'Drop your images here or click to upload',
        success: function(file, response) {
            location.reload();
        }
       });
     });

    
    
    
    	function delete_row(el,orderId,fileName){
	   
	    let invoiceType = $(el).attr("data-filename"); 
	     console.log(invoiceType);
       if(confirm('Are you sure you   want to delete file')){
	      $.ajax({
				type: "POST",
		    	url: '/Supplier/Orders/deleteInvoice',
				data: {order_id: orderId, invoiceType: invoiceType,fileName:fileName},
				success: function(data){
					location.reload();
					
				}
			});   
}	
	}
	
	function deleteProduct(product_id){
	    let orderId = $(".orderId").val();
	    if(confirm('Are you sure you   want to delete this product')){
	      $.ajax({
				type: "POST",
		    	url: '/Supplier/Orders/deleteOrderProduct',
				data: {order_id: orderId, product_id: product_id},
				success: function(data){
				    $(".product_row_"+product_id).remove();
					
				}
			});   
}	
	}
	
	function addNewProductToOrder(obj,code,name,product_id,price,addOrMinus=''){
	    let orderId = $(".orderId").val();
	    
	    let input = $(obj).parents(".productNewRow").find('.product-quantity');
        let product_qty = parseInt(input.val());
        if(addOrMinus !=''){
	    $(obj).html('..');
	    if(addOrMinus == 'add'){
	    product_qty = product_qty + 1;    
	    }else{
	     product_qty = product_qty - 1;    
	    }
	   
	    }else{
	     $(obj).html('Adding....');
	    }
	    $.ajax({
				type: "POST",
		    	url: '/Supplier/Orders/addNewProductToOrder',
				data: {order_id: orderId, product_id: product_id, product_price: price,product_name: name,product_code: code,product_qty: product_qty},
				success: function(data){
				 location.reload();	
				}
			});  
	}
</script>
              
          