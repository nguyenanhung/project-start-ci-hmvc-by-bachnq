<div class="content_bottom">
    <div class="col-lg-8 col-md-8">
        <div class="content_bottom_left">
            <div class="single_page_area">

                <h2 class="post_titile"><?php echo $post->title ?> </h2>
                <div class="single_page_content">
                    <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i>Wpfreeware</a> <span><i class="fa fa-calendar"></i>6:49 AM</span> <a href="#"><i class="fa fa-tags"></i>Technology</a> </div>
                    <img class="img-center" src="<?php echo $post->feature_img ?>" alt="">
                   <p><?php echo $post->content ?></p>
                </div>
            </div>
        </div>

        <div class="share_post"> <a class="facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a> <a class="twitter" href="#"><i class="fa fa-twitter"></i>Twitter</a> <a class="googleplus" href="#"><i class="fa fa-google-plus"></i>Google+</a> <a class="linkedin" href="#"><i class="fa fa-linkedin"></i>LinkedIn</a> <a class="stumbleupon" href="#"><i class="fa fa-stumbleupon"></i>StumbleUpon</a> <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>Pinterest</a> </div>

    </div>
    <div class="col-lg-4 col-md-4">
        <div class="content_bottom_right">
            <div class="single_bottom_rightbar">
                <h2>Recent Post</h2>
                <ul class="small_catg popular_catg wow fadeInDown">
                    <?php
                    if(isset($recentPosts)){
                        foreach ($recentPosts as $post){
                            ?>
                            <li>
                                <div class="media wow fadeInDown">
                                    <a href="#" class="media-left">
                                        <img alt="" src="<?php echo $post->feature_img ?>">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="<?php echo site_url('article/'.$post->slug)?>"><?php echo $post->title ?></a></h4>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>


                </ul>
            </div>

        </div>
    </div>
</div>