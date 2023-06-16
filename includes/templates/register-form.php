<!-- html -->


<section class="page-wrap bg-dark" style="min-height: 600px;">
    <div class="container bg-light h-100 w-100 py-5">
        <div class="border border-1 rounded w-75 m-auto py-3 px-5 m-2 ">
            <div class="container_register">
                <form id="register-form" action="" method="">
                    <div class="d-flex flex-column">
                        <p>Please fill in this form to create an account.</p>

                        <label for="name"><b>Name</b></label>
                        <input style="outline: none;" class=" p-1 mb-3" type="text" placeholder="Enter Name" name="name" required>

                        <label for="email"><b>Email</b></label>
                        <input style="outline: none;" class=" p-1" type="text" placeholder="Enter Email" name="email" required>
                        <h7 class="erro-email text-danger d-none"><i>Email already exists</i></h7>

                        <label class="mt-3" for="psw"><b>Password</b></label>
                        <input style="outline: none;" class=" p-1 mb-3" type="password" placeholder="Enter Password" name="psw" required>

                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input style="outline: none;" class=" p-1" type="password" placeholder="Repeat Password" name="psw-repeat" required>
                        <h7 class="erro-pass text-danger d-none"><i>password is not the same</i></h7>
                        <p class="mt-3">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                        <div class="d-flex justify-content-between align-items-center my-4">
                            <button id="button-cancel-register" type="button" class="cancelbtn btn btn-danger">Cancel</button>
                            <button type="submit" class="signupbtn btn btn-primary">Sign Up</button>
                        </div>
                        <div>Already have an account to login <a href="http://localhost/wordpress/login/">Click Here</a></div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<script>
    jQuery(document).ready(function($) {
        $("#button-cancel-register").click(function() {
            window.location = "http://localhost/wordpress/";
        })


        $("#register-form").submit(function(event) {
            event.preventDefault();
            var endpoint = "<?php echo admin_url('admin-ajax.php'); ?>";

            var form = $(this).serialize();

            var formdata = new FormData;
            formdata.append('action', 'register');
            formdata.append('register', form);
            // console.log(endpoint);

            // console.log(form);
            $.ajax(endpoint, {
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,

                success: function(res) {
                    if (res.data['mess'] == "erroemail") {
                        console.log("aa");
                        $(".erro-email").addClass('d-block')
                    } else if (res.data['mess'] == 'erropass') {
                        $(".erro-email").removeClass('d-block')
                        $(".erro-pass").addClass('d-block')
                        console.log(res.data);
                    } else {
                        alert("Congratulations, you have successfully registered")
                        window.location.replace('http://localhost/wordpress/login/')

                    }




                },

                error: function(err) {

                }
            })
        })
    })
</script>