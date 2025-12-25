<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 text-black">Payroll & Superannuation Calculation</h4>
                            <p class="text-black">
                                Week: <?= date('jS F', strtotime($timesheet['date_from'])) ?> – <?= date('jS F Y', strtotime($timesheet['date_to'])) ?>
                            </p>
                        </div>
                        <a href="/HR/timesheetWithoutRoster" class="btn btn-danger">
                            <i class="fa-solid fa-arrow-left me-2 "></i>Back
                        </a>
                    </div>
                </div>
            </div>

            <!-- Configuration Summary -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <h6 class="alert-heading text-black"><i class="fa-solid fa-info-circle me-2"></i>Current Configuration</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Superannuation Rate:</strong> <?= $superConfig['super_percentage'] ?>%
                            </div>
                            <div class="col-md-3">
                                <strong>Payroll Tax Rate:</strong> <?= $superConfig['payroll_tax_rate'] ?>%
                            </div>
                            <div class="col-md-3">
                                <strong>Tier-Based:</strong> <?= $superConfig['enable_tier_payroll'] == '1' ? 'Enabled (Tier 1 only)' : 'Disabled (All employees)' ?>
                            </div>
                            <div class="col-md-3">
                                <strong>Public Holidays:</strong> <?= count($public_holidays) ?> in this week
                            </div>
                        </div>
                        <?php if (!empty($public_holidays)): ?>
                        <div class="mt-2">
                            <small><strong>Holidays:</strong> 
                            <?php foreach ($public_holidays as $holiday): ?>
                                <span class="badge bg-warning me-1"><?= date('M d', strtotime($holiday)) ?></span>
                            <?php endforeach; ?>
                            </small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Calculation Form -->
            <form id="payrollCalculationForm">
                <input type="hidden" name="timesheet_id" value="<?= $timesheet_id ?>">
                <input type="hidden" name="super_rate" value="<?= $superConfig['super_percentage'] ?>">
                <input type="hidden" name="payroll_tax_rate" value="<?= $superConfig['payroll_tax_rate'] ?>">
                <input type="hidden" name="tier_based_enabled" value="<?= $superConfig['enable_tier_payroll'] ?>">
                
                <div class="row">
                    <!-- Input Section -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4 text-black">Labour Cost Input</h5>
                                
                                <!-- X Labour Cost -->
                                <div class="mb-4">
                                    <label for="x_labour_cost" class="form-label">Net Income <i class="fa-solid fa-info-circle text-muted" title="Can be entered by Ops manager for forecasting"></i></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               step="0.01" 
                                               class="form-control" 
                                               id="x_labour_cost" 
                                               name="x_labour_cost"
                                               value="<?= isset($existingCalculation['x_labour_cost']) ? $existingCalculation['x_labour_cost'] : '' ?>"
                                               placeholder="Enter forecasted labour cost">
                                    </div>
                                    <small class="text-muted">Optional: For forecasting purposes only</small>
                                </div>

                                <!-- Net Income (Calculated) -->
                                <div class="mb-4">
                                    <label class="form-label text-black">Net Cost (Calculated)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" 
                                               class="form-control bg-light" 
                                               id="net_income_display" 
                                               value="<?= number_format($calculated_net_income['total'], 2) ?>"
                                               readonly>
                                        <input type="hidden" name="net_income" id="net_income" value="<?= $calculated_net_income['total'] ?>">
                                    </div>
                                    <small class="text-muted">Calculated from actual hours worked × rates (considering weekends & holidays)</small>
                                </div>

                                <!-- Employee Breakdown Toggle -->
                                <div class="mb-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#employeeBreakdown">
                                        <i class="fa-solid fa-chart-bar me-1"></i>View Employee Breakdown
                                    </button>
                                </div>

                                <!-- Collapsible Employee Breakdown -->
                                <div class="collapse" id="employeeBreakdown">
                                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                        <table class="table table-sm table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Hours</th>
                                                    <th>Rate</th>
                                                    <th>Type</th>
                                                    <th>Cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($calculated_net_income['breakdown'])): ?>
                                                    <?php foreach ($calculated_net_income['breakdown'] as $item): ?>
                                                    <tr>
                                                        <td><?= date('M d', strtotime($item['date'])) ?></td>
                                                        <td><?= $item['hours'] ?>h</td>
                                                        <td>$<?= $item['rate'] ?></td>
                                                        <td>
                                                            <?php if ($item['is_public_holiday']): ?>
                                                                <span class="badge bg-danger">Holiday</span>
                                                            <?php elseif ($item['day_type'] == 'Sunday'): ?>
                                                                <span class="badge bg-warning">Sunday</span>
                                                            <?php elseif ($item['day_type'] == 'Saturday'): ?>
                                                                <span class="badge bg-info">Saturday</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary">Weekday</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>$<?= number_format($item['cost'], 2) ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted">No data available</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calculation Results -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4 text-black">Calculation Results</h5>
                                
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Net Income</strong></td>
                                            <td class="text-end">
                                                <span class="h5 mb-0">$<span id="display_net_income"><?= number_format($calculated_net_income['total'], 2) ?></span></span>
                                            </td>
                                        </tr>
                                        <tr class="table-light">
                                            <td class="text-white">
                                                <strong>Superannuation</strong>
                                                <br><small class="text-muted"><?= $superConfig['super_percentage'] ?>% of Net Income</small>
                                            </td>
                                            <td class="text-end ">
                                                <span class="h5 mb-0 text-success">$<span id="display_superannuation">0.00</span></span>
                                                <input type="hidden" name="superannuation" id="superannuation">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-black"><strong>Cost inc Super</strong></td>
                                            <td class="text-end">
                                                <span class="h5 mb-0 text-black">$<span id="display_cost_inc_super">0.00</span></span>
                                                <input type="hidden" name="cost_inc_super" id="cost_inc_super">
                                            </td>
                                        </tr>
                                        <tr class="table-light">
                                            <td class="text-white">
                                                <strong>Payroll Tax</strong>
                                                <br><small class="text-muted"><?= $superConfig['payroll_tax_rate'] ?>% of Cost inc Super</small>
                                            </td>
                                            <td class="text-end">
                                                <span class="h5 mb-0 text-warning">$<span id="display_payroll_tax">0.00</span></span>
                                                <input type="hidden" name="payroll_tax" id="payroll_tax">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Cost inc Payroll Tax</strong></td>
                                            <td class="text-end ">
                                                <span class="h5 mb-0 text-black">$<span id="display_total_cost">0.00</span></span>
                                                <input type="hidden" name="cost_inc_payroll" id="cost_inc_payroll">
                                            </td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td><strong>Final Percentage</strong><br><small class="text-black">Of Net Income</small></td>
                                            <td class="text-end">
                                                <span class="h4 mb-0 text-primary"><span id="display_percentage">0.00</span>%</span>
                                                <input type="hidden" name="final_percentage" id="final_percentage">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Save Button -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success w-100" id="saveBtn">
                                        <i class="fa-solid fa-save me-2"></i>Save Calculation
                                    </button>
                                </div>

                                <?php if ($existingCalculation): ?>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fa-solid fa-clock me-1"></i>
                                        Last saved: <?= date('d M Y h:i A', strtotime($existingCalculation['updated_at'])) ?>
                                    </small>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Formula Reference -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title text-black">
                                <i class="fa-solid fa-calculator me-2 text-black"></i>Calculation Formulas
                            </h6>
                            <ul class="mb-0">
                                <li><strong>Net Income:</strong> Sum of (Hours Worked × Hourly Rate) for all employees</li>
                                <li><strong>Superannuation (SUP1):</strong> Net Income × <?= $superConfig['super_percentage'] ?>%</li>
                                <li><strong>Cost inc Super (SUP2):</strong> Net Income + Superannuation</li>
                                <li><strong>Payroll Tax (PT1):</strong> Cost inc Super × <?= $superConfig['payroll_tax_rate'] ?>%</li>
                                <li><strong>Total Cost (PT2):</strong> Cost inc Super + Payroll Tax</li>
                                <li><strong>Percentage:</strong> (Total Cost / Net Income) × 100</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Calculate on page load
    calculatePayroll();
    
    // Recalculate when x_labour_cost changes (optional, not used in calculation)
    $('#x_labour_cost').on('input', function() {
        // X Labour Cost is just for reference, doesn't affect calculation
    });
    
    function calculatePayroll() {
        let netIncome = parseFloat($('#net_income').val());
        let superRate = parseFloat('<?= $superConfig["super_percentage"] ?>');
        let taxRate = parseFloat('<?= $superConfig["payroll_tax_rate"] ?>');
        
        // Calculate
        let superannuation = netIncome * (superRate / 100);
        let costIncSuper = netIncome + superannuation;
        let payrollTax = costIncSuper * (taxRate / 100);
        let totalCost = costIncSuper + payrollTax;
        let percentage = (totalCost / netIncome) * 100;
        
        // Update display
        $('#display_net_income').text(netIncome.toFixed(2));
        $('#display_superannuation').text(superannuation.toFixed(2));
        $('#display_cost_inc_super').text(costIncSuper.toFixed(2));
        $('#display_payroll_tax').text(payrollTax.toFixed(2));
        $('#display_total_cost').text(totalCost.toFixed(2));
        $('#display_percentage').text(percentage.toFixed(2));
        
        // Update hidden fields
        $('#superannuation').val(superannuation.toFixed(2));
        $('#cost_inc_super').val(costIncSuper.toFixed(2));
        $('#payroll_tax').val(payrollTax.toFixed(2));
        $('#cost_inc_payroll').val(totalCost.toFixed(2));
        $('#final_percentage').val(percentage.toFixed(2));
    }
    
    // Form submission
    $('#payrollCalculationForm').on('submit', function(e) {
        e.preventDefault();
        
        $('#saveBtn').html('<i class="fa-solid fa-spinner fa-spin me-2"></i>Saving...').prop('disabled', true);
        
        $.ajax({
            url: '/HR/Timesheet/savePayrollCalculation',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#saveBtn').html('<i class="fa-solid fa-check me-2"></i>Saved!').removeClass('btn-success').addClass('btn-success');
                    
                    setTimeout(function() {
                        $('#saveBtn').html('<i class="fa-solid fa-save me-2"></i>Save Calculation').prop('disabled', false);
                    }, 2000);
                } else {
                    alert('Error: ' + response.message);
                    $('#saveBtn').html('<i class="fa-solid fa-save me-2"></i>Save Calculation').prop('disabled', false);
                }
            },
            error: function() {
                alert('Failed to save calculation. Please try again.');
                $('#saveBtn').html('<i class="fa-solid fa-save me-2"></i>Save Calculation').prop('disabled', false);
            }
        });
    });
});
</script>