# Contact Forms

API endpoints for managing contact forms

## Create new contact form submission.




> Example request:

```bash
curl -X POST \
    "https://covid-19-tracing-app-backend.test/api/new-contact-form-submission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"form_name":"enim","full_name":"molestias","email":"ipsa","subject":"expedita","message":"magnam"}'

```

```javascript
const url = new URL(
    "https://covid-19-tracing-app-backend.test/api/new-contact-form-submission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "form_name": "enim",
    "full_name": "molestias",
    "email": "ipsa",
    "subject": "expedita",
    "message": "magnam"
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
    "submission": "{form submission object}"
}
```

### Request
<small class="badge badge-black">POST</small>
 **`api/new-contact-form-submission`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>form_name</b></code>&nbsp; <small>string</small>     <br>
    Right now there is only one form so 'default' will do. If needed later, more forms can be made.

<code><b>full_name</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>email</b></code>&nbsp; <small>string</small>     <br>
    Must be a valid email address.

<code><b>subject</b></code>&nbsp; <small>string</small>     <br>
    

<code><b>message</b></code>&nbsp; <small>string</small>     <br>
    Max: 500 chars.




