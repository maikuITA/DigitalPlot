<!DOCTYPE html>
<html lang="it" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigitalPlot-Pagamento</title>
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/bulma/bulma.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/index.css">
    <link rel="stylesheet" type="text/css" href="/Progetto/Smarty/css/pagamento.css">
    <link href="webfonts/uicons-bold-rounded.css" rel="stylesheet">
    <link href="webfonts/uicons-thin-straight.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header columns">
        <div class="column is-one-quarter left">
            <a role="button" class="navbar-burger" id="burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="/home">Home</a>
                    {if $isLogged === true}
                        <a class="navbar-item" href="">PlotPoints: {$plotPoints}</a>
                        {if $isAbbonato === false}
                            <a class="navbar-item" href="/subscribe">Abbonati</a>
                        {/if}
                    {else}
                        <a class="navbar-item has-text-link transfer" href="/auth">Accedi</a>
                    {/if}
                </div>
            </div>
        </div>
        <div class="column">
            <div>
                <a  class="title is-1">Digital</a>
                <a  class="title is-1 has-text-warning">Plot</a>
            </div> 
        </div>
        <div class="column is-one-quarter right">
            {if $isLogged === true}
                <a href="/find" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-search lens is-ok" aria-hidden="true"></i>
                    </span>
                </a>
                <figure class="image is-48x48">
                    {if $proPic === null}
                        <img class="is-rounded" src="/Progetto/Smarty/img/propic.png"/>
                    {else}
                        <img class="is-rounded src="data:image/jpeg;base64,{$proPic}"/>
                    {/if}
                </figure>
                <a href="/logout" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="fa fa-sign-out is-ok" aria-hidden="true"></i>
                    </span>
                </a>
            {else}
                <a href="/auth" class="button is-warning ok">Accedi</a>
            {/if}
        </div>
    </header>
    <div class="body-container">
        <div class="body-left">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title subtitle">
                        <span class="icon is-medium is-left">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </span>
                        Scegli il metodo di pagamento
                    </p>
                </header>
                <section class="section">
                    <div class="field">
                        <div class="control">
                            <label class="radio large">
                                <input type="radio" name="payment" id="paypal" value="paypal" onclick="togglePaymentMethod()" checked>
                                PayPal
                            </label>
                        </div>
                        <div class="control">
                            <label class="radio large">
                                <input type="radio" name="payment" id="card" value="credit-card" onclick="togglePaymentMethod()">
                                Carta di credito
                            </label>
                        </div>
                    </div>
                    <div class="control" id="paypal-submit">
                        <button class="button is-link is-rounded">Vai al pagamento</button>
                    </div>
                </section>
            </div>
            <div class="fatturazione" id="fatturazione">
                <form action="/purchase" method="post" class="form">
                    <div class="card gruppo">
                        <div class="field is-grouped">
                            <p class="control has-icons-left">
                                <input class="input is-rounded" type="text" placeholder="Nome" value ="{$user->getName()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true"> </i>
                                </span>
                            </p>
                            <p class="control has-icons-left">
                                <input class="input is-rounded" type="text" placeholder="Cognome" value="{$user->getSurname()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true">  </i>
                                </span>
                            </p>
                        </div>          
                        <div class="field has-addons has-addons-centered">
                            <p class="control has-icons-left indirizzo">
                                <input class="input is-rounded" type="text" placeholder="Indirizzo" value="{$user->getStreetAddress()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker" aria-hidden="true">  </i>
                                </span>
                            </p>
                        </div>
                        <div class="field has-addons has-addons-centered">
                            <p class="control">
                                <span class="select is-rounded">
                                <select>
                                    <option>+39</option>
                                    <option>+1</option>
                                    <option>+7</option>
                                    <option>+20</option>
                                    <option>+27</option>
                                    <option>+30</option>
                                    <option>+31</option>
                                    <option>+32</option>
                                    <option>+33</option>
                                    <option>+34</option>
                                    <option>+36</option>
                                    <option>+39</option>
                                    <option>+44</option>
                                    <option>+49</option>
                                    <option>+52</option>
                                    <option>+55</option>
                                    <option>+55</option>
                                    <option>+61</option>
                                    <option>+81</option>
                                    <option>+86</option>
                                    <option>+90</option>
                                    <option>+91</option>
                                </select>
                                </span>
                            </p>
                            <p class="control has-icons-left tel">
                                <input class="input is-rounded" type="text" placeholder="Numero di telefono" pattern="[0-9]{10}" value="{$user->getTelephone()}"  required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-phone" aria-hidden="true">  </i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="card gruppo">
                        <div class="field is-grouped">
                            <p class="control has-icons-left intestatario">
                                <input class="input is-rounded" type="text" name ="nameC" placeholder="Nome dell'intestatario" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true">  </i>
                                </span>
                            </p>
                            <p class="control has-icons-left intestatario">
                                <input class="input is-rounded" type="text" name ="surnameC" placeholder="Cognome dell'intestatario" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true">  </i>
                                </span>
                            </p>
                        </div>
                        <div class="field is-grouped">
                            <div class="control has-icons-left">
                                <input class="input" type="date" name="expirationDate" id="birthdate" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-calendar"></i> 
                                </span>
                            </div>
                        </div>
                        <div class="field has-addons has-addons-centered">
                            <p class="control has-icons-left carta">
                                <input class="input is-rounded" type="text" name= "cardNumber" placeholder="Numero della carta" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-credit-card" aria-hidden="true">  </i>
                                </span>
                            </p>
                            <p class="control has-icons-left civico">
                                <input class="input is-rounded" type="text" name="cvv"  placeholder="CVV" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="card gruppo">
                        <div class="field is-grouped">
                            <p class="control has-icons-left confirm">
                                <button class="button is-link is-rounded is-fullwidth is-outlined" type="submit">Conferma</button>
                                <span class="icon is-small is-left has-text-link">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                </span>
                            </p>
                            <p class="control has-icons-left delete">
                                <button class="button is-danger is-rounded is-fullwidth is-outlined" type="reset">Annulla</button>
                                <span class="icon is-small is-left has-text-danger">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="absolute-right">
            <div class="card cart">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon is-small is-left">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </span>
                    Subtotale
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <p> Tipo: {$subscription->getType()} <br/> 
                        Periodo: {$subscription->getPeriod()} <br/> 
                        Sconto da applicare: {$points} </p>
                    <a class="has-text-link"> {$subscription->getPrice() - $points} € </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="/Progetto/Smarty/js/pagamento.js"></script>
<script src="/Progetto/Smarty/js/navburger.js"></script>