# Penyewaan API Documentation

## Create Penyewaan

Endpoint ini digunakan untuk membuat transaksi penyewaan kamar baru.

---

## Endpoint

```http
POST /api/penyewaan
```

---

## Request Body

```json
{
    "penyewa_id": 1,
    "kamar_id": 5,
    "start": "2026-07-20",
    "end": "2026-08-20"
}
```

---

## Response Success

### HTTP Status

```
201 Created
```

### Response JSON

```json
{
    "success": true,
    "message": "Penyewaan berhasil",
    "snap_token": "SNAP_TOKEN",
    "data": {
        "penyewaan": {
            "id": 1,
            "penyewa_id": 1,
            "kamar_id": 5,
            "start": "2026-07-20",
            "end": "2026-08-20",
            "status_sewa": "PENDING"
        },
        "pembayaran": {
            "id": 1,
            "penyewaan_id": 1,
            "tanggal_bayar": null,
            "jenis_pembayaran": "awal",
            "periode": 1,
            "nominal": 1500000,
            "status_bayar": "pending",
            "snap_token": "SNAP_TOKEN",
            "jatuh_tempo": "2026-07-18"
        }
    }
}
```

---

# Response Error

## User Tidak Ditemukan

### HTTP Status

```
404 Not Found
```

### Response JSON

```json
{
    "success": false,
    "message": "User tidak ditemukan"
}
```

---

## Validation Error

### HTTP Status

```
422 Unprocessable Entity
```

### Response JSON

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "penyewa_id": [
            "The penyewa id field is required."
        ],
        "kamar_id": [
            "The kamar id field is required."
        ],
        "start": [
            "The start field is required."
        ],
        "end": [
            "The end field is required."
        ]
    }
}
```

---

## Server Error

### HTTP Status

```
500 Internal Server Error
```

### Response JSON

```json
{
    "success": false,
    "message": "Error message",
    "line": 120
}
```