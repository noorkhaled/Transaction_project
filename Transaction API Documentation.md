<details>
<summary> <h1>Transactions   </h1> This API is for managing and handling financial transactions. </summary>

### Base Url:
```
”http://localhost:8000/api”
```

# 

<details><summary>
<h2>GET </h2> <h3>/transactions </h3> "Retrieve all transactions"
</summary>

```
GET http://localhost:8000/api/transactions    
```
### Params : None
### Success Response
1.Code:
```
201 OK
```
2.Content
```
{ 
"success": true,
"transactions": 
   [ 
       { 
         "id": 1,
         "user_id": 1,
         "order_id": 1, 
         "type": 1,
         "fromable_account_type": "customer",
         "fromable_account_id": 1,
         "toable_account_type": "merchant",
         "toable_account_id": 2,
         "amount": "150.00",
         "balance": "1000.00",
         "created_at": "2024-01-07T09:38:31.000000Z",
         "updated_at": "2024-01-07T09:38:31.000000Z"
       },
       { 
         "id": 2, 
         "user_id": 1,
         "order_id": 1, 
         "type": 4, 
         "fromable_account_type": "customer", 
         "fromable_account_id": 1,
         "toable_account_type": "delivery",
         "toable_account_id": 4,
         "amount": "50.00", 
         "balance": "1000.00", 
         "created_at": "2024-01-07T09:38:54.000000Z",
         "updated_at": "2024-01-07T09:38:54.000000Z" 
       } 
   ] 
}
```
### Error Response
1.Code:
```
‘404 Not Found’
```
2..Content:
```
"success": false,
"transactions": []
```
</details>

#

<details>

#
<summary>
<h2>POST</h2> <h3>/transactions</h3> "Create New Transaction"
</summary>

```
POST http://localhost:8000/api/transactions    "Create New Transaction"
```
### Params : 
```
[ 
  'user_id' => 'required', 
  'order_id' => 'required',
  'type' => 'required', 
  'fromable_account_type' => 'required|string|max:255', 
  'fromable_account_id' => 'required|integer|min:1',
  'toable_account_type' => 'required|string|max:255', 
  'toable_account_id' => 'required|integer|min:1',
  'amount' => 'required|numeric', 
  'balance'=>'required|numeric'
];
```
### Success Response
1.Code:
```
201 OK
```
2.Content
```
 { 
    "success": true,
    "message": "Transaction Created successfully", 
    "transaction":
 { 
    "user_id": 1,
    "order_id": 1,
    "type": 4, 
    "fromable_account_id": 1,
    "fromable_account_type": "customer", 
    "toable_account_id": 4, 
    "toable_account_type": "delivery",
    "amount": 50,
    "balance": 1000, 
    "updated_at": "2024-01-07T12:22:13.000000Z",
    "created_at": "2024-01-07T12:22:13.000000Z", 
    "id": 3,
    "fromable": null,
    "fromable_account": 
{
    "id": 1,
    "name": "noor",
    "email": "noor@gmail.com", 
    "email_verified_at": null,
    "account_id": 1,
    "account_type": "customer",
    "balance": 4750,
    "created_at": "2024-01-07T09:22:21.000000Z",
    "updated_at": "2024-01-07T12:22:13.000000Z" 
},
    "toable": null,
    "toable_account":
 { 
    "id": 4,
    "name": "Bosta",
    "email": "bosta@gmail.com",
    "email_verified_at": null, 
    "account_id": 4,
    "account_type": "delivery",
    "balance": 65100,
    "created_at": "2024-01-07T09:32:54.000000Z",
    "updated_at": "2024-01-07T12:22:13.000000Z"
      }
   }
}
```
### Error Response
1.Code:
```
‘400 Bad Request’
```
2..Content:
```
"success": false,
"message": "cannot create transaction"
```
</details>

#
<details>
<summary><h2>PUT</h2><h3>/transactions/{id}</h3> "Update an existed Transaction"
</summary>

```
PUT http://localhost:8000/api/transactions/{id}    "Update an existed Transaction"
```
### Params : 
```
Required: 'id = [integer]';
```
### Data Params :
#### Fields to be Updated 
For Example: Update transaction amount
####
``` 
{
     "amount":"275.00",
}
```
### Success Response
1.Code:
```
201 OK
```
2.Content
```
 { 
    "success": true,
    "message": "Transaction updated successfully", 
    "transaction":
 { 
    "user_id": 1,
    "order_id": 1,
    "type": 4, 
    "fromable_account_id": 1,
    "fromable_account_type": "customer", 
    "toable_account_id": 4, 
    "toable_account_type": "delivery",
    "amount": 275,
    "balance": 1000, 
    "updated_at": "2024-01-07T12:22:13.000000Z",
    "created_at": "2024-01-07T12:22:13.000000Z", 
},
{
    "updated attributes":{
    "amount":275,
    "updated_at": "2024-01-07 12:41:08"
}
}
}
```
### Error Response
1.Code:
```
‘400 Bad Request’
```
2..Content:
```
"success": false,
"message": "cannot update transaction"
```
</details>

#

<details>
<summary><h2>DELETE</h2><h3>/transactions/{id}</h3> "Delete an existed Transaction"
</summary>

```
DELETE http://localhost:8000/api/transactions/{id}    "Delete an existed Transaction"
```
### Params : 
```
Required: 'id = [integer]';
```
### Success Response
1.Code:
```
201 OK
```
2.Content
```
 { 
    "success": true,
    "message": “transaction with ID: ‘{id}’ deleted”
 }
```
### Error Response
1.Code:
```
‘404 Not Found’
```
2..Content:
```
"success": false,
"message": “transaction with ID: ‘{id}’ not found”.
```
</details>

</details>
