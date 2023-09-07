

    <section class="connexion" >
    <div class="container">
                <h1 class="nav-item">
                <a class="nav-link  text-primary" href="http://127.0.0.1:5500/Presentation/index.html"><i class="bi bi-arrow-bar-left"></i></a>
</h1>
        <form class="login-form" method="post" action="assets/php/actions.php?login">
        <div class="d-flex justify-content-center">
            <img class="mb-4" src="assets/images/OIF_LOGO-RVB.png" alt="" height="50" >
        </div>
            <h1>Connexion</h1>
            <label for="email">Email:</label>
            <input  type="text" name="username_email" value="<?=showFormData('username_email')?>" class="form-control rounded-0" >
            <?=showError('username_email')?>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" >
            <?=showError('password')?>
            <?=showError('checkuser')?>
            <input type="submit" value="connexion">
            <h5>vous n'avez pas de compte?</h5>
            <span>Inscrivez vous <a class="incription" href="?signup" >ici</a></span>
            <span> <a class="incription"href="?forgotpassword&newfp" >mot de passe oublié ? </a></span>
        </form>
    </div>
</section>

<style>
    h5 , span{
    text-align: center;
}
.connexion{
    padding-top: 40px;
    padding-bottom: 40px;
}
.container {
    background-color: #fff;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    margin-top: 100px;
}

.login-form {
    display: flex;
    flex-direction: column;
}

h1 {
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
    background-color:#6473cc;
    color: #fff;
    cursor: pointer;
}

@media (max-width: 768px) {
    .container {
        max-width: 100%;
    }
}
input[type="submit"]:hover {
            background-color: #6453cc;
        }
</style>
