# Authentication

API endpoints for creating users, logging in users and generating JWT token to
be used in all other user related requests.

## Login user via email &amp; password




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/login-via-email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"hello@jonathanport.com","password":"hello@jonathanport.com"}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/login-via-email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "hello@jonathanport.com",
    "password": "hello@jonathanport.com"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{
 "token": "token",
 "user": {"user object"}
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/login-via-email`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>email</b></code>&nbsp; <small>string</small>     <br>
    The email of the user.

<code><b>password</b></code>&nbsp; <small>string</small>     <br>
    The email of the user.



## Register user by email and password




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/register-via-email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"minima","email":"rerum","password":"ipsum"}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/register-via-email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "minima",
    "email": "rerum",
    "password": "ipsum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{
 "new_user": "bool",
 "token": "token",
 "user": {"user object"}
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/register-via-email`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>email</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>password</b></code>&nbsp; <small>string</small>     <br>
    



## Login or Register user by SSO auth code




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/login-via-sso" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"provider":"aliquam","code":"qui"}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/login-via-sso"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "provider": "aliquam",
    "code": "qui"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{
 "new_user": "bool",
 "token": "token",
 "user": {"user object"}
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/login-via-sso`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>provider</b></code>&nbsp; <small>string</small>     <br>
    e.g. 'facebook', 'twitter' etc.

<code><b>code</b></code>&nbsp; <small>string</small>     <br>
    Auth code returned from social provider



## Logout the user




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/user/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
true
```

### Request
<small class="badge badge-black">POST</small>
 **`api/user/logout`**




