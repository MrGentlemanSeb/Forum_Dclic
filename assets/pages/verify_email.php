

<?php
global $user;
?>
   
   <section class="header-section">
    <div class="container">
    <form class="registration-form" method="post" action="assets/php/actions.php?verify_email">
               <h4>verifier votre email (<?=$user['email']?>)</h4>
               <br>
               <p>Entrez le code à 6 chiffres reçu </p>
               <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="code...">
               <?php
if(isset($_GET['resended'])){
   ?>
<p class="text-success">code de verification renvoyez!</p>
<?php
}
    ?>
    <?=showError('email_verify')?>

    <input type="submit" value="verifier">
        <a href="assets/php/actions.php?resend_code" class="text-decoration-none" type="submit">Renvoyez le code</a>
    </div>
    <br>
    <a href="assets/php/actions.php?logout" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i>Se deconnecter</a>
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
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
            }
        }
        h5 , span{
            text-align: center;
        }

    </style>