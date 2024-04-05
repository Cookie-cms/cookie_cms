
<?php
// session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', true);
// require_once"core/home/homemain.php";

// require __CF__ . 'staticinfo.php';
require_once __CD__ . 'home/main.php';
// require_once __RD__ . '/index.php';
?>
    <!DOCTYPE html>
    <html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         <!-- <link href="css/home.css"> -->
         <title><?php echo $titlepage ?> &#x2022 Home</title>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
         <!-- <link rel="stylesheet" href="css/home.css"> -->
         <link rel="stylesheet" href="<?php echo __TDS__; ?>css/main.css">
    </head>
    <body>
<div class="container mt-3">
</div>

    </div>

    </label>
    
         <div class="container rounded  mt-5">
                             
            <div class="row">
                <div class="col-md-4 border-right">
                   <canvas id="skin_container"></canvas>
                </div>
                <div class="col-md-8 w-50">
                    <div class="p-3 py-5">
                   </div>
                   <form method="post" action="core/home/update.php" enctype="multipart/form-data">
                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" placeholder="Username" value="" name="new_username" id="username">
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" placeholder="Password" value="" name="new_password" id="password">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <label for="skin" class="form-label">Skin:</label>
                                    <input class="form-control col-md-6" type="file" id="new_skin" name="new_skin">
                                </div>
                                <div class="col-md-6">
                                    <label for="cape" class="form-label" style="display: none;">Cape:</label>
                                    <input class="form-control col-md-6" type="file" id="cape" style="display: none;" disabled>
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <button class="btn btn-primary profile-button col-md-4" type="submit" name="update">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="<?php echo __RD__ ?>template/js/skinview3d.bundle.js"></script>

    <script>
        
    let skinViewer = new skinview3d.SkinViewer({
            canvas: document.getElementById("skin_container"),
            width: 300,
            height: 400,
            skin: "img/skin.png"
        });
    
        // Change viewer size
        skinViewer.width = 300;
        skinViewer.height = 600;
    
        // Load another skin
        // skinViewer.loadSkin("<?php echo __RD__; ?>uploads/skins/<?php echo $_SESSION['uuid']; ?>.png");
        skinViewer.loadSkin("<?php echo __RD__; ?>uploads/skins/<?php echo $_SESSION['uuid']; ?>.png");
    
        // Load a cape
        skinViewer.loadCape("/uploads/capes/<?php echo $_SESSION['uuid']; ?>.png");
    
        // skinViewer.loadSkin("<?php echo __RD__ ?>uploads/skins/Default.png");

        skinViewer.fov = 70;
    
        // Zoom out
        skinViewer.zoom = 0.5;
    
        skinViewer.autoRotate = false;
    
        skinViewer.animation = new skinview3d.IdleAnimation();
    
        skinViewer.animation.speed = 0.5;
    
        skinViewer.animation.paused = false;
    
        skinViewer.nameTag = "<?php echo $playername; ?>";
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
