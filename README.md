# Restful API Response Package

![Packagist Version](https://img.shields.io/packagist/v/sardarbackend/LaraResponse)
![License](https://img.shields.io/github/license/sardarbackend/LaraResponse)

A robust and customizable API response helper for Laravel applications, designed to simplify JSON responses and maintain consistency across your API.

## 📌 Features
- Standardized API response structure
- Effortless HTTP status code management
- Append additional metadata seamlessly
- Fluent and intuitive interface
- Fully compatible with Laravel's response system

## 📦 Installation
Install the package via Composer:
```bash
composer require sardar-backend/lara-response:dev-master
```

## 🚀 Usage


### 1️⃣ Generate the Service Class  

First, create a new service class using the following command:  

```sh
php artisan make:service ModelName
```

To properly inject `ProductServices` into your controller, use the constructor method:  

```php
public function __construct(private ProductServices $productServices) {
}
```

### Basic Example
```php
use SardarBackend\RestfulApiHelper\RestfulApi\Fecades\ApiResponseFacade;

$result = $this->productServices->getAll($request->all());

if (!$result->ok) {
    return ApiResponseFacade::withMessage($result->data)->withStatus(500)->build()->Response();
}
return ApiResponseFacade::withData(ApiProductListResource::collection($result->data)->resource)->build()->Response();
```

### Adding Additional Data
```php
use SardarBackend\RestfulApiHelper\RestfulApi\Fecades\ApiResponseFacade;

$result = $this->productServices->getAll($request->all());

if (!$result->ok) {
    return ApiResponseFacade::withMessage($result->data)->withStatus(500)->build()->Response();
}
return ApiResponseFacade::withData(ApiProductListResource::collection($result->data)->resource)->withAppends(['processing_time' => '2 seconds'])->build()->Response();
```

## 🛠 Methods
| Method | Description |
|--------|-------------|
| `withMessage(string $message)` | Sets the response message |
| `withData(mixed $data)` | Sets the response data |
| `withStatus(int $status)` | Sets the HTTP status code |
| `withAppends(array $appends)` | Adds additional key-value pairs to the response |
| `response()` | Returns a Laravel `JsonResponse` object |

## 📜 License
This package is open-source and licensed under the MIT License.

## 🤝 Contributing
Contributions are welcome! Feel free to submit issues or pull requests on [GitHub](https://github.com/SardarBackend/LaraResponse).

## 📬 Contact
For any inquiries, reach out via [GitHub Issues](https://github.com/SardarBackend/LaraResponse/issues).
