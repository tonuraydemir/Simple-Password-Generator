<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
$current_username = htmlspecialchars($_SESSION['username']); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="images/iuslogo.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/iuslogo.ico" type="image/x-icon">
    <title>User Dashboard | Password Generator</title>
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    
    <style>
      
        .hero_area.sub_page {
            min-height: auto;
        }
        .dashboard_section {
            padding: 40px 0 !important;
            background-color: #f8f8f8;
        }
        .dashboard_content {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            margin-bottom: 30px;
            min-height: 480px;
        }
        .save-btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
        }
        .save-btn:hover { background: #218838; }
        
    
        footer { background-color: #025599; padding: 60px 0; color: #ffffff; }
        footer h3, footer p, footer strong { color: #ffffff !important; }
        .widget_menu ul { padding: 0; list-style: none; }
        .widget_menu ul li a { color: #ffffff; opacity: 0.8; }
        .widget_menu ul li a:hover { opacity: 1; color: #28009fff; }
    </style>
</head>
<body>
    
    <div class="hero_area sub_page">
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="index.html">
                        <img width="250" src="images/projelogo1.png" alt="Logo" />
                    </a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <span class="nav-link" style="color:#0216ca; font-weight: 700;">Welcome, <?php echo $current_username; ?>!</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php" style="color: #f7444e; font-weight: bold;">Log Out</a> 
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
    </div>

    <section class="dashboard_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="dashboard_content generator-box">
                        <div class="heading_container">
                            <h3 style="margin-bottom: 20px;"> Generate and Save Password</h3>
                        </div>

                        <form id="savePasswordForm">
                            <div class="field mb-3">
                                <label for="siteName">Website Name</label>
                                <input type="text" id="siteName" name="site_name" class="form-control" placeholder="E.g., Instagram, Bank" required />
                            </div>

                            <div class="field mb-3">
                                <label for="generatedPassword">Generated Password</label>
                                <input type="text" id="generatedPassword" name="generated_password" class="form-control" readonly required />
                            </div>

                            <div class="field mb-3">
                                <label for="length">Password Length: <span id="lenVal">12</span></label>
                                <input type="range" id="length" min="8" max="32" value="12" class="form-control" oninput="document.getElementById('lenVal').innerText = this.value">
                            </div>
                            
                            <button type="button" id="generateBtn" class="btn btn-block font-weight-bold" style="background-color: #025599; color: #ffffff;">Generate New Password</button>
                            <button type="submit" class="save-btn">Save to My Password</button>

                            <div id="saveMessage" class="mt-3 text-center"></div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="dashboard_content">
                        <div class="heading_container">
                            <h3 style="margin-bottom: 20px;"> Saved Passwords</h3>
                        </div>
                        
                        <div id="passwordListDisplay">
                            <p class="text-muted">Loading your Password</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="full">
                        <div class="logo_footer">
                            <a href="#"><img width="210" src="images/projelogo1.png" alt="Logo" /></a>
                        </div>
                        <div class="information_f">
                            <p><strong>ADDRESS:</strong> Hrasnička cesta 15, 71210 Ilidža/Sarajevo</p>
                            <p><strong>TELEPHONE:</strong> +387 33 957 101</p>
                            <p><strong>EMAIL:</strong> info@ius.edu.ba</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="widget_menu">
                                <h3>Menu</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="signup.html">Sign Up</a></li>
                                    <li><a href="login.html">Log in</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-8">
                            <div class="widget_menu">
                                <h3>Location</h3>
                                <div class="map_container">
                                    <div id="googleMap" class="map">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2879.4627195439!2d18.310659715502573!3d43.82132797911579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4758ca200424072f%3A0x6e9a7e6e584a56a6!2sInternational%20University%20of%20Sarajevo!5e0!3m2!1sen!2sba!4v1620000000000!5m2!1sen!2sba" 
                                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="cpy_">
        <p class="mx-auto">© 2025 All Rights Reserved By Taha Onur Aydemir</p>
    </div>
    
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>
    // generating password!!
    document.getElementById('generateBtn').onclick = function() {
        const length = document.getElementById('length').value;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
        let password = "";
        for (let i = 0; i < length; ++i) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        document.getElementById('generatedPassword').value = password;
    };
    
    // taking passwords for displaying
    function fetchPasswords() {
        $.ajax({
            url: 'fetch_passwords.php',
            type: 'GET',
            success: function(response) {
                $('#passwordListDisplay').html(response);
            },
            error: function() {
                $('#passwordListDisplay').html('<p class="text-danger">Error loading vault.</p>');
            }
        });
    }

  
    $('#savePasswordForm').on('submit', function(e) {
        e.preventDefault();
        if ($('#generatedPassword').val() === '') {
             $('#saveMessage').html('<span class="text-danger">Generate a password first!</span>');
             return;
        }

        $.ajax({
            url: 'save_password.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#saveMessage').html('<span class="text-success">' + response + '</span>');
                fetchPasswords(); 
                $('#generatedPassword').val(''); 
                $('#siteName').val(''); 
                setTimeout(() => { $('#saveMessage').html(''); }, 3000);
            }
        });
    });

    
    function deletePassword(id) {
        if(confirm("Are you sure you want to delete this password?")) {
            $.post('delete_password.php', { id: id }, function(res) {
                if(res.trim() === "Deleted") {
                    fetchPasswords(); 
                } else {
                    alert("Error: " + res);
                }
            });
        }
    }

   
    $(document).ready(function() {
        fetchPasswords();
    });
    </script>
</body>
</html>