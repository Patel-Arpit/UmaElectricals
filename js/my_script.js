
function user_register() {
    $('#field_error').html('');
    var name = $('#name').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var password = $('#password').val();
    var otp = $('#email_otp').val();
    var is_error = '';


    if (name == "") {
        $('#name_error').html('Please enter your name');
        is_error = 'yes';
    } if (email == '') {
        $('#email_error').html('Please enter your email');
        is_error = 'yes';
    } if (mobile == '') {
        $('#mobile_error').html('Please enter your mobile');
        is_error = 'yes';
    } if (password == '') {
        $('#password_error').html('Please enter your password');
        is_error = 'yes';
    }
    if(otp == ''){
        $('#email_error').html('OTP verification is required');
    }
    else if (is_error == '') {
        $.ajax({
            url: 'register_submit.php',
            type: 'POST',
            data: 'name=' + name + '&email=' + email + '&mobile=' + mobile + '&password=' + password,
            success: function (result) {
                if (result == 'email_present') {
                    $('#email_error').html("email id alredy present");
                    $('#name_error').hide();
                    $('#mobile_error').hide();
                    $('#password_error').hide();
                }
                if (result == 'insert') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome <br>' + name,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }
        });
    }
}

function user_login() {
    $('#field_error').html('');
    var email = $('#login_email').val();
    var password = $('#login_password').val();
    var is_error = '';


    if (email == '') {
        $('#login_email_error').html('Please enter your email');
        is_error = 'yes';
    } if (password == '') {
        $('#login_password_error').html('Please enter your password');
        is_error = 'yes';
    }
    if (is_error == '') {
        $.ajax({
            url: 'login_submit.php',
            type: 'POST',
            data: 'email=' + email + '&password=' + password,
            success: function (result) {

                if (result == 'wrong') {
                    $('.login_msg p').html("Please enter valid login details");
                }
                if (result == 'valid') {
                    window.location.href = window.location.href;
                }
            }
        });
    }
}

function manage_cart(pid, type) {
    // $('#field_error').html('');
    if (type == 'update') {
        var qty = $('#' + pid + 'qty').val();
    } else {
        var qty = $('#qty').val();
    }

    $.ajax({
        url: 'manage_cart.php',
        type: 'POST',
        data: 'pid=' + pid + '&qty=' + qty + '&type=' + type,
        success: function (result) {
            if (type == 'update') {
                window.location.href = window.location.href;
            }
            $('.htc__qua').html(result);
        }
    });
}


function manage_to_cart(pid, type) {
    // $('#field_error').html('');
    if (type == 'update') {
        var qty = $('#' + pid + 'qty').val();
    } else {
        var qty = $('#qty').val();
    }

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'manage_cart.php',
                type: 'POST',
                data: 'pid=' + pid + '&qty=' + qty + '&type=' + type,
                success: function (result) {
                    if (type == 'remove') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Item Deleted',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function () { window.location.href = window.location.href; }, 1500);

                    }
                    $('.htc__qua').html(result);
                }
            });
        }
    });
};

function sort_product_drop(cat_id, site_path) {
    var sort_product_id = $('#sort_product_id').val();
    window.location.href = site_path + "categories.php?id=" + cat_id + "&sort=" + sort_product_id;
}


// wishlist_manage
function wishlist_manage(pid, type) {
    $.ajax({
        url: 'wishlist_manage.php',
        type: 'POST',
        data: 'pid=' + pid + '&type=' + type,
        success: function (result) {
            if (result == 'not_login') {
                window.location.href = 'login.php';
            } else {
                $('.htc__wishlist').html(result);
                
            }
        }
    });
}

// register otp send
function send_otp() {
    $('#email_error').html('');
    var email = $('#email').val();
    if (email == '') {
        $('#email_error').html('Please enter email id');
    } else {
        $.ajax({
            url: 'send_otp.php',
            type: 'POST',
            data: 'email=' + email + '&type=' + 'email',
            success: function (result) {
                if (result == 'yes') {
                    $('#email').attr('disabled', true);
                    $('.email_verify_otp').show();
                    $('.email_sent_otp').hide();
                } else {
                    $('#email_error').html('Please try after sometime');
                }
            }
        });
    }
}
function submit_otp() {
    $('#email_error').html('');
    var email_otp = $('#email_otp').val();
    if (email_otp == '') {
        $('#email_error').html('Please enter OTP');
    } else {
        $.ajax({
            url: 'check_otp.php',
            type: 'POST',
            data: 'otp=' + email_otp + '&type=' + 'email',
            success: function (result) {
                console.log(result);

                if (result == 'done') {
                    $('.email_verify_otp').hide();
                    $('#email_otp_result').html('Email id verified');
                } else {
                    $('#email_error').html('Please enter valid otp');
                }
            }
        });

    }
}
// forgot password
function forgot_password() {
    $('.verify_otp').show();
    $('.forgot_password').hide();
    $('#login_password').hide();
    $('#reset_password').show();
    $('#update_password').show();
    $('#login_btn').hide();
    $('.btn_send_otp').show();
}

function reset_send_otp() {
    var set_otp = $('#set_otp').val();
    var login_email = $('#login_email').val();
    var reset_password = $('#reset_password').val();

    if (reset_password == '') {
        $('#otp_field_error').html('Please enter password');
    } else {
        $.ajax({
            url: 'update_password.php',
            type: 'POST',
            data: 'email=' + login_email + '&type=' + 'email',
            success: function (result) {
                if (result == 'yes') {
                    $('#login_email').attr('disabled', true);
                    $('#login_email_error').hide();

                } else if (result == 'not_register') {
                    $('#login_email_error').html('email id not register');
                }
            }
        });
    }
}

$(document).ready(function () {
    $("#btn_verify_otp").click(function () {
        var set_otp = $('#set_otp').val();

        if (set_otp == '') {
            $('#set_otp').html('Please enter otp');
        } else {
            $.ajax({
                url: 'reset_check_otp.php',
                type: 'POST',
                data: 'otp=' + set_otp + '&type=' + 'email',
                success: function (result) {
                    console.log(result);
                    if (result == 'done') {
                        $('.btn_send_otp').hide();
                        $('.btn_verify_otp').hide();
                        $('#otp_field_error').html('Email id verified');
                    } else {
                        $('#otp_field_error').html('Please enter valid otp');
                    }
                }
            });
        }
    });
});
// reset password
$(document).ready(function () {
    $(".reset").click(function () {
        var login_email = $('#login_email').val();
        var reset_password = $('#reset_password').val();

        $.ajax({
            url: 'reset.php',
            type: 'POST',
            data: 'email=' + login_email + '&password=' + reset_password,
            success: function (result) {
                console.log(result);
                if (result == 'reset') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password updated sccessfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(() => {
                        window.location.href = window.location.href;
                    }, 1600);

                }
            }
        });

    });
});
