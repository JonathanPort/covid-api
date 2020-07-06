# User Contacts

API endpoints for managing User Contacts

## Get users contacts




> Example request:

```bash
curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/user/get-contacts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
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
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/user/get-contacts`**




