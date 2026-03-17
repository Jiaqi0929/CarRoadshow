<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Car RoadShow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: #000000;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
        }
        
        .container {
            width: 80%;
            max-width: 200px;
            padding: 20px;
            text-align: center;
        }
        
        /* Animation Section */
        .animation-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column; 
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.9);
            z-index: 10;
        }
        
        .car-image {
            width: 300px;
            height: 300px;
            position: relative;
            animation: pulse 3s infinite;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .lexus-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            opacity: 0;
            animation: fadeInOut 4s infinite;
        }
        
        /* Form Section */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 700px;
            color: #333;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            display: none; 
            text-align: left;
            opacity: 0; 
            transition: opacity 1s ease;
            margin: 100px auto;
            position: relative;
        }

        .form-container:hover{
            box-shadow: 0 0 50px rgba(255, 255, 255, 0.903);
            transition: all 0.3s ease;
            transform: translateY(-0.1875rem);
        }

        .form-title {
            color: #000000;
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 700;
        }

        .form-text {
            color: #000000;
            text-align: justify;
            margin-bottom: 25px;
        }
        
        .form-section {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .section-title {
            color: #000000;
            margin-top: 20px;
            margin-bottom: 15px;
            margin-top: 40px;
            font-size: 18px;
            font-weight: 600;
        }

        .form-footer {
            color: #ffffff;
            text-align: center;
            margin-bottom: 50px;
        }
        
        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555555;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 14px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:hover, select:hover, textarea:hover {
            border-color: #000000;
        }
        
        input:focus, select:focus, textarea:focus {
            border-color: #000000;
            outline: none;
        }
        
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
            flex: 0 0 calc(50% - 15px);
            position: relative;
            cursor: pointer;
            accent-color: #000000; 
        }
        
        .checkbox-item input {
            width: auto;
            margin-right: 8px;
        }

        /* Error states */
        input.error, select.error, textarea.error {
            border-color: #e10e21;
            background-color: #ffe6e6;
        }
        
        .error-message {
            color: #e10e21;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .btn {
            background: #000000;
            color: rgb(255, 255, 255);
            border: none;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            width: 80%;
            padding: 15px;
            display: block;
            margin: 0 auto;
        }
        
        .btn:hover {
            transition: transform 0.3s ease;
            transform: scale(1.02);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        
        /* Animations */
        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.5; }
        }
        
        @keyframes fadeInOut {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
        
        .show-form {
            display: block;
            opacity: 1;
        }

        .hidden {
            display: none;
        }

        .expiry-date-display {
            margin-top: 10px;
            padding: 10px;
            background: #cdffd6;
            border-radius: 8px;
            border: 1px solid #a7ffb0;
            display: none;
            font-weight: 500;
            color: #0d8504;
        }

        .expiry-date-display.visible {
            display: block;
        }

        .expiry-date-display.expiring-soon {
            background: #fff3cd;
            border-color: #ffeaa7;
            color: #856404;
        }

        .expiry-date-display.expired {
            background: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        
        /* File Upload */
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-upload-btn {
            background: #f1f1f1;
            color: #2b2b2b;
            padding: 12px 20px;
            border-radius: 8px;
            border: 2px dashed #000000;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: background 0.3s;
        }
        
        .file-upload input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .file-name {
            margin-top: 10px;
            font-size: 16px;
            color: #666;
        }

        .file-info {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            gap: 10px;
        }

        .file-info i {
            color: #6c757d;
            font-size: 16px;
        }

        .file-name {
            flex: 1;
            color: #495057;
            font-weight: 500;
            margin-bottom: 0.8rem;
        }

        .btn-change-file {
            background: #6c757d;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background 0.3s;
        }

        .btn-change-file:hover {
            background: #5a6268;
        }

        /* Hide file upload when file is selected */
        .file-upload.hidden {
            display: none;
        }

        .file-info-container.visible {
            display: block !important;
        }
        
        /* Date field with button */
        .date-with-button {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .date-with-button input {
            flex: 1;
        }
        
        .btn-change-date {
            background: #6c757d;
            color: white;
            border: none;
            padding: 14px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background 0.3s;
            white-space: nowrap;
        }
        
        .btn-change-date:hover {
            background: #5a6268;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .checkbox-item {
                flex: 0 0 100%;
            }
            
            .form-container {
                padding: 20px;
                margin: 20px;
            }
            
            .date-with-button {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-change-date {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    
    <!-- Animation Section -->
    <div class="animation-container" id="animationContainer">
        <div class="car-image">
            <img src="https://img.freepik.com/premium-vector/car-racing-logo_852937-4458.jpg?semt=ais_rp_50_assets&w=740&q=80" alt="Car Logo">  
        </div>
    </div>
    
    <!-- Form Container -->
    <div class="form-container" id="formContainer">
        <h2 class="form-title">CAR ROADSHOW<br>(04 - 08 AUG 2025)</h2>
        <p class="form-text">The Malaysia Personal Data Protection Act has taken place effective 15 November 2013. By filling out this form, you consent to the use of your personal information by Car Sdn Bhd for marketing communications.
        <br><br>Please take a clear photo of the front and back of your driver's license.</p>
        <form id="formContent">
            <!-- Personal Information -->
            <div class="form-section">
                <h3 class="section-title">Personal Information</h3>
                
                <div class="form-group">
                    <label for="fullName">Full Name (As per NRIC) *</label>
                    <input type="text" id="fullName" name="fullName" required placeholder="Enter your full name">
                    <div class="error-message" id="fullNameError">Please enter your full name</div>
                </div>
                
                <div class="form-group">
                    <label for="contactNumber">Contact Number *</label>
                    <input type="tel" id="contactNumber" name="contactNumber" required placeholder="e.g. 60123456789">
                    <div class="error-message" id="contactNumberError">Please enter a valid contact number starting with 60 </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required placeholder="e.g. ali@gmail.com">
                    <div class="error-message" id="emailError">Please enter a valid email address</div>
                </div>
                
                <div class="form-group">
                    <label for="gender">Gender *</label>
                    <select id="gender" name="gender" required >
                        <option value=""disabled selected>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div class="error-message" id="genderError">Please select your gender</div>
                </div>
                
                <div class="form-group">
                    <label for="ageRange">Age Range *</label>
                    <select id="ageRange" name="ageRange" required >
                        <option value=""disabled selected>Select your age range</option>
                        <option value="18-24">18-24</option>
                        <option value="25-34">25-34</option>
                        <option value="35-44">35-44</option>
                        <option value="45-54">45-54</option>
                        <option value="55-64">55-64</option>
                        <option value="65+">65+</option>
                    </select>
                    <div class="error-message" id="ageRangeError">Please select your age range</div>
                </div>
                
                <div class="form-group">
                    <label for="monthlyIncome">Monthly Income *</label>
                    <select id="monthlyIncome" name="monthlyIncome" required >
                        <option value="" disabled selected>Select your monthly income</option>
                        <option value="under-2500">Under RM2,500</option>
                        <option value="2500-5000">RM2,500 - RM5,000</option>
                        <option value="5000-7500">RM5,000 - RM7,500</option>
                        <option value="7500-10000">RM7,500 - RM10,000</option>
                        <option value="10000-15000">RM10,000 - RM15,000</option>
                        <option value="15000-20000">RM15,000 - RM20,000</option>
                        <option value="over-20000">Over RM20,000</option>
                    </select>
                    <div class="error-message" id="monthlyIncomeError">Please select your monthly income</div>
                </div>

                <div class="form-group">
                    <label for="consultant">Who is your assigned sales consultant? *</label>
                    <select id="consultantName" name="consultantName" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Select Consultant</option>
                        <option value="Aiman">Aiman</option>
                        <option value="Farah">Farah</option>
                        <option value="Daniel">Daniel</option>
                        <option value="Nadia">Nadia</option>
                    </select>
                    <div class="error-message" id="consultantError">Please select a consultant</div>
                </div>
            
                <!-- Vehicle Information -->
                <h3 class="section-title">Vehicle Information</h3>
                <div class="form-group">
                    <label>Which of the following car model you are interested in? *</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="LBX" name="carModel" value="LBX">
                            <label for="LBX">LBX - Urban Compact Hatchback</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="NX" name="carModel" value="NX">
                            <label for="NX">NX - Premium Family SUV</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="RZ" name="carModel" value="RZ">
                            <label for="RZ">RZ - Electric Performance SUV</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="ES" name="carModel" value="ES">
                            <label for="ES">ES - Executive Sedan</label>
                        </div>
                    </div>
                    <div class="error-message" id="carModelError">Please select at least one car model</div>
                </div>
                
                <div class="form-group">
                    <label for="testDrive">Would you like to test drive the vechicle? *</label>
                    <select id="testDrive" name="testDrive" required >
                        <option value=""disabled selected>Select your choice</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <div class="error-message" id="testDriveError">Please select your choice</div>
                </div>
                
                <div class="form-group">
                    <label for="drivingLicenseExpiryDate">Driving License Expiry Date *</label>
                    <div class="date-with-button">
                        <input type="date" id="drivingLicenseExpiryDate" name="drivingLicenseExpiryDate" required>
                        <button type="button" class="btn-change-date" id="changeDateBtn">
                            <i class="fas fa-edit"></i> Change Date
                        </button>
                    </div>
                    <div class="error-message" id="drivingLicenseExpiryDateError">Please select your driving license expiry date</div>
                    
                    <!-- Expiry date display -->
                    <div class="expiry-date-display" id="expiryDateDisplay">
                        Your license expires in: <span id="daysRemaining"></span> days
                    </div>
                </div>

                <!-- File Upload -->
                <div class="form-group">
                    <label for="fileUpload">Driving License *</label>
                    <p class="form-text">Upload 1 supported file. Max 10 MB.</p>
                    
                    <!-- Initial upload button -->
                    <div class="file-upload" id="fileUploadContainer">
                        <div class="file-upload-btn">
                            <i class="fas fa-cloud-upload-alt"></i>&nbsp; Choose File
                        </div>
                        <input type="file" id="fileUpload" name="fileUpload" required accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                    </div>
                    
                    <!-- File info and replace button -->
                    <div class="file-info-container" id="fileInfoContainer" style="display: none;">
                        <div class="file-info">
                            <i class="fas fa-file"></i>
                            <span class="file-name" id="fileNameDisplay">No file chosen</span>
                            <button type="button" class="btn-change-file" id="changeFileBtn">
                                <i class="fas fa-sync-alt" style="color: white; margin: 0.5rem 0;"></i> Change File
                            </button>
                        </div>
                    </div>
                    
                    <div class="error-message" id="fileUploadError">Please upload your driving license</div>
                </div>
            </div>
            <button type="submit" class="btn">Submit Registration</button>
        </form>
        <div class="form-footer">
            By submitting this form, you agree to our Terms and Privacy Policy
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animationContainer = document.getElementById('animationContainer');
            const formContainer = document.getElementById('formContainer');
            const fileName = document.getElementById('fileName');
            const form = document.getElementById('formContent');
            
            setTimeout(() => {
                animationContainer.classList.add('fade-out');
                setTimeout(() => {
                    animationContainer.classList.add('hidden');
                    formContainer.style.display = 'block';
                    setTimeout(() => {
                        formContainer.classList.add('show-form');
                    }, 50); 
                    document.body.style.overflow = 'auto';
                }, 1000);
            }, 2000);

            // File upload functionality
            const fileUpload = document.getElementById('fileUpload');
            const fileUploadContainer = document.getElementById('fileUploadContainer');
            const fileInfoContainer = document.getElementById('fileInfoContainer');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            const changeFileBtn = document.getElementById('changeFileBtn');

            // Handle file selection
            fileUpload.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const fileName = file.name;
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Size in MB
                    
                    // Validate file size (10MB max)
                    if (file.size > 10 * 1024 * 1024) {
                        alert('File size must be less than 10MB');
                        this.value = '';
                        return;
                    }
                    
                    // Validate file type
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Please upload a valid file type (JPG, PNG, PDF, DOC, DOCX)');
                        this.value = '';
                        return;
                    }
                    
                    // Update UI
                    fileNameDisplay.textContent = `${fileName} (${fileSize} MB)`;
                    fileUploadContainer.classList.add('hidden');
                    fileInfoContainer.style.display = 'block';
                    
                    // Clear any error
                    document.getElementById('fileUploadError').style.display = 'none';
                } else {
                    // No file selected, show upload button
                    fileUploadContainer.classList.remove('hidden');
                    fileInfoContainer.style.display = 'none';
                    fileNameDisplay.textContent = 'No file chosen';
                }
            });

            // Handle change file button
            changeFileBtn.addEventListener('click', function() {
                // Trigger the file input click
                fileUpload.click();
            });

            // Update the validateFileUpload function
            function validateFileUpload() {
                const error = document.getElementById('fileUploadError');
                if (!fileUpload.value) {
                    error.style.display = 'block';
                    return false;
                } else {
                    error.style.display = 'none';
                    return true;
                }
            }
            
            // Date change button functionality
            const changeDateBtn = document.getElementById('changeDateBtn');
            const expiryDateInput = document.getElementById('drivingLicenseExpiryDate');
            
            changeDateBtn.addEventListener('click', function() {
                // Focus on the date input and open the date picker
                expiryDateInput.focus();
                expiryDateInput.showPicker && expiryDateInput.showPicker();
            });

            // Calculate and display expiry info
            function updateExpiryDateDisplay() {
                const expiryDateInput = document.getElementById('drivingLicenseExpiryDate');
                const displayElement = document.getElementById('expiryDateDisplay');
                const daysRemainingElement = document.getElementById('daysRemaining');
                
                if (expiryDateInput.value) {
                    const expiryDate = new Date(expiryDateInput.value);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    
                    const timeDiff = expiryDate - today;
                    const daysRemaining = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                    
                    displayElement.classList.add('visible');
                    daysRemainingElement.textContent = daysRemaining;
                    
                    // Remove all status classes
                    displayElement.classList.remove('expiring-soon', 'expired');
                    
                    // Add appropriate status class
                    if (daysRemaining < 0) {
                        displayElement.classList.add('expired');
                        daysRemainingElement.textContent = 'EXPIRED (' + Math.abs(daysRemaining) + ' days ago)';
                    } else if (daysRemaining <= 30) {
                        displayElement.classList.add('expiring-soon');
                    }
                } else {
                    displayElement.classList.remove('visible');
                }
            }

            // Add event listener for date change
            document.getElementById('drivingLicenseExpiryDate').addEventListener('change', updateExpiryDateDisplay);

            // Validation functions
            function validateFullName() {
                const fullName = document.getElementById('fullName');
                const error = document.getElementById('fullNameError');
                if (fullName.value.trim() === '') {
                    showError(fullName, error);
                    return false;
                } else {
                    hideError(fullName, error);
                    return true;
                }
            }
            
            function validateContactNumber() {
                const contactNumber = document.getElementById('contactNumber');
                const error = document.getElementById('contactNumberError');
                const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
                if (contactNumber.value.trim() === '' || !phoneRegex.test(contactNumber.value.replace(/[\s\-\(\)]/g, ''))) {
                    showError(contactNumber, error);
                    return false;
                } else {
                    hideError(contactNumber, error);
                    return true;
                }
            }
            
            function validateEmail() {
                const email = document.getElementById('email');
                const error = document.getElementById('emailError');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email.value.trim() === '' || !emailRegex.test(email.value)) {
                    showError(email, error);
                    return false;
                } else {
                    hideError(email, error);
                    return true;
                }
            }
            
            function validateGender() {
                const gender = document.getElementById('gender');
                const error = document.getElementById('genderError');
                
                if (gender.value === '') {
                    showError(gender, error);
                    return false;
                } else {
                    hideError(gender, error);
                    return true;
                }
            }
            
            function validateAgeRange() {
                const ageRange = document.getElementById('ageRange');
                const error = document.getElementById('ageRangeError');
                
                if (ageRange.value === '') {
                    showError(ageRange, error);
                    return false;
                } else {
                    hideError(ageRange, error);
                    return true;
                }
            }

            function validateMonthlyIncome() {
                const monthlyIncome = document.getElementById('monthlyIncome');
                const error = document.getElementById('monthlyIncomeError');
                
                if (monthlyIncome.value === '') {
                    showError(monthlyIncome, error);
                    return false;
                } else {
                    hideError(monthlyIncome, error);
                    return true;
                }
            }
            
            function validateConsultant() {
                const consultant = document.getElementById('consultantName'); 
                const error = document.getElementById('consultantError');
                
                if (!consultant || consultant.value === '') {
                    if (consultant) showError(consultant, error);
                    return false;
                } else {
                    if (consultant) hideError(consultant, error);
                    return true;
                }
            }
            
            function validateCarModel() {
                const checkboxes = document.querySelectorAll('input[name="carModel"]');
                const error = document.getElementById('carModelError');
                let atLeastOneChecked = false;
                for (const checkbox of checkboxes) {
                    if (checkbox.checked) {
                        atLeastOneChecked = true;
                        break;
                    }
                }
                if (!atLeastOneChecked) {
                    error.style.display = 'block';
                    return false;
                } else {
                    error.style.display = 'none';
                    return true;
                }
            }
            
            function validateTestDrive() {
                const testDrive = document.getElementById('testDrive');
                const error = document.getElementById('testDriveError');
                
                if (testDrive.value === '') {
                    showError(testDrive, error);
                    return false;
                } else {
                    hideError(testDrive, error);
                    return true;
                }
            }
            
            function validateDrivingLicenseExpiryDate() {
                const drivingLicenseExpiryDate = document.getElementById('drivingLicenseExpiryDate');
                const error = document.getElementById('drivingLicenseExpiryDateError');
                
                if (drivingLicenseExpiryDate.value === '') {
                    showError(drivingLicenseExpiryDate, error);
                    return false;
                } else {
                    hideError(drivingLicenseExpiryDate, error);
                    return true;
                }
            }
            
            function showError(field, errorElement) {
                field.classList.add('error');
                errorElement.style.display = 'block';
            }
            
            function hideError(field, errorElement) {
                field.classList.remove('error');
                errorElement.style.display = 'none';
            }
            
            // Add event listeners for real-time validation
            document.getElementById('fullName').addEventListener('blur', validateFullName);
            document.getElementById('contactNumber').addEventListener('blur', validateContactNumber);
            document.getElementById('email').addEventListener('blur', validateEmail);
            document.getElementById('gender').addEventListener('change', validateGender);
            document.getElementById('ageRange').addEventListener('change', validateAgeRange);
            document.getElementById('monthlyIncome').addEventListener('change', validateMonthlyIncome);
            document.getElementById('consultantName').addEventListener('blur', validateConsultant);
            const modelCheckboxes = document.querySelectorAll('input[name="carModel"]');
            for (const checkbox of modelCheckboxes) {
                checkbox.addEventListener('change', validateCarModel);
            }
            // File upload validation
            fileUpload.addEventListener('change', validateFileUpload);
            function validateFileUpload() {
                const error = document.getElementById('fileUploadError');
                if (!fileUpload.value) {
                    error.style.display = 'block';
                    return false;
                } else {
                    error.style.display = 'none';
                    return true;
                }
            }
            document.getElementById('testDrive').addEventListener('change', validateTestDrive);
            document.getElementById('drivingLicenseExpiryDate').addEventListener('change', validateDrivingLicenseExpiryDate);

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                console.log('Form submission started...');
                
                // Validate all fields
                const isFullNameValid = validateFullName();
                const isContactValid = validateContactNumber();
                const isEmailValid = validateEmail();
                const isGenderValid = validateGender();
                const isAgeRangeValid = validateAgeRange();
                const isMonthlyIncomeValid = validateMonthlyIncome();
                const isConsultantValid = validateConsultant();
                const isCarModelValid = validateCarModel();
                const isTestDriveValid = validateTestDrive();
                const isDrivingLicenseExpiryDateValid = validateDrivingLicenseExpiryDate();
                const isFileValid = validateFileUpload();

                console.log('Validation results:', {
                    isFullNameValid, isContactValid, isEmailValid, isGenderValid,
                    isAgeRangeValid, isMonthlyIncomeValid, isConsultantValid, isCarModelValid,
                    isTestDriveValid, isDrivingLicenseExpiryDateValid, isFileValid
                });

                if (!(isFullNameValid && isContactValid && isEmailValid && isGenderValid && 
                    isAgeRangeValid && isMonthlyIncomeValid && isConsultantValid && isCarModelValid && 
                    isTestDriveValid && isDrivingLicenseExpiryDateValid && isFileValid)) {
                    console.log('Validation failed');
                    return false;
                }

                // Collect form data
                const formData = new FormData();
                formData.append('fullName', document.getElementById('fullName').value);
                formData.append('contactNumber', document.getElementById('contactNumber').value);
                formData.append('email', document.getElementById('email').value);
                formData.append('gender', document.getElementById('gender').value);
                formData.append('ageRange', document.getElementById('ageRange').value);
                formData.append('monthlyIncome', document.getElementById('monthlyIncome').value);
                formData.append('consultant', document.getElementById('consultantName').value);

                // For checkboxes
                const carModels = Array.from(document.querySelectorAll('input[name="carModel"]:checked')).map(cb => cb.value);
                carModels.forEach(model => formData.append('carModel[]', model));
                
                formData.append('testDrive', document.getElementById('testDrive').value);
                formData.append('drivingLicenseExpiryDate', document.getElementById('drivingLicenseExpiryDate').value);
                
                // Append the actual file
                if (fileUpload.files[0]) {
                    formData.append('fileUpload', fileUpload.files[0]);
                }

                console.log('Sending data to: submit_client.php');

                try {
                    const response = await fetch(`submit_client.php`, { 
                        method: 'POST',
                        body: formData
                    });

                    console.log('Response status:', response.status);
                    
                    const responseText = await response.text();
                    console.log('Response text:', responseText);
                    
                    let result;
                    try {
                        result = JSON.parse(responseText);
                    } catch (parseError) {
                        console.error('Failed to parse JSON:', parseError);
                        throw new Error('Invalid response from server');
                    }
                    
                    console.log('Parsed result:', result);
                    
                    if (result.success) {
                        alert('Thank you for registering for the CAR ROADSHOW! Your information has been recorded.');
                        form.reset();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        fileUploadContainer.classList.remove('hidden');
                        fileInfoContainer.style.display = 'none';
                        document.getElementById('expiryDateDisplay').classList.remove('visible');
                    } else {
                        alert('Submission failed: ' + (result.message || 'Please try again later.'));
                    }
                } catch (error) {
                    console.error('Error submitting form:', error);
                    alert('An error occurred while submitting your form: ' + error.message);
                }
            });

            function resetForm() {
            // Reset all form fields
            form.reset();
            
            // Reset file upload UI
            fileUploadContainer.classList.remove('hidden');
            fileInfoContainer.style.display = 'none';
            fileNameDisplay.textContent = 'No file chosen';
            fileUpload.value = '';
            
            // Reset expiry date display
            document.getElementById('expiryDateDisplay').classList.remove('visible');
            
            // Clear all error messages and styles
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(error => {
                error.style.display = 'none';
            });
            
            const errorFields = document.querySelectorAll('.error');
            errorFields.forEach(field => {
                field.classList.remove('error');
            });
            
            // Reset all dropdowns to their default state
            document.getElementById('gender').selectedIndex = 0;
            document.getElementById('ageRange').selectedIndex = 0;
            document.getElementById('monthlyIncome').selectedIndex = 0;
            document.getElementById('consultantName').selectedIndex = 0;
            document.getElementById('testDrive').selectedIndex = 0;
            
            // Reset checkboxes
            const checkboxes = document.querySelectorAll('input[name="carModel"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            
            // Reset date field
            document.getElementById('drivingLicenseExpiryDate').value = '';
            
            console.log('Form has been completely reset');
        }

        });
    </script>
</body>
</html>