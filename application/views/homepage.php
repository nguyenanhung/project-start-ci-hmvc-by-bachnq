<div class="content_top">
    <div class="row">
        <?php
        if (!isset($random_posts)) {
            die;
        }
        ?>
        <div class="col-lg-6 col-md-6 col-sm6">
            <div class="latest_slider">
                <div class="slick_slider">
                    <?php
                    $slide = count($random_posts) - 4;
                    for ($i = 0; $i < $slide; $i++) {
                        $post = array_shift($random_posts);
                        ?>
                        <div class="single_iteam"><img src="<?php echo $post->feature_img ?>" alt="">
                            <h2>
                                <a class="slider_tittle"
                                   href="<?php echo site_url('article/' . $post->slug) ?>"><?php echo $post->title ?></a>
                            </h2>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm6">
            <div class="content_top_right">
                <ul class="featured_nav wow fadeInDown">
                    <?php
                    while (!empty($random_posts)) {
                        $post = array_shift($random_posts);
                        ?>
                        <li>
                            <img src="<?php echo $post->feature_img ?>" alt="">
                            <div class="title_caption">
                                <a href="<?php echo site_url('article/'.$post->slug) ?>"><?php echo $post->title ?></a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>


                </ul>
            </div>
        </div>
    </div>
</div>

<div class="content_bottom">
    <div class="col-lg-8 col-md-8">
        <?php
        if (isset($setting['cat_in_home'])) {
            $homes = explode(',', $setting['cat_in_home']);
        } else {
            $homes = $this->category->getAllActiveCategories();
        }
        ?>
        <div class="content_bottom_left">
            <?php
            while (!empty($homes)) {
                if (count($homes) >= 3) {
                    for ($i = 0; $i < 3; $i++) {
                        $cat[$i] = array_shift($homes);
                        $id = isset($cat[$i]->id) ? $cat[$i]->id : $cat[$i];
                        $cat[$i] = $this->category->getCategory($id);
                        $posts[$i] = $this->post_cat->getPostsInCategory($cat[$i]->id, 4);
                    }
                    ?>
                    <div class="single_category wow fadeInDown">
                        <h2><span class="bold_line"><span></span></span> <span class="solid_line"></span> <a
                                    class="title_text" href="#"><?php echo $cat[0]->name ?></a></h2>
                        <div class="business_category_left wow fadeInDown">
                            <ul class="fashion_catgnav">
                                <li>
                                    <div class="catgimg2_container">
                                        <a href="<?php $post = array_shift($posts[0]);
                                        echo site_url('article/' . $post->slug) ?>">
                                            <img alt="" src="<?php echo $post->feature_img ?>">
                                        </a>
                                    </div>
                                    <h2 class="catg_titile">
                                        <a href="<?php echo site_url('article/'.$post->slug) ?>"><?php echo $post->title ?></a>
                                    </h2>
                                    <div class="comments_box">
                                        <span class="meta_date">14/12/2045</span>
                                        <span class="meta_comment"><a href="#">No Comments</a></span>
                                        <span class="meta_more"><a href="#">Read More...</a></span>
                                    </div>
                                    <p><?php echo $post->excerpt ?> </p>
                                </li>
                            </ul>
                        </div>
                        <div class="business_category_right wow fadeInDown">
                            <ul class="small_catg">
                                <?php
                                while (!empty($posts[0])) {
                                    $post = array_shift($posts[0]);
                                    ?>
                                    <li>
                                        <div class="media wow fadeInDown"><a class="media-left"
                                                                             href="pages/single.html"><img
                                                        src="<?php echo $post->feature_img ?>" alt=""></a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a
                                                            href="<?php echo site_url('article/'.$post->slug)?>"><?php echo $post->title ?> </a>
                                                </h4>
                                                <div class="comments_box"><span class="meta_date">14/12/2045</span>
                                                    <span
                                                            class="meta_comment"><a href="#">No Comments</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                    <div class="games_fashion_area">
                        <div class="games_category">
                            <div class="single_category">
                                <h2><span class="bold_line"><span></span></span> <span class="solid_line"></span> <a
                                            class="title_text" href="#"><?php echo $cat[1]->name ?></a></h2>
                                <ul class="fashion_catgnav wow fadeInDown">
                                    <li>
                                        <?php $post = array_shift($posts[1]) ?>
                                        <div class="catgimg2_container">
                                            <a href="<?php echo site_url('article/'.$post->slug) ?>">
                                                <img alt="" src="<?php echo $post->feature_img ?>">
                                            </a>
                                        </div>
                                        <h2 class="catg_titile">
                                            <a href="#">
                                                <?php echo $post->title ?>
                                            </a>
                                        </h2>
                                        <div class="comments_box">
                                            <span class="meta_date">14/12/2045</span>
                                            <span class="meta_comment"><a href="#">No Comments</a></span>
                                            <span class="meta_more"><a href="#">Read More...</a></span>
                                        </div>
                                        <p><?php echo $post->excerpt ?></p>
                                    </li>
                                </ul>
                                <ul class="small_catg wow fadeInDown">
                                    <?php
                                    while (!empty($posts[1])) {
                                        $post = array_shift($posts[1]);
                                        ?>
                                        <li>
                                            <div class="media">
                                                <a class="media-left" href="#">
                                                    <img src="<?php echo $post->feature_img ?>" alt="">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        <a href="<?php echo site_url('article/'.$post->slug) ?>"><?php echo $post->title ?></a></h4>
                                                    <div class="comments_box">
                                                        <span class="meta_date">14/12/2045</span>
                                                        <span class="meta_comment"><a href="#">No Comments</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>


                                </ul>
                            </div>
                        </div>
                        <div class="fashion_category">
                            <div class="single_category">
                                <h2><span class="bold_line"><span></span></span> <span class="solid_line"></span> <a
                                            class="title_text" href="#"><?php echo $cat[2]->name ?></a></h2>
                                <ul class="fashion_catgnav wow fadeInDown">
                                    <li>
                                        <?php $post = array_shift($posts[2]) ?>
                                        <div class="catgimg2_container">
                                            <a href="pages/single.html">
                                                <img alt="" src="<?php echo $post->feature_img ?>">
                                            </a>
                                        </div>
                                        <h2 class="catg_titile">
                                            <a href="#">
                                                <?php echo $post->title ?>
                                            </a>
                                        </h2>
                                        <div class="comments_box">
                                            <span class="meta_date">14/12/2045</span>
                                            <span class="meta_comment"><a href="#">No Comments</a></span>
                                            <span class="meta_more"><a href="#">Read More...</a></span>
                                        </div>
                                        <p><?php echo $post->excerpt ?></p>
                                    </li>
                                </ul>
                                <ul class="small_catg wow fadeInDown">
                                    <?php
                                    while (!empty($posts[2])) {
                                        $post = array_shift($posts[2]);
                                        ?>
                                        <li>
                                            <div class="media">
                                                <a class="media-left" href="#">
                                                    <img src="<?php echo $post->feature_img ?>" alt="">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        <a href="#"><?php echo $post->title ?></a></h4>
                                                    <div class="comments_box">
                                                        <span class="meta_date">14/12/2045</span>
                                                        <span class="meta_comment"><a href="#">No Comments</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $cat = array_shift($homes);
                    $id = isset($cat->id) ? $cat->id : $cat;
                    $cat = $this->category->getCategory($id);
                    $posts = $this->post_cat->getPostsInCategory($cat->id, 4);

                    ?>
                    <div class="single_category wow fadeInDown">
                        <h2><span class="bold_line"><span></span></span> <span class="solid_line"></span> <a
                                    class="title_text" href="#"><?php echo $cat->name ?></a></h2>
                        <div class="business_category_left wow fadeInDown">
                            <ul class="fashion_catgnav">
                                <li>
                                    <div class="catgimg2_container">
                                        <a href="<?php $post = array_shift($posts);
                                        echo site_url('article/' . $post->slug) ?>">
                                            <img alt="" src="<?php echo $post->feature_img ?>">
                                        </a>
                                    </div>
                                    <h2 class="catg_titile">
                                        <a href="pages/single.html"><?php echo $post->title ?></a>
                                    </h2>
                                    <div class="comments_box">
                                        <span class="meta_date">14/12/2045</span>
                                        <span class="meta_comment"><a href="#">No Comments</a></span>
                                        <span class="meta_more"><a href="#">Read More...</a></span>
                                    </div>
                                    <p><?php echo $post->excerpt ?> </p>
                                </li>
                            </ul>
                        </div>
                        <div class="business_category_right wow fadeInDown">
                            <ul class="small_catg">
                                <?php
                                while (!empty($posts)) {
                                    $post = array_shift($posts);
                                    ?>
                                    <li>
                                        <div class="media wow fadeInDown">
                                            <a class="media-left" href="pages/single.html">
                                                <img src="<?php echo $post->feature_img ?>" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    <a href="pages/single.html"><?php echo $post->title ?> </a>
                                                </h4>
                                                <div class="comments_box">
                                                    <span class="meta_date">14/12/2045</span>
                                                    <span class="meta_comment"><a href="#">No Comments</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>


                            </ul>
                        </div>
                    </div>
                    <?php
                }
            }

            ?>


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
                                <div class="media wow fadeInDown">
                                    <a href="#" class="media-left">
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