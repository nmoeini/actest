There are two sets of Routes for this application. 
Web access is possible by basic user authentication.
API access is possible by oauth 2.0 method


## Web Access

The recource path is http://application.base/notes

**Methods**

- GET, notes
- POST, notes, data|json
- GET, notes/{note}
- PATCH, notes/{note}, data|json
- DELETE, notes/{note}


## API Access with OAUTH2.0

The recource path is http://application.base/api/notes

**Methods**

- GET, api/notes
- POST, api/notes, data|json
- GET, api/notes/{note}
- PATCH, api/notes/{note}, data|json
- DELETE, api/notes/{note}


Register to application and generate oauth client in the `settings` page.
Use the Client Secret to grant access to your application.

**example usage**

Create a laravel project

```php
composer create-project --prefer-dist laravel/laravel new-project

cd new-project

composer require guzzlehttp/guzzle

```

setup the project and use following methods in the `routes/web.php`

```php
use Illuminate\Http\Request;

Route::get('/', function () {
    $query = http_build_query([
        'client_id' => 4, // Replace with Client ID
        'redirect_uri' => 'http://new-project/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect('http://note-api/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $response = (new GuzzleHttp\Client)->post('http://note-api/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 4, // Replace with Client ID
            'client_secret' => 'SECRET_KEY', // Replace with client secret
            'redirect_uri' => 'http://new-project/callback',
            'code' => $request->code,
        ]
    ]);

    session()->put('token', json_decode((string) $response->getBody(), true));

    return redirect('/notes');
});

Route::get('/notes', function () {
    $response = (new GuzzleHttp\Client)->get('http://note-api/api/notes', [
        'headers' => [
            'Authorization' => 'Bearer '.session()->get('token.access_token')
        ]
    ]);

    return json_decode((string) $response->getBody(), true);
});
```