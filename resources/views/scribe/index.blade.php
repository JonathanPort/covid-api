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
            <li>Last updated: June 29 2020</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>Welcome to our API documentation!</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile), and you can switch the programming language of the examples with the tabs in the top right (or from the nav menu at the top left on mobile).</aside><h1>Authenticating requests</h1>
<p>This API is authenticated by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {your-token}"</code></strong>.</p>
<p>You can retrieve a token by logging in or registering a user. A token will be returned with the response.</p><h1>Authentication</h1>
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
    -d '{"name":"architecto","email":"eum","password":"sapiente"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/register-via-email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "architecto",
    "email": "eum",
    "password": "sapiente"
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
    -d '{"provider":"nostrum","code":"dignissimos"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/login-via-sso"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "provider": "nostrum",
    "code": "dignissimos"
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
Auth code returned from social provider</p><h1>Contact Forms</h1>
<p>API endpoints for managing contact forms</p>
<h2>Create new contact form submission.</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/new-contact-form-submission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"form_name":"incidunt","full_name":"nam","email":"rem","subject":"ea","message":"libero"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/new-contact-form-submission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "form_name": "incidunt",
    "full_name": "nam",
    "email": "rem",
    "subject": "ea",
    "message": "libero"
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
Max: 500 chars.</p><h1>User</h1>
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
    -d '{"status":"incidunt","gender":"ratione","dob":"repellat","city":"et","county":"tempora","country":"quaerat","date_tested":"est","date_symptoms_started":"impedit"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/new-covid-status-report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "incidunt",
    "gender": "ratione",
    "dob": "repellat",
    "city": "et",
    "county": "tempora",
    "country": "quaerat",
    "date_tested": "est",
    "date_symptoms_started": "impedit"
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
<pre><code class="language-bash">curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/user/update-settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"quisquam","email":"ipsam","gender":"totam","dob":"dolores","city":"voluptatibus","county":"consequatur","country":"aut","phone":"dolore","gdpr_consented":false,"notifications_on":true,"autosharing_on":false,"interested_ppe":true,"interested_htk":false}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/user/update-settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "quisquam",
    "email": "ipsam",
    "gender": "totam",
    "dob": "dolores",
    "city": "voluptatibus",
    "county": "consequatur",
    "country": "aut",
    "phone": "dolore",
    "gdpr_consented": false,
    "notifications_on": true,
    "autosharing_on": false,
    "interested_ppe": true,
    "interested_htk": false
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
    "user": "{user object}"
}</code></pre>
<h3>Request</h3>
<p><small class="badge badge-black">POST</small>
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