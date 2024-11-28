<?php
include("config.php");
session_start();

?>
<html>

<head>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

</html>

<body>

    <div class="container">
        <div class="row">


            <div class="col">
                <h2 style="text-align:center;">Register</h2>
                <form id="register">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="uname" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button name="register" type="submit" class="btn btn-primary btn-sm">Register</button>
                </form>
            </div>


            <div id="update" class="col d-none">
                <h2 style="text-align:center;">Update</h2>
                <form id="update-form">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                    <div class="mb-3">
                        <label for="update-email-input" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="uname" id="update-uname-input" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="update-password-input" class="form-label">Password</label>
                        <input type="text" name="pass" class="form-control" id="update-password-input">
                    </div>
                    <button name="update" type="submit" class="btn btn-primary">update</button>
                </form>
            </div>
        </div>


        <h2 style="text-align:center;">User Details</h2>

        <table class="table" id="user">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query2 = "SELECT * FROM login";
                $query_run2 = mysqli_query($db, $query2);

                if (mysqli_num_rows($query_run2) > 0) {
                    $sn = 1;
                    foreach ($query_run2 as $student2) {
                ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?= $student2['uname'] ?></td>
                            <td><?= $student2['pass'] ?></td>
                            <td>
                                <button class="deleteuser btn btn-danger btn-sm" value="<?= $student2['uname']; ?>">Delete</button>
                                <button class="updateuser btn btn-primary btn-sm" value='{ "uname": "<?= $student2['uname']; ?>" , "pass": "<?= $student2['pass']; ?>"}'>Edit</button>
                            </td>
                        </tr>
                <?php

                    }
                }
                ?>
            </tbody>
        </table>

    </div>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>

//register form

        $(document).on('submit', '#register', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_register", true);


            $.ajax({
                type: "POST",
                url: "insert_gg.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage').addClass('d-none');
                        $('#register')[0].reset();

                        alertify.set('notifier', 'position', 'top-left');
                        alertify.success(res.message);

                        $('#user').load(location.href + " #user");

                    } else if (res.status == 500) {
                        $('#errorMessage').addClass('d-none');
                        $('#register')[0].reset();
                        alertify.set('notifier', 'position', 'top-left');
                        alertify.success(res.message);
                    }
                },

            });

        });

//update form

        $(document).on('submit', '#update-form', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_user", true);


            $.ajax({
                type: "POST",
                url: "insert_gg.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage').addClass('d-none');
                        $('#update-form')[0].reset();
                        $("#update").addClass("d-none");

                        alertify.set('notifier', 'position', 'top-left');
                        alertify.success(res.message);

                        $('#user').load(location.href + " #user");

                    } else if (res.status == 500) {
                        $('#errorMessage').addClass('d-none');
                        $('#update-form')[0].reset();
                        $("#update").addClass("d-none");
                        alertify.set('notifier', 'position', 'top-left');
                        alertify.success(res.message);
                    }
                },

            });

        });


//deleting data

        $(document).on('click', '.deleteuser', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id3 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "insert_gg.php",
                    data: {
                        'delete_user': true,
                        'student_id3': student_id3
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-left');
                            alertify.success(res.message);

                            $('#user').load(location.href + " #user");

                        }
                    }
                });
            }
        });

//display none

        $(document).on('click', '.updateuser', function(e) {
            e.preventDefault();
            $("#update").removeClass("d-none");
            // put the email in the input field
            var user = JSON.parse($(this).val());
            console.log($(this).val());
            $("#update-user-input").val(user.email);
            $("#update-password-input").val(user.pass);

        });
    </script>





    <body>

        </html>