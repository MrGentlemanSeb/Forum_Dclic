<!-- 
    <div class="login">
        <div class="col-lg-4 col-md-8 col-sm-12 bg-white border rounded p-4 shadow-sm">
            <?php
if(isset($_SESSION['forgot_code']) && !isset($_SESSION['auth_temp'])){
    $action = 'verifycode';
}elseif(isset($_SESSION['forgot_code']) && isset($_SESSION['auth_temp'])){
    $action = 'changepassword';
}else{
    $action= 'forgotpassword';
}
            ?>
            <form method="post" action="assets/php/actions.php?<?=$action?>">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>
<?php
if($action=='forgotpassword'){
    ?>
  <div class="form-floating">
                    <input type="email" name="email" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">enter your email</label>
                </div>
                <?=showError('email')?>

<br>
                <button class="btn btn-primary" type="submit">Send Verification Code</button>

    <?php
}
?>
   
   
   <?php
if($action=='verifycode'){
    ?>
<p>Enter 6 Digit Code Sended to You  - <?=$_SESSION['forgot_email']?></p>
                <div class="form-floating mt-1">

                    <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">######</label>
                </div>
                <?=showError('email_verify')?>

                <br>
                <button class="btn btn-primary" type="submit">Verify Code</button>

    <?php
}
?>


<?php
if($action=='changepassword'){
    ?>
<p>Enter your new password  - <?=$_SESSION['forgot_email']?></p>
<div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">new password</label>
                </div> 
                <?=showError('password')?>

                <br>
                <button class="btn btn-primary" type="submit">Change Password</button>


    <?php
}
?>

                 
            
                <br>
                <br>

                <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
                    To
                    Login</a>
            </form>
        </div>
    </div>
 -->








<section class="header-section">
    <div class="container">
    <?php
if(isset($_SESSION['forgot_code']) && !isset($_SESSION['auth_temp'])){
    $action = 'verifycode';
}elseif(isset($_SESSION['forgot_code']) && isset($_SESSION['auth_temp'])){
    $action = 'changepassword';
}else{
    $action= 'forgotpassword';
}
            ?>
        <form class="registration-form" method="post" action="assets/php/actions.php?<?=$action?>">
        <div class="d-flex justify-content-center">
            <img class="mb-4" src="assets/images/OIF_LOGO-RVB.png" alt="" height="50" >
        </div>
            <h1>Recupération</h1>
            <?php
if($action=='forgotpassword'){
    ?>
            <label for="email">saisissez l'email de recupération:</label>
            <input type="email" name="email" class="form-control rounded-0" placeholder="email">
                <?=showError('email')?>

<br>   
       <input type="submit" value="envoyez">
 
    <?php
}
?>

<?php
if($action=='verifycode'){
    ?>
                <p>Entrez le code à 6 chiffres reçu <?=$_SESSION['forgot_email']?></p>
                <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="">
                <?=showError('email_verify')?>
                <input type="submit" value="verifier">
    <?php
}
?>

<?php
if($action=='changepassword'){
    ?>
<p>nouveau mot de passe - <?=$_SESSION['forgot_email']?></p>

                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="nouveau mot de passe">
                <?=showError('password')?>
                <br>
                <input type="submit" value="Enregistrer">
                <?php
}
?>  

             <a href="?login" ><i class="bi bi-arrow-left-circle-fill"></i> Retouner à la page connexion</a>
        </form>
    </div>
</section>


    <style>
        
        /* Creation de compte */
        .header-section {
        height: 100%;
            width: 100%;

        }
        .container {
            z-index: 1000;
            background-color: #fff;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            margin-top: 100px;
        }
        .registration-form {
            display: flex;
            flex-direction: column;

        }
        h1 , p {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #6473cc;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #6453cc;
        }
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
            }
        }
        h5 , span{
            text-align: center;
        }

        a{
    text-align: center;
}

    </style>