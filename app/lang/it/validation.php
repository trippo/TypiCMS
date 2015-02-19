<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
   
    "accepted"         => ":attribute deve essere accettato.",
    "active_url"       => ":attribute non è un URL valido.",
    "after"            => ":attribute deve essere una data successiva al :date.",
    "alpha"            => ":attribute può contenere solo lettere.",
    "alpha_dash"       => ":attribute può contenere solo lettere, numeri e trattini.",
    "alpha_num"        => ":attribute può contenere solo lettere e numeri.",
    "array"            => ":attribute deve essere un array.",
    "before"           => ":attribute deve essere una data precedente al :date.",
    "between"          => array(
        "numeric" => ":attribute deve trovarsi tra :min - :max.",
        "file"    => ":attribute deve trovarsi tra :min - :max kilobytes.",
        "string"  => ":attribute deve trovarsi tra :min - :max caratteri.",
        "array"   => ":attribute deve avere tra :min - :max elementi."
    ),
    "boolean"          => "Il campo :attribute deve essere vero o falso",
    "confirmed"        => "Il campo di conferma per :attribute non coincide.",
    "date"             => ":attribute non è una data valida.",
    "date_format"      => ":attribute non coincide con il formato :format.",
    "different"        => ":attribute e :other devono essere differenti.",
    "digits"           => ":attribute deve essere di :digits cifre.",
    "digits_between"   => ":attribute deve essere tra :min e :max cifre.",
    "email"            => ":attribute non è valido.",
    "exists"           => ":attribute selezionato/a non è valido.",
    "image"            => ":attribute deve essere un'immagine.",
    "in"               => ":attribute selezionato non è valido.",
    "integer"          => ":attribute deve essere un numero intero.",
    "ip"               => ":attribute deve essere un indirizzo IP valido.",
    "max"              => array(
        "numeric" => ":attribute deve essere minore di :max.",
        "file"    => ":attribute non deve essere più grande di :max kilobytes.",
        "string"  => ":attribute non può contenere più di :max caratteri.",
        "array"   => ":attribute non può avere più di :max elementi."
    ),
    "mimes"            => ":attribute deve essere del tipo: :values.",
    "min"              => array(
        "numeric" => ":attribute deve valere almeno :min.",
        "file"    => ":attribute deve essere più grande di :min kilobytes.",
        "string"  => ":attribute deve contenere almeno :min caratteri.",
        "array"   => ":attribute deve avere almeno :min elementi."
    ),
    "not_in"           => "Il valore selezionato per :attribute non è valido.",
    "numeric"          => ":attribute deve essere un numero.",
    "regex"            => "Il formato del campo :attribute non è valido.",
    "required"         => ":attribute è richiesto.",
    "required_if"      => "Il campo :attribute è richiesto quando :other è :value.",
    "required_with"    => "Il campo :attribute è richiesto quando :values è presente.",
    "required_with_all" => "Il campo :attribute è richiesto quando :values è presente.",
    "required_without" => "Il campo :attribute è richiesto quando :values non è presente.",
    "required_without_all" => "Il campo :attribute è richiesto quando nessuno di :values è presente.",
    "same"             => ":attribute e :other devono coincidere.",
    "size"             => array(
        "numeric" => ":attribute deve valere :size.",
        "file"    => ":attribute deve essere grande :size kilobytes.",
        "string"  => ":attribute deve contenere :size caratteri.",
        "array"   => ":attribute deve contenere :size elementi."
    ),
    "timezone"         => ":attribute deve essere una zona valida.",
    "unique"           => ":attribute è stato già utilizzato.",
    "url"              => ":attribute deve essere un URL.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(
        // General
        'name' => 'Nome',
        'username' => 'Username',
        'password' => 'Password',
        'age' => 'Età',
        'sex' => 'Sesso',
        'gender' => 'Genere',
        'day' => 'Giorno',
        'month' => 'Mese',
        'year' => 'Anno',
        'hour' => 'Ora',
        'minute' => 'Minuto',
        'second' => 'Secondo',
        'title' => 'Titolo',
        'websiteTitle' => 'Titolo del Sito',
        'content' => 'Contenuto',
        'description' => 'Descrizione',
        'excerpt' => 'Descrizione Breve',
        'date' => 'Data',
        'time' => 'Ora',
        'available' => 'Disponibile',
        'size' => 'Dimensione',
        'slug' => 'Slug',
        'url' => 'URL',
        'body' => 'Contenuto',
        'meta_keywords' => 'Meta keywords',
        'meta_title' => 'Meta title',
        'meta_description' => 'Meta description',
        'summary' => 'Sommario',
        'uri' => 'Uri',
        'online' => 'Online',
        'status' => 'Stato',

        // Contacts
        'created_at' => 'Creato il',
        'email' => 'Email',
        'mr' => 'Mr',
        'mrs' => 'Mrs',
        'website' => 'Website',
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'company' => 'Azienda',
        'city' => 'Città',
        'country' => 'Stato',
        'address' => 'Indirizzo',
        'postcode' => 'CAP',
        'phone' => 'Telefono',
        'mobile' => 'Cellulare',
        'fax' => 'Fax',
        'language' => 'Lingua',
        'message' => 'Messaggio',
        'send' => 'invia',
        'generate' => 'Genera',

        // Pages
        'rss_enabled' => 'Rss abilitati',
        'comments_enabled' => 'Commenti abilitati',
        'is_home' => 'E\' l\'homepage',
        'template' => 'Template',
        'css' => 'Css',
        'js' => 'Js',

        // Places
        'latitude' => 'Latitudine',
        'longitude' => 'Longitudine',
        'fax' => 'Fax',
        'info' => 'Info',
        'Show on map' => 'Mostra nella Mappa',
        'category_id' => 'Categoria',
        'info' => 'Info',

        // Partners
        'logo' => 'Logo',
        'homepage' => 'In homepage',

        // Events
        'start_date' => 'Inizia il',
        'end_date' => 'Finisce il',
        'start_time' => 'Ora di inizio',
        'end_time' => 'Ora di fine',
        'HH:MM' => 'HH:MM',
        'DDMMYYYY' => 'DD/MM/YYYY',
        'DDMMYYYY HHMM' => 'DD/MM/YYYY HH:MM',

        // Projects
        'category_id' => 'Categoria',
        
		// Products		
        'partner_id' => 'Marchio',
        'sku' => 'Codice',
        'price' => 'Prezzo',
        'discount' => 'Prezzo Scontato',
        'weight' => 'Peso',
        
		
        // Mots-clés
        'tags' => 'Tags',
        'tag' => 'Tag',
        'uses' => 'Utilizzi',

        // Menulinks
        'page_id' => 'Pagina',
        'menu_id' => 'Menu',
        'module_name' => 'Modulo',
        'target' => 'Target',
        'class' => 'Class',
        'icon_class' => 'Icon class',
        'restricted_to' => 'Limitato a',
        'link_type' => 'Tipo di Link',
        'has_categories' => 'Mostra categorie',
        'side' => 'Lato',
        'Front office' => 'Front office',
        'Back office' => 'Back office',

        // Users
        'first_name' => 'Nome',
        'last_name' => 'Cognome',
        'groups' => 'Groups',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Conferma Password',
        'reset password' => 'Resetta password',
        'register' => 'Registrare',
        'Change password (if not empty)' => 'Cambia password (se compilato)',
        'save' => 'Salva',
        'save and exit' => 'Salva e esci',
        'exit' => 'Esci',
        'log in' => 'Log in',
        'modify' => 'Modifica',
        'permissions' => 'Permessi',
        'isSuperUser' => 'Superuser',
        'isActivated' => 'Attivato',
        'getMergedPermissions' => 'Ottenere i permessi uniti',

        // Settings
        'webmasterEmail' => 'Email del Webmaster',
        'typekitCode' => 'Typekit Code',
        'googleAnalyticsCode' => 'Google Analytics Code',
        'langChooser' => 'Selettore di Lingua',
        'welcomeMessage' => 'Messaggio di benvenuto in Amministrazione',
        'adminLocale' => 'Lingua dell\'amministrazione',
        'welcomeMessageURL' => 'Messaggio di benvenuto in Amministrazione URL',
        'authPublic' => 'Autenticati per visitare il sito',
        'registration allowed' => 'Registrazione permessa',

        // Galleries
        'galleries' => 'Gallerie',

        // Translations
        'key' => 'Key',
        'translations' => 'Taduzioni',

        // Files
        'alt_attribute' => 'Attributo Alt',
        'keywords' => 'Keywords',
        'folder_id' => 'Cartella',
        'user_id' => 'Utente',
        'type' => 'Tipo',
        'position' => 'Posizione',
        'name' => 'Nome',
        'path' => 'Path',
        'files' => 'Files',
        'filename' => 'Nome file',
        'extension' => 'Extension',
        'mimetype' => 'Mimetype',
        'width' => 'Larghezzza',
        'height' => 'Altezza',
        'download_count' => 'Conto Download',
        'file information' => 'Informazioni File',
        'image' => 'immagine',
        'replace image' => 'Sovrascrivi immagine',
        'file' => 'File',
        'replace file' => 'Sovrascrivi file',
        'max' => 'Massimo',
        'max :size MB' => 'Massimo :size MB',
        'KB' => 'KB',
        'MB' => 'MB',
        'size (px)' => 'Dimensione (px)',
        'preview' => 'Anteprima',

        'Submit' => 'Invia',
        'Reset' => 'Reset',
        'Cancel' => 'Cancella',
    ),

    // Values, for example for select menus
    'values' => array(
        'Active tab' => 'Tab attiva',
        'New tab' => 'Nuova tab',
    ),

);