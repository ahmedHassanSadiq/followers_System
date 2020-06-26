 <?php 


 include_once 'app/init.php';
 require_once 'inc/head.php';
 
  if(!isset($_SESSION["is_logged"])) {
    header("Location: is_not_logged.php");
} else {
    if(!isset($_SESSION["user_id"])){
        $index->setOtherSession($_SESSION["user"]["user_name"]);
    }
}
$id = $_SESSION["user"]["id"];
$suggest = $index->getAllUsersWithCond("WHERE user_id != $id");
?>
      <div class="container">
          
 <?php require_once 'inc/nav.php'; ?>
          
          <header>
            <div class="row">
                <div class="user-post col-md-8">
                  <div class="write-post">
                      <textarea id="post_content"></textarea>
                      <button class="btn btn-info" id="sub_content">post</button>
                  </div>
                  <div class="trending-now">
                      <div class="title_"> Last Posts</div>
                      <div class="posts">

                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="user-list">
                        <div class="title_">users list</div>
                        <?php foreach ($suggest as $sugg):?>
                        <div class="user_">
                            <div class="pic__">
                                <img src="libs/photos/<?php echo $sugg["profile_image"];?>" style="width: 100%;height: 100%">
                            </div>
                            <div class="det__">
                                <h5><?php echo $sugg["username"]?></h5>
                                <button class="follow btn bnt-success " id="follow" data-id="<?php echo $sugg["user_id"] ?>" 
                                        style="background-color: <?php echo $index->check_follow_exts($_SESSION['user']['id'] , $sugg["user_id"])?"red":"white" ;?>">
                                <?php echo $index->check_follow_exts($_SESSION['user']['id'] , $sugg["user_id"])?"unfollow":"follow" ;?>
                                </button>
                                <p><span><?php echo $sugg["follower_number"] ?></span> Followers</p>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </header>
      </div>
      
 <?php require_once 'inc/footer.php'; ?>

<script type="text/javascript">
    $(document).ready(function(){
        
        $("#sub_content").click(function(){
            var contents = $("#post_content").val();
            $.ajax({
                method : "POST" ,
                data : {content:contents},
                url : "ajax/setPost.php",
                success : function(data) {
                    if(data) {
                        //alert("post added");
                        $("#post_content").val("");
                    }else{
                        //alert("there is a trouble");
                    }
                }
             });
        });
        
        $(".follow").click(function(){
            var id = $(this).attr("data-id");
            var follow_num = parseInt($("button[data-id='" + id +"']").siblings("p").children().html());
            var num = $("button[data-id='" + id +"']").siblings("p").children().html();
            console.log(follow_num);
            $.ajax({
                method : "POST" ,
                data : {id:id},
                url : "ajax/follow.php",
                success : function(data) {
                    if(data) {
                        $("button[data-id='" + id +"']").css("backgroundColor" , "#F00");
                        $("button[data-id='" + id +"']").html("Unfollow");
                        $("button[data-id='" + id +"']").siblings("p").children().html(follow_num+1);
                    }else{
                        $("button[data-id='" + id +"']").css("backgroundColor" , "#FFF");
                        $("button[data-id='" + id +"']").html("follow");
                        $("button[data-id='" + id +"']").siblings("p").children().html(follow_num-1);
                    }
                }
             });
        });
        
        setInterval(function(){
            $(".posts").load("ajax/load_posts.php");
        },1000);
        
        
    });
</script>
