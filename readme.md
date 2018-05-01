# Book API with Laravel

## Extra
I add upload files to this API. I also add Book API postman collection, please check.

### Configuration upload files
1. ```config/filesystems.php``` check the lines of code:

```php

'books' => [
    'driver' => 'local',
    'root' => public_path('books'),
    'visibility' => 'public',
],

```

1. Just check what I'm doing in **BookController.php** . If you're familiar with Laravel I'm pretty sure you can learn less than 3 minutes.
