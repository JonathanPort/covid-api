<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/style.css") }}" media="screen" />
        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/print.css") }}" media="print" />
        <script src="{{ asset("vendor/scribe/js/all.js") }}"></script>

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/highlight-darcula.css") }}" media="" />
        <script src="{{ asset("vendor/scribe/js/highlight.pack.js") }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>

</head>

<body class="" data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">
<a href="#" id="nav-button">
      <span>
        NAV
            <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="-image" class=""/>
      </span>
</a>
<div class="tocify-wrapper">
                <div class="lang-selector">
                            <a href="#" data-language-name="bash">bash</a>
                            <a href="#" data-language-name="javascript">javascript</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href='http://github.com/knuckleswtf/scribe'>Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: July 13 2020</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>Welcome to our API documentation!</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile), and you can switch the programming language of the examples with the tabs in the top right (or from the nav menu at the top left on mobile).</aside><h1>Authenticating requests</h1>
<p>This API is authenticated by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {your-token}"</code></strong>.</p>
<p>You can retrieve a token by logging in or registering a user. A token will be returned with the response.</p><h1>Action Tokens</h1>
<p>API endpoints for running events via unique tokens associated to users</p>
<h2>Generate Action Token</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/generate-action-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"action":"corporis","payload":"dolor"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{token: token_object}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/generate-action-token</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>action</b></code>&nbsp; <small>string</small>     <br>
The key of the action</p>
<p><code><b>payload</b></code>&nbsp; <small>json</small>         <i>optional</i>    <br>
The request payload</p>
<p>Available Actions:</p>
<ol>
<li>action: 'addContact', payload: {contact_id: 'user_id_here'}</li>
</ol>
<h2>Run action token</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/run-action-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"sit"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/run-action-token</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>token</b></code>&nbsp; <small>required</small>         <i>optional</i>    <br>
The token</p><h1>App Data Points</h1>
<p>API endpoints for retrieving general app data via API set in the admin panel.</p>
<h2>Get app data from data point</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/get-app-data" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"data_point":"modi"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/get-app-data"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "data_point": "modi"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{data: data_content}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-green">GET</small>
<strong><code>api/get-app-data</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>data_point</b></code>&nbsp; <small>string</small>     <br>
The key of the data</p><h1>Authentication</h1>
<p>API endpoints for creating users, logging in users and generating JWT token to
be used in all other user related requests.</p>
<h2>Login user via email &amp; password</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/login-via-email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"hello@jonathanport.com","password":"hello@jonathanport.com"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
 "token": "token",
 "user": {"user object"}
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/login-via-email</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>email</b></code>&nbsp; <small>string</small>     <br>
The email of the user.</p>
<p><code><b>password</b></code>&nbsp; <small>string</small>     <br>
The email of the user.</p>
<h2>Register user by email and password</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/register-via-email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"minima","email":"rerum","password":"ipsum"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
 "new_user": "bool",
 "token": "token",
 "user": {"user object"}
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/register-via-email</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>name</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>email</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>password</b></code>&nbsp; <small>string</small>     <br></p>
<h2>Login or Register user by SSO auth code</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/login-via-sso" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"provider":"aliquam","code":"qui"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
 "new_user": "bool",
 "token": "token",
 "user": {"user object"}
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/login-via-sso</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>provider</b></code>&nbsp; <small>string</small>     <br>
e.g. 'facebook', 'twitter' etc.</p>
<p><code><b>code</b></code>&nbsp; <small>string</small>     <br>
Auth code returned from social provider</p>
<h2>Logout the user</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/user/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">true</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/user/logout</code></strong></p><h1>Contact Forms</h1>
<p>API endpoints for managing contact forms</p>
<h2>Create new contact form submission.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/new-contact-form-submission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"form_name":"dolorem","full_name":"ut","email":"rerum","subject":"voluptatem","message":"nostrum"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/new-contact-form-submission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "form_name": "dolorem",
    "full_name": "ut",
    "email": "rerum",
    "subject": "voluptatem",
    "message": "nostrum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "submission": "{form submission object}"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/new-contact-form-submission</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>form_name</b></code>&nbsp; <small>string</small>     <br>
Right now there is only one form so 'default' will do. If needed later, more forms can be made.</p>
<p><code><b>full_name</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>email</b></code>&nbsp; <small>string</small>     <br>
Must be a valid email address.</p>
<p><code><b>subject</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>message</b></code>&nbsp; <small>string</small>     <br>
Max: 500 chars.</p><h1>User Contacts</h1>
<p>API endpoints for managing User Contacts</p>
<h2>Get users contacts</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/get-contacts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/get-contacts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-green">GET</small>
<strong><code>api/user/get-contacts</code></strong></p><h1>User</h1>
<p>API endpoints for managing user related information.</p>
<h2>Returns the user</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
 "user": {"user object"}
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-green">GET</small>
<strong><code>api/user</code></strong></p>
<h2>Returns the user gdpr consent</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/check-gdpr-consent" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "gdpr_consented": "bool"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-green">GET</small>
<strong><code>api/user/check-gdpr-consent</code></strong></p>
<h2>Marks the users GDPR as consented. Returns 403 if already set.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://covid-19-tracing-app-backend.test/api/user/consent-to-gdpr" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "gdpr_consented": "bool"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-darkblue">PUT</small>
<strong><code>api/user/consent-to-gdpr</code></strong></p>
<h2>Create new covid report</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/user/new-covid-status-report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"status":"et","gender":"sed","dob":"molestiae","city":"illo","county":"veritatis","country":"consectetur","date_tested":"neque","date_symptoms_started":"repellendus"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/new-covid-status-report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "et",
    "gender": "sed",
    "dob": "molestiae",
    "city": "illo",
    "county": "veritatis",
    "country": "consectetur",
    "date_tested": "neque",
    "date_symptoms_started": "repellendus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "report": "{report object}"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
<strong><code>api/user/new-covid-status-report</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>status</b></code>&nbsp; <small>string</small>     <br>
Must be 'symptomatic', 'negative' or 'positive'.</p>
<p><code><b>gender</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>dob</b></code>&nbsp; <small>string</small>     <br>
Must be 'd/m/Y' PHP format. See: <a href="https://www.php.net/manual/en/function.date.php">https://www.php.net/manual/en/function.date.php</a>.</p>
<p><code><b>city</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>county</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>country</b></code>&nbsp; <small>string</small>     <br></p>
<p><code><b>date_tested</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
Must be 'd/m/Y' PHP format. See: <a href="https://www.php.net/manual/en/function.date.php">https://www.php.net/manual/en/function.date.php</a>.</p>
<p><code><b>date_symptoms_started</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
Must be 'd/m/Y' PHP format. See: <a href="https://www.php.net/manual/en/function.date.php">https://www.php.net/manual/en/function.date.php</a>.</p>
<h2>Returns all the users covid status reports.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/covid-status-reports" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "reports": "collection"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-green">GET</small>
<strong><code>api/user/covid-status-reports</code></strong></p>
<h2>Returns just the users latest covid status report.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/latest-covid-status-report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "report": "{report object}"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-green">GET</small>
<strong><code>api/user/latest-covid-status-report</code></strong></p>
<h2>Update user settings. None of the parameters are required so you can update any of the following, or all, at the same time.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X PUT \
    "https://covid-19-tracing-app-backend.test/api/user/update-settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"voluptatem","email":"dolores","gender":"aut","dob":"magni","city":"est","county":"tenetur","country":"iure","phone":"maiores","gdpr_consented":false,"notifications_on":true,"autosharing_on":false,"interested_ppe":true,"interested_htk":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/update-settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "voluptatem",
    "email": "dolores",
    "gender": "aut",
    "dob": "magni",
    "city": "est",
    "county": "tenetur",
    "country": "iure",
    "phone": "maiores",
    "gdpr_consented": false,
    "notifications_on": true,
    "autosharing_on": false,
    "interested_ppe": true,
    "interested_htk": false
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "user": "{user object}"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-darkblue">PUT</small>
<strong><code>api/user/update-settings</code></strong></p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p><code><b>name</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br></p>
<p><code><b>email</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br></p>
<p><code><b>gender</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br></p>
<p><code><b>dob</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br>
Must be 'd/m/Y' PHP format. See: <a href="https://www.php.net/manual/en/function.date.php">https://www.php.net/manual/en/function.date.php</a>.</p>
<p><code><b>city</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br></p>
<p><code><b>county</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br></p>
<p><code><b>country</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br></p>
<p><code><b>phone</b></code>&nbsp; <small>string</small>         <i>optional</i>    <br></p>
<p><code><b>gdpr_consented</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br></p>
<p><code><b>notifications_on</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br></p>
<p><code><b>autosharing_on</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br></p>
<p><code><b>interested_ppe</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br></p>
<p><code><b>interested_htk</b></code>&nbsp; <small>boolean</small>         <i>optional</i>    <br></p>
<h2>Returns the users covid alert status</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/get-alert-status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
 "status": "{report object}",
 "last_reported": "timestamp",
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-green">GET</small>
<strong><code>api/user/get-alert-status</code></strong></p>
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var languages = ["bash","javascript"];
        setupLanguages(languages);
    });
</script>
</body>
</html>