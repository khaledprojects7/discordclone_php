<script defer src="js/register.js"></script>

<a href="?" target="_blank" rel="noopener" class="logo"></a>

<form action="" method="POST" id="registerForm" class="sForm">
    <h1>Ha, te revoilà !</h1>
    <label>Nous sommes si heureux de te revoir !</label>
    <div class="field">
        <label>E-mail</label>
        <input type="text" name="email" autocomplete="off">
    </div>
    <div class="field">
        <label>Nom d'utilisateur</label>
        <input type="text" name="pseudo" autocomplete="off">
    </div>
    <div class="field">
        <label>Mot de passe</label>
        <input type="password" name="password">
    </div>
    <div class="flex field">

        <label>Date de naissance </label>
     <div class="selects">
         <select name="day">
            <option value="none">day</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
        </select>
        <select name="month">
            <option value="none">month</option>
            <option value="1">Janvier</option>
            <option value="2">Février</option>
            <option value="3">Mars</option>
            <option value="4">Avril</option>
            <option value="5">Mai</option>
            <option value="6">Juin</option>
            <option value="7">Juillet</option>
            <option value="8">Aout</option>
            <option value="9">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Decembre</option>
        </select>
        <select name="year">
            <option value="none">year</option>
        </select>
     </div>
        
    </div>
    
    <button type="button" name="submit">Continue</button>
    <a href="/app" class="f">Tu as déjà un compte ?</a>
    <p>En t'inscrivant, tu acceptes les <a href="">Conditions d'Utilisation</a> et la <a href="">Politique de Confidentialité</a> de Discord.</p>
</form>