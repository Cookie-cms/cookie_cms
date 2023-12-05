<!-- <?php 

// if (isset($_SESSION['id']) && isset($_SESSION['uuid'])) {
// include 'inc/header.php';
?> -->
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', true);
// require_once"";

// require __CF__ . 'staticinfo.php';
require_once __CD__ . 'admin/verify.php';
require_once __CD__ . 'admin/users.php';
require __CF__ . 'staticinfo.php';

// $users = include 'users.php';
// require_once __RD__ . '/index.php';
?>
    <!DOCTYPE html>
    <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         <!-- <link href="css/home.css"> -->
         <title><?php echo $titlepage ?> &#x2022 admin</title>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
         <!-- <link rel="stylesheet" href="css/home.css"> -->
         <link rel="stylesheet" href="<?php echo __TDS__; ?>css/main.css">
    </head>
    <body>
    <!-- <div id="navbarContainer"></div> -->
<div class="container mt-3">
    <!-- <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="toggleButton" checked>
        <label class="form-check-label" for="toggleButton">Toggle Dark Mode</label>
    </div> -->
</div>

    </div>
    
      <!-- <span class="slider"></span> -->
    </label>
    
         <div class="container rounded  mt-5">
                             
            <div class="row">
                <div class="col-md-4 border-right">
                </div>
                <!-- <div class="col-md-8 w-50"> -->
                <input type="text" class="form-control" id="searchInput" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Search by ID or username" style="width: 300px; margin-bottom: 10px;">                
                <div style="height: 600px; overflow-y: auto;" class="rounded-4">  
                <table id="userslist" class="table">          
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">username</th>
                                <th scope="col">uuid</th>
                                <th scope="col">perm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) { ?>
                                <tr class="user-row">
                                    <td><?= $user['id'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['uuid'] ?></td>
                                    <td><?php
                                        switch ($user['perm']) {
                                            case 1:
                                                echo '<a style="color:grey">Player</a>';
                                                break;
                                            case 2:
                                                echo '<a style="color:blue">HD access</a>';
                                                break;
                                            case 3:
                                                echo '<a style="color:red">Admin</a>';
                                                break;
                                            case 4:
                                                echo '<a style="color:purple">Owner</a>';
                                                break;
                                        }
                                    ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                </table>
                </div>
            </div>

                    </div>
                </div>
            </div>
        </div>
        <script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var searchText = $(this).val().toLowerCase();

            $('#userslist tbody tr').each(function() {
                var id = $(this).find('td:nth-child(1)').text().toLowerCase(); // Index of ID column (change as per your table)
                var username = $(this).find('td:nth-child(2)').text().toLowerCase(); // Index of Username column (change as per your table)

                if (id.includes(searchText) || username.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
    </body>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <div class="background-image"></div> -->
    <!-- <?php 
    // }else{
        //  header("Location: index.php");
        //  exit();
        // echo "nope"; 
    // }
    //  ?>
    