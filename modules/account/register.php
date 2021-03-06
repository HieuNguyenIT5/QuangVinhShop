<?php
require "db/connect.php";
require "lib/address.php";

$usernameErr = $emailErr = $phoneErr = $fullnameErr = $addressErr = $genderErr = $passwordErr ="";


if (isset($_POST['btn-register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $re_password = md5($_POST['re_password']);
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $gender = $_POST['gender'];
    $ward = $_POST['ward'];
    $ckpassword = $_POST['password'];
    
    $error = array();
    $address = $_POST['address'].", ".get_address($ward, $district, $province);

    if ($password != $re_password) {
        $error["password"] = "Confirmation password does not match";
        $password = MD5($password);
    } else $success = true;

    if (empty($_POST["username"])) {
        $usernameErr = "Name is required";
     } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
      $usernameErr = "Only letters, white space allowed and number";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
     } else {
    // check if e-mail address is well-formed
    if (!preg_match("/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/",$email)) {
      $emailErr = "Invalid email format";
    }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
     } else {
    // check if phone only number
    if (!preg_match("/^[0-9 ]*$/",$phone)) {
      $phoneErr = "Only number";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
     } else {
    if (strlen($ckpassword) < 6) {
       $passwordErr = "Have at least 6 characters";
        }
    }

    if (empty($_POST["fullname"])) {
        $fullnameErr = "Fullname is required";
     }

     if (empty($_POST['gender'])) {
         $genderErr = "Gender is required";
     }

     if (empty($_POST["address"])) {
        $addressErr = "Address is required";
     }

    if (!empty($success) && empty($usernameErr) && empty($emailErr) && empty($phoneErr) && empty($fullnameErr) && empty($genderErr) && empty($addressErr) && empty($passwordErr) ) {
        $value = "'{$username}', '{$password}', '{$fullname}', '{$phone}', '{$email}' , '{$address}', '{$gender}'" ;
        $sql = "INSERT INTO taikhoan(TenDangNhap, MatKhau, HoVaTen, SDT, Email, DiaChi, GioiTinh) values ($value)";
        
        if(mysqli_query($conn,$sql)){
            header("Location: ?mod=account&act=login");
        } 
    }
    

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>????ng k?? t??i kho???n</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/account.css">

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>

<body>

    <script>
        $(function() {
            $("#province").change(function() {
                var Id_Prov = $("#province").val();
                var District = $("#district");
                $.ajax({
                    url: "?mod=account&act=result",
                    method: 'POST',
                    data: {
                        id_prov: Id_Prov
                    },
                    dataType: "text",
                    success: function(result) {
                        District.html(result);
                    }
                });
            });
            $("#district").change(function() {
                var Id_Dist = $("#district").val();
                var ward = $("#ward");
                $.ajax({
                    url: "?mod=account&act=result",
                    method: 'POST',
                    data: {
                        id_dist: Id_Dist
                    },
                    dataType: "text",
                    success: function(result) {
                        ward.html(result);
                    }
                });
            });
        });
    </script>

    <section>
        <!--B???t ?????u Ph???n N???i Dung-->
        <div class="noi-dung">
            <div class="form">
                <h2>Trang ????ng K??</h2>
                <p class="error"><?php echo isset($error[0]) ? $error[0] : "" ?></p>
                <form action="" method="POST">
                    <div class="input-form">
                        <span>T??n ????ng Nh???p</span><span class="obligatory">*</span>
                        <input type="text" name="username">
                        <span class="error"><?php echo $usernameErr;?></span>
                    </div>
                    <div class="input-form">
                        <span>M???t Kh???u</span><span class="obligatory">*</span>
                        <input type="password" name="password">
                        <span class="error"><?php echo $passwordErr;?></span>
                    </div>
                    <div class="input-form">
                        <span>Nh???p l???i m???t kh???u</span><span class="obligatory">*</span>
                        <input type="password" name="re_password">
                    </div>
                    <div class="input-form">
                        <span>H??? v?? t??n</span><span class="obligatory">*</span>
                        <input type="text" name="fullname">
                        <span class="error"><?php echo $fullnameErr;?></span>
                    </div>
                    <div>
                        <span>Gi???i t??nh</span><span class="obligatory">*</span><br><br>
                        <input type="radio" name="gender" checked value="Nam">Nam &emsp;
                        <input type="radio" name="gender" value="N???">N??? &emsp;
                        <input type="radio" name="gender" value="Kh??c">Kh??c
                        <span class="error"> <?php echo $genderErr;?></span><br><br>
                    </div>
                    <div class="input-form">
                        <span>S??? ??i???n tho???i</span><span class="obligatory">*</span>
                        <input type="text" name="phone">
                        <span class="error"><?php echo $phoneErr;?></span>
                    </div>
                    <div class="input-form">
                        <span>Email</span><span class="obligatory">*</span>
                        <input type="text" name="email">
                        <span class="error"><?php echo $emailErr;?></span>
                    </div>
                    
                    <div class="input-form">
                        <span>T???nh/ Th??nh Ph???</span><br>
                        <select name="province" required="" id="province">
                            <option value="">T???nh / Th??nh ph???</option>
                            <?php
                            $provinces = get_provinces();
                            foreach ($provinces as $province) {
                                echo "<option value='{$province['id']}'>{$province['_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class=input-form>
                        <span>Qu???n / Huy???n</span><br>
                        <select name="district" required="" id="district">
                            <option value="">Qu???n / Huy???n</option>
                        </select>
                    </div>
                    <div class=input-form>
                        <span>Ph?????ng / X??</span><br>
                        <select name="ward" required="" id="ward">
                            <option value="">Ph?????ng / X??</option>
                        </select>
                    </div>
                    
                    <div class="input-form">
                        <span>?????a ch???</span><span class="obligatory">*</span>
                        <input type="text" name="address">
                        <span class="error"><?php echo $addressErr;?></span>
                    </div>
                    <div class="input-form">
                        <input type="submit" value="????ng K??" name="btn-register">
                    </div>
                    <div class="input-form">
                        <p>B???n ???? C?? T??i Kho???n? <a href="?mod=account&act=login">????ng nh???p</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!--K???t Th??c Ph???n N???i Dung-->
    </section>
</body>

</html>