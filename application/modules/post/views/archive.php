<div class="content_bottom">
    <div class="col-lg-8 col-md-8">
        <div class="content_bottom_left">
            <div class="single_category wow fadeInDown">
                <div class="archive_style_1">
                    <h2><span class="bold_line"><span></span></span> <span class="solid_line"></span> <span
                                class="title_text"><?php echo $category->name ?></span></h2>
                    <?php
                    if (isset($posts)) {
                        foreach ($posts as $post) {
                            ?>
                            <div class="business_category_left wow fadeInDown">
                                <ul class="fashion_catgnav">
                                    <li>
                                        <div class="catgimg2_container">
                                            <a href="<?php echo site_url('article/' . $post->slug) ?>">
                                                <img alt="" src="<?php echo $post->feature_img ?>">
                                            </a>
                                        </div>
                                        <h2 class="catg_titile"><a
                                                    href="<?php echo site_url('article/' . $post->slug) ?>"><?php echo $post->title ?></a>
                                        </h2>
                                        <div class="comments_box"><span class="meta_date">14/12/2045</span> <span
                                                    class="meta_comment"><a href="#">No Comments</a></span> <span
                                                    class="meta_more"><a
                                                        href="<?php echo site_url('article/' . $post->slug) ?>">Read More...</a></span>
                                        </div>
                                        <p><?php echo $post->excerpt ?></p>
                                    </li>
                                </ul>
                            </div>
                            <?php
                        }
                    }
                    ?>


                </div>
            </div>
        </div>

        <div class="pagination_area">
            <nav>
                <?php
                if ($number_page > 1) {
                    ?>
                    <ul class="pagination">
                        <?php
                        if ($current_page != 1) {
                            ?>
                            <li>
                                <a href="?p=<?php echo $current_page - 1 ?>"><span
                                            aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a>
                            </li>

                        <?php }
                        ?>

                        <?php
                        for ($i = $current_page - 2; $i < $current_page; $i++) {
                            if ($i <= 0) continue;
                            echo "<li><a href='?p=$i'>$i</a></li>";
                        }
                        ?>
                        <li><a href="#" class="pg-active"
                               style="background-color: #FFA500; color: #fff"><?php echo $current_page ?></a></li>
                        <?php
                        if ($current_page < $number_page - 3) {
                            $temp = $current_page + 3;
                        } else {
                            $temp = $number_page;
                        }
                        for ($i = $current_page + 1; $i < $temp; $i++) {
                            if ($i == 0) continue;
                            echo "<li><a href='?p=$i'>$i</a></li>";
                        }
                        ?>
                        <?php
                        if ($current_page != $number_page) {
                            ?>
                            <li>
                                <a href="?p=<?php echo $current_page + 1 ?>"><span
                                            aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a>
                            </li>

                        <?php }
                        ?>

                    </ul>
                    <?php
                }
                ?>
                <style>
                    .pg-active {
                        background-color: #ffa500;
                        color: #ffffff;
                    }
                </style>
            </nav>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="content_bottom_right">
            <div class="single_bottom_rightbar">
                <h2>Recent Post</h2>
                <ul class="small_catg popular_catg wow fadeInDown">
                    <?php
                    if (isset($recentPosts)) {
                        foreach ($recentPosts as $post) {
                            ?>
                            <li>
                                <div class="media wow fadeInDown"><a href="#" class="media-left">
                                        <img alt="" src="<?php echo $post->feature_img ?>">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a
                                                    href="<?php echo site_url('article/' . $post->slug) ?>"><?php echo $post->title ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>


                </ul>
            </div>

            <div class="single_bottom_rightbar wow fadeInDown">
                <h2>Popular Lnks</h2>
                <ul>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Blog Home</a></li>
                    <li><a href="#">Error Page</a></li>
                    <li><a href="#">Social link</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>