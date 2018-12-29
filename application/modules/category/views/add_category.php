<div class="row">

    <div class="col-lg-12 ">
        <div class="card">
            <div class="header">
                <h4 class="title"><?php echo $action ?> Category</h4>
            </div>
            <div class="content">
                <form action="#" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control border-input" placeholder="title"
                                       value="<?php if (isset($category)) echo $category->name ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control border-input" name="slug" placeholder="slug"
                                       value="<?php if (isset($category)) echo $category->slug ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="2" class="form-control border-input"
                                          placeholder="Description"><?php if (isset($category)) echo $category->description ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Parent: </label>
                                <select class="form-control border-input" name="parent">
                                    <option value="0" data-slug=""></option>
                                    <?php
                                    if (isset($categories)) {
                                        foreach ($categories as $cat) {
                                            ?>
                                            <option value="<?php echo $cat->id ?>"
                                                    data-slug="<?php echo $cat->slug ?>"><?php echo $cat->name ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="">Status:</label>
                            <select name="status" id="">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" name="ok" class="btn btn-info btn-fill btn-wd">Save</button>
                        <button type="button" id="cancel" class="btn btn-info btn-fill btn-wd">Cancel</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
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

        var name_slug = change_alias($("input[name='name']").val()).replace(/ /g, '-');
        var cat_slug = $("select[name='parent'] option:selected").attr('data-slug');
        $("input[name='name']").change(function (e) {
            name_slug = change_alias($("input[name='name']").val()).replace(/ /g, '-');
            $("input[name='slug']").val(cat_slug + '/' + name_slug);
        });
        $("input[name='slug']").change(function (e) {
            $("input[name='slug']").val(change_alias($("input[name='slug']").val()).replace(/ /g, '-'));
        });
        $("select[name='parent']").change(function (e) {
            cat_slug = $("select[name='parent'] option:selected").attr('data-slug');
            $("input[name='slug']").val(cat_slug + '/' + name_slug);
        });
        $("#cancel").click(function () {
            window.location.href = "<?php echo site_url('admin/category')?>"
        })

        $("button[name='ok']").click(function () {
            var data = {
                'name': $("input[name='name']").val(),
                'slug': $("input[name='slug']").val(),
                'description': $("textarea[name='description']").val(),
                'parent': $("select[name='parent']").val(),
                'status' :  $("select[name='status']").val()
            };
            $.ajax({
                url: '<?php if($action == 'Create') echo site_url('api/category/create'); else echo site_url('api/category/update/'.$category->id); ?>',
                data: data,
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        alert("Success!");
                        window.location.href = '<?php echo site_url('admin/category') ?>'
                    } else {
                        alert("Error!");
                    }
                },
                error: function (a, b, c) {
                    console.log(a + b + c);
                }
            })
        })
    </script>

</div>