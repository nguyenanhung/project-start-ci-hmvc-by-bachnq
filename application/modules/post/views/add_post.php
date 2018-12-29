<div class="row">

    <div class="col-lg-12 ">
        <div class="card">
            <div class="header">
                <h4 class="title"><?php echo $action ?> Post</h4>
            </div>
            <div class="content">
                <form action="#" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control border-input" placeholder="title"
                                       value="<?php if (isset($post)) echo $post->title ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control border-input" name="slug" placeholder="slug"
                                       value="<?php if (isset($post)) echo $post->slug ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Excerpt</label>
                                <textarea name="excerpt" rows="2" class="form-control border-input"
                                          placeholder="Excerpt"><?php if (isset($post)) echo $post->excerpt ?></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content</label>
                                <textarea name="content" id="editor" rows="5" class="form-control border-input"
                                          placeholder="content"><?php if (isset($post)) echo $post->content ?></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Categories: </label>
                            <div class="form-group" style="height: 100px; overflow-y: auto ">

                                <?php
                                if (isset($categories)) {
                                    foreach ($categories as $cat) {
                                        ?>
                                        <div class="form-group">
                                            <input class="" width="10px" type="checkbox" name="category[]"
                                                   value="<?php echo $cat->id ?>" <?php if (isset($checked)) if (in_array($cat->id, $checked)) echo "checked='true'" ?> > <?php echo $cat->name ?>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <style>
                                .icons {
                                    display: none;
                                }
                            </style>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Feature Image: </label>
                                <input class="form-control border-input" id="featureimgbtn" type="file" name="feature-img">
                                <img src="<?php if(isset($post)) echo $post->feature_img ?>" width="200px" style="margin-top: 20px" alt="" id="featureimg">
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <?php if (isset($post)) $status = $post->status; else $status = 0 ?>
                        <?php if (!$status) {
                            ?>
                            <button type="button" data-status="1" name="ok" class="btn btn-info btn-fill btn-wd">Save
                            </button>
                            <button type="button" data-status="3" name="draft" class="btn btn-info btn-fill btn-wd">Save
                                draft
                            </button>

                            <?php
                        } else {
                            if ($status == 1) {
                                ?>
                                <button type="button" data-status="1" name="ok" class="btn btn-info btn-fill btn-wd">
                                    Update
                                </button>
                                <button type="button" data-status="3" name="draft" class="btn btn-info btn-fill btn-wd">
                                    UnPublish
                                </button>
                            <?php } elseif ($status == 2 || $status == 3) { ?>
                                <button type="button" data-status="<?php echo $status ?>" name="ok"
                                        class="btn btn-info btn-fill btn-wd">Update
                                </button>
                                <button type="button" data-status="1" name="publish"
                                        class="btn btn-info btn-fill btn-wd">Update and
                                    Publish
                                </button>
                            <?php }
                        } ?>
                        <button type="button" id="cancel" class="btn btn-info btn-fill btn-wd">Cancel</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#cancel").click(function () {
            window.location.href = "<?php echo site_url('admin/post')?>"
        })
    </script>
    <script type="text/javascript">
        function change_alias(alias) {
            var str = alias;
            str = str.toLowerCase();
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
            str = str.replace(/ + /g, " ");
            str = str.trim();
            return str;
        }
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#featureimg').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
            var editor;
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(e => {editor = e}
        )
        .
            catch(error => {
                console.error(error);
        })
            ;
            $("input[name='title']").change(function (e) {
                $("input[name='slug']").val(change_alias($("input[name='title']").val()).replace(/ /g, '-'));
            });
            $("#cancel").click(function () {
                window.location.href = "<?php echo site_url('admin/post')?>"
            });
            $("#featureimgbtn").change(function () {
                readURL(this);
            });
            $("button[name='ok'], button[name='draft'], button[name='publish']").click(function () {
                var val = [0];
                var status = $(this).attr('data-status');
                $(':checkbox:checked').each(function (i) {
                    val[i] = $(this).val();
                });
                var data = {
                    'title': $("input[name='title']").val(),
                    'slug': $("input[name='slug']").val(),
                    'excerpt': $("textarea[name='excerpt']").val(),
                    'content': editor.getData(),
                    'category': val,
                    'status': status,
                    'feature_img': $('#featureimgbtn')[0].files[0]
                };
                var formdata = new FormData();

                formdata.append('title', $("input[name='title']").val());
                formdata.append(   'slug', $("input[name='slug']").val());
                formdata.append(  'excerpt', $("textarea[name='excerpt']").val());
                formdata.append(   'content', editor.getData());
                formdata.append(  'category', val);
                formdata.append(  'status', status);
                formdata.append(  'feature_img', $('#featureimgbtn')[0].files[0]);
                console.log(data);
                $.ajax({
                    url: '<?php if ($action == 'Create') echo site_url('api/post/create'); else echo site_url('api/post/update/' . $post->id); ?>',
                    data: formdata,
                    method: 'post',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.success) {
                            alert("Success!");
                            window.location.href = '<?php echo site_url('admin/post') ?>'
                        } else {
                            alert("Error!");
                        }
                    },
                    error: function (a, b, c) {
                        console.log(a + b + c);
                    }
                })
            })

        })

    </script>

</div>