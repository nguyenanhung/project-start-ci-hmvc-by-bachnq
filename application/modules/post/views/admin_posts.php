<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Posts</h4>
                <p class="category">All post </p>
                <a href="<?php echo site_url('post/create') ?>" class="btn btn-primary">Add new</a>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($posts)) {
                        foreach ($posts as $post) {
                            ?>
                            <tr>
                                <td><?php echo $post->id ?></td>
                                <td><?php echo $post->title ?></td>
                                <td><?php echo $post->excerpt ?></td>
                                <td><?php echo $post->slug ?></td>
                                <td><?php switch ($post->status){
                                        case 1: echo 'Published'; break;
                                        case 2: echo "Not publish" ; break;
                                        case 3: echo "Draft"; break;
                                    } ?></td>
                                <td><a href="<?php echo site_url('post/update/'.$post->id) ?>" class="btn btn-primary">update</a>
                                    <a href="#" data-id="<?php echo $post->id ?>" class=" delete btn btn-danger">delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</div>
<script type="text/javascript">
$(document).ready(function () {
    $(".delete").click(function (e) {
        var ok = confirm('Are you sure?');
        if (ok) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo site_url('api/post/delete') ?>',
                method: 'post',
                dataType: 'json',
                data: {'id': id},
                success: function (data) {
                    if (data.success != 0) {
                        alert('deleted');
                        window.location.href = ''
                    } else {
                        alert('delete error');
                    }
                },
                error: function (a, b, c) {
                    console.log(a + b + c);
                }
            })
        }
    })
})


</script>