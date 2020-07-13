# App Data Points

API endpoints for retrieving general app data via API set in the admin panel.

## Get app data from data point




> Example request:

```bash
curl -X GET \
    -G "https://covid-19-tracing-app-backend.test/api/get-app-data" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"data_point":"modi"}'

```

```javascript
const url = new URL(
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
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json

{data: data_content}
```

### Request
<small class="badge badge-green">GET</small>
 **`api/get-app-data`**

<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<code><b>data_point</b></code>&nbsp; <small>string</small>     <br>
    The key of the data




