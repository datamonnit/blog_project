<?php 

// edit_user.php
// Returns userdata in JSON-format

session_start(); 

// check if id-param is set
if (filter_has_var(INPUT_GET, 'id')){
    $id = $_GET['id'];
} else {
    $data = array(
        'status' => 'error',
        'message' => 'id not set'
    );
    
    echo json_encode($data);
    die();
}

include 'layout/header.php'; 
?>
    
    <h1 class="display-3">Edit user data</h1>
    <?php if (isset($msg)): ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form action="new_user.php" method="post">
        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input class="form-control" type="text" name="firstname" id="firstname" value="">
        </div>
        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input class="form-control" type="text" name="lastname" id="lastname" value="">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="">
        </div>
        <div class="form-group">
            <label for="passwd2">Password hint</label>
            <input class="form-control" type="text" name="password_hint" id="password_hint">
        </div>
        
        <input class="btn btn-primary" type="submit" name="save_btn" value="Save changes">
    </form>

<script>
window.addEventListener("load", getUserData(<?php echo $id; ?>));

function getUserData(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(JSON.parse(this.responseText));
            let userData = JSON.parse(this.responseText);
            document.getElementById('firstname').value = userData['firstname'];
            document.getElementById('lastname').value = userData['lastname'];
            document.getElementById('email').value = userData['email'];
            document.getElementById('password_hint').value = userData['password_hint'];
        }
    };
    xmlhttp.open("GET", "get_user_data.php?id=" + id, true);
    xmlhttp.send();
}

</script>

    <?php include 'layout/footer.php'; ?>