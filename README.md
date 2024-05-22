<a id="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<div align="center">
    <a href="https://github.com/matte97p/Cloud-Care">
        <img src="storage/app/public/matte97.p.svg" alt="Logo" width="500" height="400">
    </a>
</div>

# Cloud-Care

> Conoscenze richieste:
> [Laravel];

Rappresenta lo scheletro del nuovo backend. Leggi il generico README.md di progetto per avere maggiori informazioni.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

## Namespace

**Principali cartelle del progetto(non vengono percorse tutte le cartelle base di Laravel fare riferimento alla [PATH ufficiale Laravel].**

    Cloud-Care
    |__ app
    |   |__ Exceptions -> Handler di eccezione custom
    |   |__ Http
    |   |   |__ Controllers
    |   |   |   |__ *.php -> astratti *
    |   |   |   |__ Concrete
    |   |   |__ Middleware
    |   |__ Models *
    |   |   |__ *.php -> concreti
    |   |   |__ Base *
    |   |__ Providers
    |   |__ Traits
    |   |__ Utils
    |       |__ ...
    |__ bootstrap
    |   |__ ...
    |__ config
    |__ database
    |   |__ factories
    |   |__ migrations
    |   |__ seeders
    |__ resources
    |   |__ ...
    |__ routes
    |   |__ ...
    |__ storage
    |   |__ ...
    |   |__ logs *
    |       |__ api
    |       |__ internal
    |__ tests
    |__ ...

**\*** : [Classi Astratte]

**\*** : i `Modelli` sono autogenerati con l'utilizzo della libreria [Reliese Laravel] e vengono aggiornato sulla base della configurazione a DB col comando:

```
php artisan code:models --table=\*\*
```

Qualsiasi customizzazione (o modello aggiuntivo) deve essere effettuata nella loro estensione(cartella Models) e non nel generato(cartella Base).

**\*** : i file di `LOG` registrano ogni attività esterna (API) che interna (internal) che viene effettuata.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

## Login

> Conoscenze richieste:
> [SSO];
> [Oauth2];

Passport-Laravel fornisce un sistema di login OAuth2 con il quale otteniamo un SSO dall'ente che detiene le credenziali criptate di accesso utilizzando Bearer Token oppure permette l'autocertificazione ove non esiste il servizio di autenticazione.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

## Controller

> Conoscenze richieste:
> [CRUD];
> [Classi Astratte];

I controller sono gestiti mediante due astratti principali `AbstractApiController` e `AbstractCrudController` (entrambi estendono `AbstractGenericController`) divisi ovviamente quindi in controller CRUD per interazioni interna col DB (architettura a microservizi) e chiamate API esterne.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

<!-- MARKDOWN LINKS & IMAGES -->

[Laravel]:(http://laravel.com/docs)
[PATH ufficiale Laravel]:(https://laravel.com/docs/10.x/structure)
[Classi Astratte]:(https://www.php.net/manual/en/language.oop5.abstract.php)
[Reliese Laravel]:(https://github.com/reliese/laravel)
[SSO]:(https://it.wikipedia.org/wiki/Single_sign-on)
[Oauth2]:(https://oauth.net/2/)
[CRUD]:(https://it.wikipedia.org/wiki/CRUD)