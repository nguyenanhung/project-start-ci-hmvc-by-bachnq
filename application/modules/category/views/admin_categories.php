<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Categories</h4>
                <p class="category">All category </p>
                <a href="<?php echo site_url('category/create') ?>" class="btn btn-primary">Add new</a>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($categories)) {
                        foreach ($categories as $cat) {
                            ?>
                            <tr>
                                <td><?php echo $cat->id ?></td>
                                <td><?php echo $cat->name ?></td>
                                <td><?php echo $cat->slug ?></td>
                                <td><?php echo $cat->description ?></td>
                                <td><?php switch ($cat->status){
                                        case 0: echo 'Inactive'; break;
                                        case 1: echo "Active" ; break;
                                    } ?></td>
                                <td><a href="<?php echo site_url('category/update/'.$cat->id) ?>" class="btn btn-primary">update</a>
                                    <a href="#" data-id="<?php echo $cat->id ?>" class=" delete btn btn-danger">delete</a>
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
                    url: '<?php echo site_url('api/category/delete')?>',
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