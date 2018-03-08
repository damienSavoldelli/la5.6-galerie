---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Create a new controller instance.

> Example request:

```bash
curl -X POST "http://localhost/api/register" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/register",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## api/login

> Example request:

```bash
curl -X POST "http://localhost/api/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_942bbeb2a85bd1a9a679bffda12faf46 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost/api/picture" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/picture",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "invalid_access_token",
    "message": "Access Token incorrect."
}
```

### HTTP Request
`GET api/picture`

`HEAD api/picture`


<!-- END_942bbeb2a85bd1a9a679bffda12faf46 -->

<!-- START_7eeefd8d5c223ea4b684f6fbf9498c85 -->
## Display a listing by catgory slug

> Example request:

```bash
curl -X GET "http://localhost/api/picture/category/{slug}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/picture/category/{slug}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "invalid_access_token",
    "message": "Access Token incorrect."
}
```

### HTTP Request
`GET api/picture/category/{slug}`

`HEAD api/picture/category/{slug}`


<!-- END_7eeefd8d5c223ea4b684f6fbf9498c85 -->

<!-- START_7731988e11e0ce07e087545de6113fc8 -->
## Display a listing by user

> Example request:

```bash
curl -X GET "http://localhost/api/picture/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/picture/user/{user}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "invalid_access_token",
    "message": "Access Token incorrect."
}
```

### HTTP Request
`GET api/picture/user/{user}`

`HEAD api/picture/user/{user}`


<!-- END_7731988e11e0ce07e087545de6113fc8 -->

<!-- START_22914fe6912f4d9035a8dd28ecc1b0c1 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost/api/category" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/category",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "invalid_access_token",
    "message": "Access Token incorrect."
}
```

### HTTP Request
`GET api/category`

`HEAD api/category`


<!-- END_22914fe6912f4d9035a8dd28ecc1b0c1 -->

<!-- START_3fba263a38f92fde0e4e12f76067a611 -->
## api/refresh

> Example request:

```bash
curl -X POST "http://localhost/api/refresh" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/refresh",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/refresh`


<!-- END_3fba263a38f92fde0e4e12f76067a611 -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## api/logout

> Example request:

```bash
curl -X POST "http://localhost/api/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/logout",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

<!-- START_00e6ea2dfd416dd470ece057463f164c -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/api/picture" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/picture",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/picture`


<!-- END_00e6ea2dfd416dd470ece057463f164c -->

<!-- START_cd25548c253e0fbca4129d48cb1489a9 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost/api/picture/{picture}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/picture/{picture}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/picture/{picture}`

`PATCH api/picture/{picture}`


<!-- END_cd25548c253e0fbca4129d48cb1489a9 -->

<!-- START_815f32a65a23b52195a482fb39525796 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost/api/picture/{picture}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/picture/{picture}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/picture/{picture}`


<!-- END_815f32a65a23b52195a482fb39525796 -->

<!-- START_894ef06ce7a41cb47f9c434fcd778d9a -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/api/category" \
-H "Accept: application/json" \
    -d "name"="delectus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/category",
    "method": "POST",
    "data": {
        "name": "delectus"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/category`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `255`

<!-- END_894ef06ce7a41cb47f9c434fcd778d9a -->

<!-- START_ed2985a22796532e66be664ff9783124 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost/api/category/{category}" \
-H "Accept: application/json" \
    -d "name"="in" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/category/{category}",
    "method": "PUT",
    "data": {
        "name": "in"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/category/{category}`

`PATCH api/category/{category}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `255`

<!-- END_ed2985a22796532e66be664ff9783124 -->

<!-- START_c663adad7473b698445af374c584ba20 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost/api/category/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/category/{category}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/category/{category}`


<!-- END_c663adad7473b698445af374c584ba20 -->

