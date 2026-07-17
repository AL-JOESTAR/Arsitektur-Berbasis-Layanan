# User API Documentation

## Get All Users

Endpoint ini digunakan untuk mengambil seluruh data user.

---

## Endpoint

```http
GET /api/users
```

---

## Response Success

### HTTP Status

```
200 OK
```

### Response JSON

```json
{
    "status": true,
    "message": "Data users berhasil diambil",
    "data": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "status_user": "active",
            "created_at": "2026-07-17T10:00:00.000000Z",
            "updated_at": "2026-07-17T10:00:00.000000Z"
        }
    ]
}
```

---

# Get User By ID

Endpoint ini digunakan untuk mengambil detail user berdasarkan ID.

---

## Endpoint

```http
GET /api/users/{id}
```

### Example

```http
GET /api/users/1
```

---

## Response Success

### HTTP Status

```
200 OK
```

### Response JSON

```json
{
    "status": true,
    "message": "Detail user berhasil diambil",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "status_user": "active",
        "created_at": "2026-07-17T10:00:00.000000Z",
        "updated_at": "2026-07-17T10:00:00.000000Z"
    }
}
```

---

## Response Error

### User Tidak Ditemukan

### HTTP Status

```
404 Not Found
```

### Response JSON

```json
{
    "status": false,
    "message": "User tidak ditemukan"
}
```

---

# Update Status User

Endpoint ini digunakan untuk mengubah status user.

---

## Endpoint

```http
PUT /api/users/{id}/status
```

### Example

```http
PUT /api/users/1/status
```

---

## Request Body

```json
{
    "status_user": "active"
}
```

---

## Response Success

### HTTP Status

```
200 OK
```

### Response JSON

```json
{
    "success": true,
    "message": "Status user berhasil diubah"
}
```