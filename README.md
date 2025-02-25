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

### Basic Example
```php
use SardarBackend\RestfulApi\ApiResponse;

return (new ApiResponse())
    ->setMessage('User retrieved successfully')
    ->setData(['id' => 1, 'name' => 'John Doe'])
    ->setStatus(200)
    ->response();
```

### Adding Additional Data
```php
return (new ApiResponse())
    ->setMessage('Order placed successfully')
    ->setData(['order_id' => 12345])
    ->setAppends(['processing_time' => '2 seconds'])
    ->setStatus(201)
    ->response();
```

## 🛠 Methods
| Method | Description |
|--------|-------------|
| `setMessage(string $message)` | Sets the response message |
| `setData(mixed $data)` | Sets the response data |
| `setStatus(int $status)` | Sets the HTTP status code |
| `setAppends(array $appends)` | Adds additional key-value pairs to the response |
| `response()` | Returns a Laravel `JsonResponse` object |

## 📜 License
This package is open-source and licensed under the MIT License.

## 🤝 Contributing
Contributions are welcome! Feel free to submit issues or pull requests on [GitHub](https://github.com/SardarBackend/LaraResponse).

## 📬 Contact
For any inquiries, reach out via [GitHub Issues](https://github.com/SardarBackend/LaraResponse/issues).
