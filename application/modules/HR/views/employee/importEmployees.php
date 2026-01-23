<!DOCTYPE html>
<html>
<head>
    <title>Import Employees from CSV</title>
    <style>
        .import-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .import-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .import-header h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .import-header p {
            color: #666;
            font-size: 14px;
        }
        
        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            background: white;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .upload-area:hover {
            border-color: #4CAF50;
            background: #f0fff4;
        }
        
        .upload-area.dragover {
            border-color: #4CAF50;
            background: #e8f5e9;
        }
        
        .upload-icon {
            font-size: 48px;
            color: #4CAF50;
            margin-bottom: 15px;
        }
        
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-top: 15px;
        }
        
        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }
        
        .file-input-label {
            display: inline-block;
            padding: 12px 30px;
            background: #4CAF50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .file-input-label:hover {
            background: #45a049;
        }
        
        .selected-file {
            margin-top: 15px;
            padding: 10px;
            background: #e8f5e9;
            border-radius: 5px;
            color: #2e7d32;
            display: none;
        }
        
        .import-btn {
            background: #2196F3;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            margin-top: 20px;
        }
        
        .import-btn:hover {
            background: #1976D2;
        }
        
        .import-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .progress-container {
            display: none;
            margin-top: 20px;
        }
        
        .progress-bar {
            width: 100%;
            height: 30px;
            background: #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50 0%, #45a049 100%);
            width: 0%;
            transition: width 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 500;
        }
        
        .result-container {
            display: none;
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
        }
        
        .result-container.success {
            background: #e8f5e9;
            border: 1px solid #4CAF50;
        }
        
        .result-container.error {
            background: #ffebee;
            border: 1px solid #f44336;
        }
        
        .result-container h3 {
            margin-top: 0;
            color: #333;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 20px 0;
        }
        
        .stat-box {
            background: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #4CAF50;
        }
        
        .stat-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        
        .error-list {
            max-height: 200px;
            overflow-y: auto;
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }
        
        .error-item {
            padding: 8px;
            border-bottom: 1px solid #ffcdd2;
            color: #c62828;
            font-size: 14px;
        }
        
        .error-item:last-child {
            border-bottom: none;
        }
        
        .instructions {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #2196F3;
        }
        
        .instructions h3 {
            margin-top: 0;
            color: #2196F3;
        }
        
        .instructions ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        
        .instructions li {
            margin: 8px 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="import-container">
        <div class="import-header">
            <h2>Import Employees from CSV</h2>
            <p>Upload your employee CSV file to import data into the new system</p>
        </div>
        
        <div class="instructions">
            <h3>Import Process</h3>
            <ul>
                <li>Creates user accounts in Global_users table</li>
                <li>Links users to location (location_id = 11)</li>
                <li>Assigns employee role (role_id = 4)</li>
                <li>Populates HR_employee table with detailed information</li>
                <li>Sets position as "Food and Beverage Attendant" (position_id = 5)</li>
                <li>Links employees to location in HR system</li>
            </ul>
            <p><strong>Note:</strong> Employees with existing email addresses will be skipped to avoid duplicates.</p>
        </div>
        
        <form id="importForm" enctype="multipart/form-data">
            <div class="upload-area" id="uploadArea">
                <div class="upload-icon">📄</div>
                <h3>Choose CSV File</h3>
                <p>Drag and drop your file here or click to browse</p>
                
                <div class="file-input-wrapper">
                    <label for="csv_file" class="file-input-label">Select File</label>
                    <input type="file" id="csv_file" name="csv_file" accept=".csv" required>
                </div>
                
                <div class="selected-file" id="selectedFile">
                    <strong>Selected:</strong> <span id="fileName"></span>
                </div>
            </div>
            
            <button type="submit" class="import-btn" id="importBtn">
                Import Employees
            </button>
        </form>
        
        <div class="progress-container" id="progressContainer">
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill">0%</div>
            </div>
        </div>
        
        <div class="result-container" id="resultContainer">
            <h3 id="resultTitle"></h3>
            <p id="resultMessage"></p>
            
            <div class="stats" id="statsContainer" style="display: none;">
                <div class="stat-box">
                    <div class="stat-number" id="totalStat">0</div>
                    <div class="stat-label">Total Records</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number" style="color: #4CAF50;" id="successStat">0</div>
                    <div class="stat-label">Successful</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number" style="color: #f44336;" id="failedStat">0</div>
                    <div class="stat-label">Failed</div>
                </div>
            </div>
            
            <div class="error-list" id="errorList" style="display: none;"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // File input handling
            $('#csv_file').on('change', function() {
                const fileName = $(this).val().split('\\').pop();
                if (fileName) {
                    $('#fileName').text(fileName);
                    $('#selectedFile').show();
                }
            });
            
            // Drag and drop handling
            const uploadArea = $('#uploadArea');
            
            uploadArea.on('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('dragover');
            });
            
            uploadArea.on('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('dragover');
            });
            
            uploadArea.on('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('dragover');
                
                const files = e.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    $('#csv_file')[0].files = files;
                    $('#fileName').text(files[0].name);
                    $('#selectedFile').show();
                }
            });
            
            // Form submission
            $('#importForm').on('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                // Reset UI
                $('#resultContainer').hide();
                $('#progressContainer').show();
                $('#importBtn').prop('disabled', true).text('Importing...');
                $('#progressFill').css('width', '50%').text('Processing...');
                
                // AJAX request
                $.ajax({
                    url: '/HR/Employee/importEmployeesFromCSV',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#progressFill').css('width', '100%').text('Complete!');
                        
                        setTimeout(function() {
                            $('#progressContainer').hide();
                            displayResults(response);
                            $('#importBtn').prop('disabled', false).text('Import Employees');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        $('#progressContainer').hide();
                        displayError('Server error: ' + error);
                        $('#importBtn').prop('disabled', false).text('Import Employees');
                    }
                });
            });
            
            function displayResults(response) {
                const result = typeof response === 'string' ? JSON.parse(response) : response;
                const container = $('#resultContainer');
                
                container.show();
                
                if (result.status === 'success') {
                    container.removeClass('error').addClass('success');
                    $('#resultTitle').text('Import Completed Successfully!');
                    $('#resultMessage').text(result.message);
                    
                    if (result.stats) {
                        $('#statsContainer').show();
                        $('#totalStat').text(result.stats.total || 0);
                        $('#successStat').text(result.stats.success || 0);
                        $('#failedStat').text(result.stats.failed || 0);
                        
                        // Display errors if any
                        if (result.stats.errors && result.stats.errors.length > 0) {
                            const errorList = $('#errorList');
                            errorList.empty().show();
                            
                            result.stats.errors.forEach(function(error) {
                                errorList.append('<div class="error-item">' + error + '</div>');
                            });
                        }
                    }
                } else {
                    displayError(result.message);
                }
            }
            
            function displayError(message) {
                const container = $('#resultContainer');
                container.show();
                container.removeClass('success').addClass('error');
                $('#resultTitle').text('Import Failed');
                $('#resultMessage').text(message);
                $('#statsContainer').hide();
                $('#errorList').hide();
            }
        });
    </script>
</body>
</html>