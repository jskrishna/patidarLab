<?php
include_once "./public/assets/includes/header.php";
?>

<body>
    <div class="login-from">
        <div id="container">
            <form id="update_form" action="" method="POST" enctype="multipart/form-data">
                <div class="message"></div>
                <div class="form-control">
                    <label for="name">Username</label>
                    <input type="text" class="required" value="<?php echo $UserData->name; ?>" name="name" placeholder="Enter Username">
                    <p style="display: none;" class="error">username required.</p>
                </div>
                <div class="form-control">
                    <label for="name">Email</label>
                    <input type="email" class="required" value="<?php echo $UserData->email; ?>" name="email" placeholder="Enter email">
                    <p style="display: none;" class="error">email required.</p>
                </div>
                <div class="form-control">
                    <label for="profilePic">Profile</label>
                    <input type="hidden" name="oldprofile" value="<?php echo $UserData->profile; ?>">
                    <input type="file" class="image-upload" accept="image/*" name="profilePic" id="profilePic" />
                </div>
                    <img style="width: 140px;" src="<?php echo BASE_URL?>public/assets/images/<?php echo $UserData->profile; ?>" alt="">
              
                <div class="form-control">
                    <input id="submitUpdate" type="button" class="btn" value="Update" name="Update">
                </div>
            </form>
        </div>
    </div>
		<p  class="footer"><a  href="<?php echo BASE_URL;?>logout"><button class="btn">Logout</button> </a></p>

</body>
<footer>
    <?php
    include_once "./public/assets/includes/footer.php";
    ?>
</footer>

</html>