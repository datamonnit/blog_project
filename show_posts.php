<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['errors'][] = 'Login first to use system!';
    header('Location: login.php');
}

if (isset($_GET['topic_id'])){
    $topic = intval($_GET['topic_id']);
}

include 'layout/header.php'; 
?>
    <div class="row">
        <h1 class="display-3">Posts</h1>
    </div>

    <div class="row">
        <div class="col" id="content">
        
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h2>Add new post</h2>
            <form action="add_topic.php" method="post">
                <div class="form-group">
                    <label for="topic_name">Topic name </label>
                    <input class="form-control" type="text" name="topic_name" id="topic_name">
                </div>
                <div class="form-group">
                    <label for="topic_description">Topic description </label>
                    <input class="form-control" type="text" name="topic_description" id="topic_description">
                </div>
                <input class="btn btn-primary" type="submit" name="save_btn" value="Add">
            </form>
        </div>
    </div>

<script>

// Get params of the page after load and get all posts by id
window.addEventListener('load', (event) => {
  console.log(getUrlVars());
  let topicId = getUrlParam('topic_id','1');
  getPosts(topicId);
});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function getUrlParam(parameter, defaultvalue){
    var urlparameter = defaultvalue;
    if(window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
        }
    return urlparameter;
}

// This function calls php-skript to update database
function getPosts(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            let data = JSON.parse(this.responseText);
            if(data.status == 'error') {
                document.getElementById('content').innerHTML = data.message;
            } else {
                showPosts(data);
            }
            
        }
    };
    xmlhttp.open("GET", "app/get_posts.php?id=" + id, true);
    xmlhttp.send();
}

function showPosts(data){

    let target = document.getElementById('content');

    data.forEach(post => {
        console.log(post.topic);
        
    });
}

</script>
<?php
include 'layout/footer.php'; ?>