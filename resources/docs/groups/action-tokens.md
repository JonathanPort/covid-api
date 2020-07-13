# Action Tokens

API endpoints for running events via unique tokens associated to users

## Generate Action Token




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/generate-action-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"action":"corporis","payload":"dolor"}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/generate-action-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "action": "corporis",
    "payload": "dolor"
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

{token: token_object}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/generate-action-token`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>action</b></code>&nbsp; <small>string</small>     <br>
    The key of the action

<code><b>payload</b></code>&nbsp; <small>json</small>         <i>optional</i>    <br>
    The request payload

Available Actions:
1. action: 'addContact', payload: {contact_id: 'user_id_here'}



## Run action token




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/run-action-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"sit"}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/run-action-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "sit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### Request
<small class="badge badge-black">POST</small>
 **`api/run-action-token`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>token</b></code>&nbsp; <small>required</small>         <i>optional</i>    <br>
    The token




