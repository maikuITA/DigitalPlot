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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header class="header columns">
            <div class="column is-one-quarter left">
                <a
                    role="button"
                    class="navbar-burger"
                    id="burger"
                    aria-label="menu"
                    aria-expanded="false"
                    data-target="navbarBasicExample"
                >
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href="/home">Home</a>
                        {if $isLogged === true} {if $privilege eq 0}
                        <a class="navbar-item" href="/subscribe">Abbonati</a>
                        {/if} {if $privilege >= 2}
                        <hr class="navbar-divider" />
                        <a
                            class="navbar-item"
                            id="new_mobile"
                            href="/newArticle"
                            >Nuovo articolo</a
                        >
                        <a class="navbar-item" id="new_find" href="/find"
                            >Ricerca</a
                        >
                        {/if} {if $privilege === 3}
                        <hr class="navbar-divider" />
                        <a class="navbar-item" href="/dashboard"> Dashboard </a>
                        <a class="navbar-item" href="/logs"> Logs </a>
                        {/if}
                        <hr class="navbar-divider" />
                        <a class="navbar-item" id="new_logout" href="/logout"
                            >Logout</a
                        >
                        <hr class="navbar-divider" />
                        <a class="navbar-item">PlotPoints: {$plotPoints}</a>
                        {else}
                        <a
                            class="navbar-item has-text-link transfer"
                            href="/auth"
                            >Accedi</a
                        >
                        {/if}
                    </div>
                </div>
            </div>
            <div class="column">
                <div>
                    <a class="title is-1">Digital</a>
                    <a class="title is-1 has-text-warning">Plot</a>
                </div>
            </div>
            <div class="column is-one-quarter right">
                {if $isLogged === true} {if $privilege >= 2}
                <a href="/newArticle" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i
                            class="bi bi-file-plus-fill"
                            style="font-size: 2rem"
                        ></i>
                    </span>
                </a>
                {/if}
                <a href="/find" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i class="bi bi-search" style="font-size: 1.3rem"></i>
                    </span>
                </a>
                <a href="/profile">
                    <figure class="image is-48x48">
                        {if $proPic === null}
                        <img
                            class="is-rounded"
                            src="/Progetto/Smarty/img/propic.png"
                        />
                        {else}
                        <img
                            class="is-rounded"
                            src="data:image/jpeg;base64,{$proPic}"
                        />
                        {/if}
                    </figure>
                </a>
                <a href="/logout" class="is-ok">
                    <span class="icon is-large is-ok">
                        <i
                            class="bi bi-box-arrow-right"
                            style="font-size: 1.3rem"
                        ></i>
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
                    <div class="field col">
                        <div class="control">
                            <label class="radio large">
                                <input type="radio" name="payment" id="paypal" value="paypal"
                                    onclick="togglePaymentMethod()" checked>
                                PayPal
                            </label>
                        </div>
                        <div class="control">
                            <label class="radio large">
                                <input type="radio" name="payment" id="card" value="credit-card"
                                    onclick="togglePaymentMethod()">
                                Carta di credito
                            </label>
                        </div>
                    </div>
                    <div class="control" id="paypal-submit">
                        <button class="button is-link is-rounded"><a href="https://www.paypal.com/signin"> Vai al
                                pagamento </a> </button>
                    </div>
                </section>
            </div>
            <div class="fatturazione" id="fatturazione">
                <form action="/purchase/{$subscription->getCod()}" method="post" class="form">
                    <div class="card gruppo">
                        <div class="field is-grouped">
                            <p class="control has-icons-left">
                                <input class="input is-rounded" type="text" placeholder="Nome"
                                    value="{$user->getName()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true"> </i>
                                </span>
                            </p>
                            <p class="control has-icons-left">
                                <input class="input is-rounded" type="text" placeholder="Cognome"
                                    value="{$user->getSurname()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                        <div class="field is-grouped">
                            <p class="control has-icons-left ">
                                <input class="input is-rounded" type="text" placeholder="Paese" name="country"
                                    value="{$user->getCountry()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker" aria-hidden="true"> </i>
                                </span>
                            </p>
                            <p class="control has-icons-left ">
                                <input class="input is-rounded" type="text" placeholder="Città" name="city"
                                    value="{$user->getBirthplace()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                        <div class="field is-grouped">
                            <p class="control has-icons-left ">
                                <input class="input is-rounded" type="text" placeholder="Provincia" name="province"
                                    value="{$user->getProvince()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker" aria-hidden="true"> </i>
                                </span>
                            </p>
                            <p class="control has-icons-left ">
                                <input class="input is-rounded" type="text" placeholder="CAP" name="zipCode"
                                    value="{$user->getZipCode()}" {literal} pattern="^\d{5}$" {/literal} required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                        <div class="field has-addons has-addons-centered">
                            <p class="control has-icons-left indirizzo">
                                <input class="input is-rounded" type="text" placeholder="Indirizzo"
                                    name="billingAddress" value="{$user->getStreetAddress()}" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker" aria-hidden="true"> </i>
                                </span>
                            </p>
                            <p class="control has-icons-left">
                                <input class="input is-rounded" type="text" placeholder="Numero Civico"
                                    name="streetNumber" value="{$user->getStreetNumber()}" {literal}
                                    pattern="^\d{1,5}[a-zA-Z]?(\/?[a-zA-Z0-9]+)?$" {/literal} required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-map-marker" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                        <div class="field has-addons has-addons-centered">
                            <p class="control">
                                <span class="select is-rounded">
                                    <select disabled>
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
                                <input class="input is-rounded" type="text" placeholder="Numero di telefono"
                                    name="telephone" {literal} pattern='^(\+39)?[0-9\s\-]{9,15}$' {/literal}
                                    value="{$user->getTelephone()}">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-phone" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="card gruppo">
                        <div class="field is-grouped">
                            <p class="control has-icons-left intestatario">
                                <input class="input is-rounded" type="text" name="nameC"
                                    placeholder="Nome dell'intestatario" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true"> </i>
                                </span>
                            </p>
                            <p class="control has-icons-left intestatario">
                                <input class="input is-rounded" type="text" name="surnameC"
                                    placeholder="Cognome dell'intestatario" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                        <div class="field is-grouped">
                            <p class="control has-icons-left intestatario expiration-input-container">
                                <input class="input is-rounded" type="date" name="expirationDate" id="expirationDate"
                                    required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-calendar" aria-hidden="true"> </i>
                                </span>
                                <span id="feedback-expiry" class="span-error"></span>
                            </p>
                        </div>
                        <div class="field has-addons has-addons-centered">
                            <p class="control has-icons-left carta">
                                <input class="input is-rounded" type="text" name="cardNumber"
                                    placeholder="Numero della carta" {literal}
                                    pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9]{2})[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11}|[0-9]{16}|[0-9]{4}[\- ][0-9]{4}[\- ][0-9]{4}[\- ][0-9]{4})$"
                                    {/literal} required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-credit-card" aria-hidden="true"> </i>
                                </span>
                            <div id="feedback-card-number" style="margin-top: 5px;"></div>
                            </p>
                            <p class="control has-icons-left civico">
                                <input class="input is-rounded" type="text" name="cvv" placeholder="CVV" {literal}
                                    pattern="^\d{3}$" {/literal} required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock" aria-hidden="true"> </i>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="card gruppo">
                        <div class="field is-grouped">
                            <p class="control has-icons-left confirm">
                                <button class="button is-link is-rounded is-fullwidth is-outlined"
                                    type="submit">Conferma</button>
                                <span class="icon is-small is-left has-text-link">
                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                </span>
                            </p>
                            <p class="control has-icons-left confirm">
                                <button class="button is-danger is-rounded is-fullwidth is-outlined"
                                    type="reset">Annulla</button>
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
                        <p> Tipo: {$subscription->getType()} <br />
                            Periodo: {$subscription->getPeriod()} <br />
                            Prezzo: {$subscription->getPrice()} €<br />
                            Sconto da applicare: {$points} €</p>
                        <a class="has-text-link">Totale: {$subscription->getPrice() - $points} € </a>
                    </div>
                </div>
            </div>
        </div>
        <script src="/Progetto/Smarty/js/validate-expirationDate.js"></script>
        <script src="/Progetto/Smarty/js/pagamento.js"></script>
        <script src="/Progetto/Smarty/js/navburger.js"></script>
</body>

</html>