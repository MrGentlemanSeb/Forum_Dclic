


    <section class="header-section">
        <div class="container">
        <form method="post" class="registration-form" action="assets/php/actions.php?signup">
                <div class="d-flex justify-content-center">
                    <img class="mb-4" src="assets/images/OIF_LOGO-RVB.png" alt="" height="50" >
                </div>
                <h1>créer un compte</h1>
                <label>Nom:</label>
                <input type="text" name="last_name" value="<?=showFormData('last_name')?>"  placeholder="Nom">
                
                <label>Prenom:</label>  
                <input type="text" name="first_name" value="<?=showFormData('first_name')?>" placeholder="Prenom">
                    <?=showError('first_name')?>
                    <?=showError('last_name')?>

                    <div class="d-flex gap-3 my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1"
                                value="1" <?=isset($_SESSION['formdata'])?'':'checked'?><?=showFormData('gender')==1?'checked':''?>>
                            <label class="form-check-label" for="exampleRadios1">
                                Homme
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios3"
                                value="2" <?=showFormData('gender')==2?'checked':''?>>
                            <label class="form-check-label" for="exampleRadios3">
                                Femme
                            </label>
                        </div>
                    </div>
                  <label>métier:</label>
                  <input type="text" name="current_job" value="<?=showFormData('current_job')?>" placeholder="entrez votre métier">
                    <?=showError('current_job')?>

                        <label >Email:</label>
                        <input type="email" name="email" value="<?=showFormData('email')?>" placeholder="Entrez votre email">
                        <?=showError('email')?>
                        <label>nom d'utilisateur:</label>
                        <input type="text" name="username" value="<?=showFormData('username')?>" placeholder="Entrez votre nom d'utilisateur">
                        
        
                    <?=showError('username')?>
                    <label>mot de passe:</label>
                        <input type="password" name="password" id="floatingPassword" placeholder="Entrer le mot de passe">

                    <?=showError('password')?>

                    <button type="submit">inscription</button>
                        <a href="?login">Avez-vous un compte ?</a>
        
        </form>
        </div>
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

h1 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

input , a , button{
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none;
}

 input[type="submit"] , button {
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
a , button{
    text-align: center;
    border: none;
}
button:hover {
            background-color: #6453cc;
        }
</style>