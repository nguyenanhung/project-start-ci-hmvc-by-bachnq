<?php if (!isset($setting)) die; ?>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general">General</a></li>
    <li><a data-toggle="tab" href="#menu1">Hompage</a></li>
    <li><a data-toggle="tab" href="#menu2">Post</a></li>
    <li><a href="#menu3" data-toggle="tab">Category</a></li>
</ul>

<div class="tab-content">
    <div id="general" class="tab-pane fade in active">
        <h3>General</h3>
        <div class="form-group">
            <label for="">Site Name:</label>
            <input type="text" value="<?php if (isset($setting['site_name'])) echo $setting['site_name'] ?>"
                   class="form-control border-input" name="site-name">
        </div>
        <div class="form-group">
            <label for="">Tagline:</label>
            <input type="text" value="<?php if (isset($setting['tagline'])) echo $setting['tagline'] ?>"
                   class="form-control border-input" name="tagline">
        </div>
        <div class="form-group">
            <label for="">Logo</label>
            <input type="file" class="form-control border-input" name="logo-file" id="logo" value="ádfasdfas">
            <img style="margin-top: 20px" id="logo-img"
                 src="<?php if (isset($setting['logo_url'])) echo $setting['logo_url'] ?>" alt="your image"
                 width="200px"/>
        </div>
        <button class="btn btn-primary" type="button" id="save-gen">Save</button>
        <button class="btn btn-default cancel"  type="button">Cancel</button>
    </div>
    <div id="menu1" class="tab-pane fade">
        <h3>Homepage</h3>
        <div class="form-group">
            <label for="">Category in hompage:</label>
            <div class="form-group">

                <?php
                if (isset($categories)) {
                    if (isset($setting['cat_in_home'])){
                        $homes = explode(',',$setting['cat_in_home']);
                    }else{
                        $homes = array();
                    }
                    foreach ($categories as $cat) {
                        ?>
                        <div class="form-group">
                            <input class="" width="10px" type="checkbox" name="home"
                                   value="<?php echo $cat->id ?>" <?php  if (in_array($cat->id, $homes)) echo "checked='true'" ?> > <?php echo $cat->name ?>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <button class="btn btn-primary" type="button" id="save-home">Save</button>
        <button class="btn btn-default cancel"  type="button">Cancel</button>
    </div>
    <div id="menu2" class="tab-pane fade">
        <h3>Post</h3>
        <div class="form-group">
            <label for="">Number post/page:</label>
            <input type="text" class="form-control border-input"
                   value="<?php if (isset($setting['num_post_per_page'])) echo $setting['num_post_per_page'] ?>"
                   name="numpost">
        </div>
        <div class="form-group">
            <label for="">Number recent post :</label>
            <input type="text" value="<?php if (isset($setting['recent_post'])) echo $setting['recent_post'] ?>"
                   name="recent" class="form-control border-input">
        </div>
        <button class="btn btn-primary" type="button" id="save-post">Save</button>
        <button class="btn btn-default cancel"  type="button">Cancel</button>

    </div>
    <div id="menu3" class="tab-pane fade">
        <h3>Category</h3>
        <label for="">Category in Menu</label>
        <div class="form-group" >
            <?php
            if (isset($categories)) {
                if (isset($setting['cat_in_menu'])){
                    $menu = explode(',',$setting['cat_in_menu']);
                }else{
                    $menu = array();
                }
                foreach ($categories as $cat) {
                    ?>
                    <div class="form-group">
                        <input class="" width="10px" type="checkbox" name="menu"
                               value="<?php echo $cat->id ?>" <?php  if (in_array($cat->id, $menu)) echo "checked='true'" ?> > <?php echo $cat->name ?>
                    </div>

                    <?php
                }
            }
            ?>

        </div>

        <button class="btn btn-primary" id="save-cat" type="button">Save</button>
        <button class="btn btn-default cancel" type="button">Cancel</button>
    </div>
    <style>
        .icons {
            display: none;
        }
    </style>
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo-img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function ajax(data) {
            $.ajax({
                url: '<?php echo site_url('admin/setting/save') ?>',
                data: data,
                method: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success) {
                        alert('ok!');
                        window.location.href = '';
                    } else {
                        alert('error!');
                        window.location.href = '#general';
                    }
                },
                error: function (a, b, c) {
                    console.log(a + b + c);
                }
            })
        }

        $(document).ready(function () {
            var hash = document.location.hash;
            if (hash) {
                console.log(hash);
                $('.nav-stacked a[href=' + hash + ']').tab('show');
            }

            // Change hash for page-reload
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                window.location.hash = e.target.hash;
            });

            $("#logo").change(function () {
                readURL(this);
            });
            $(".cancel").click(function () {
               window.location.href = '';
            });
            $("#save-gen").click(function () {
                var formData = new FormData();
                formData.append('logo', $('#logo')[0].files[0]);
                formData.append('type', 'gen');
                formData.append('site-name', $("input[name='site-name']").val());
                formData.append('tagline', $("input[name='tagline']").val());
                ajax(formData);
            });
            $("#save-post").click(function () {
                var formData = new FormData();
                formData.append('numpost', $("input[name='numpost']").val());
                formData.append('type', 'post');
                formData.append('recent', $("input[name='recent']").val());
                ajax(formData)

            });
            $("#save-home").click(function () {
                var formData = new FormData();
                var val = [];
                $("input[name='home']:checked").each(function (i) {
                    val[i] = $(this).val();
                });
                formData.append('home[]', val);
                formData.append('type', 'homepage');
                ajax(formData)

            });
            $("#save-cat").click(function () {
                var formData = new FormData();
                var val = [];
                $("input[name='menu']:checked").each(function (i) {
                    val[i] = $(this).val();
                });
                formData.append('menu[]', val);
                formData.append('type', 'category');
                ajax(formData)

            });
        })
    </script>
</div>