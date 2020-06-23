# User

API endpoints for managing user related information.

## Returns the user




> Example request:

```bash
curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{
 "user": {"user object"}
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/user`**



## Returns the user gdpr consent




> Example request:

```bash
curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/check-gdpr-consent" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/check-gdpr-consent"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "gdpr_consented": "bool"
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/user/check-gdpr-consent`**



## Marks the users GDPR as consented. Returns 403 if already set.




> Example request:

```bash
curl -X PUT \
    "https://covid-19-tracing-app-backend.test/api/user/consent-to-gdpr" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/consent-to-gdpr"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "gdpr_consented": "bool"
}
```

### Request
<small class="badge badge-darkblue">PUT</small>
 **`api/user/consent-to-gdpr`**



## Create new covid report




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/user/new-covid-status-report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"status":"reiciendis","gender":"molestiae","dob":"nulla","city":"doloribus","county":"dignissimos","country":"totam","date_tested":"et","date_symptoms_started":"et"}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/new-covid-status-report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "reiciendis",
    "gender": "molestiae",
    "dob": "nulla",
    "city": "doloribus",
    "county": "dignissimos",
    "country": "totam",
    "date_tested": "et",
    "date_symptoms_started": "et"
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
    "report": "{report object}"
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/user/new-covid-status-report`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>status</b></code>&nbsp; <small>string</small>     <br>
    Must be 'symptomatic', 'negative' or 'positive'.

<code><b>gender</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>dob</b></code>&nbsp; <small>string</small>     <br>
    Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.

<code><b>city</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>county</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>country</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>date_tested</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.

<code><b>date_symptoms_started</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.



## Returns all the users covid status reports.




> Example request:

```bash
curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/covid-status-reports" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/covid-status-reports"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "reports": "collection"
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/user/covid-status-reports`**



## Returns just the users latest covid status report.




> Example request:

```bash
curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/latest-covid-status-report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/latest-covid-status-report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "report": "{report object}"
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/user/latest-covid-status-report`**



## Update user settings. None of the parameters are required so you can update any of the following, or all, at the same time.




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/user/update-settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"quo","email":"neque","gender":"modi","dob":"voluptatem","city":"delectus","county":"accusantium","country":"non","phone":"veniam","gdpr_consented":true,"notifications_on":false,"autosharing_on":false,"interested_ppe":true,"interested_htk":true}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/update-settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "quo",
    "email": "neque",
    "gender": "modi",
    "dob": "voluptatem",
    "city": "delectus",
    "county": "accusantium",
    "country": "non",
    "phone": "veniam",
    "gdpr_consented": true,
    "notifications_on": false,
    "autosharing_on": false,
    "interested_ppe": true,
    "interested_htk": true
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
    "user": "{user object}"
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/user/update-settings`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>name</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>email</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>gender</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>dob</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    Must be 'd/m/Y' PHP format. See: https://www.php.net/manual/en/function.date.php.

<code><b>city</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>county</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>country</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>phone</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
    

<code><b>gdpr_consented</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    

<code><b>notifications_on</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    

<code><b>autosharing_on</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    

<code><b>interested_ppe</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    

<code><b>interested_htk</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br>
    



## Returns the users covid alert status




> Example request:

```bash
curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/get-alert-status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/get-alert-status"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{
 "status": "{report object}",
 "last_reported": "timestamp",
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/user/get-alert-status`**




