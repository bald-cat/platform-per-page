# Platform Per Page

## Installation

To install the package, run the following command:

```bash
composer require baldcat/platform-per-page
```

## Usage

### Connecting the Functionality to the Table
To add the ability to select a number of records to a table, override the $template property as shown below:

```php
<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ExampleTable extends Table
{
    protected $target = 'tests';

    protected $template = 'platform-pp::layouts.table';
    
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID'),
        ];
    }
}

```

You can use the ppp macros for the query builder to specify the number of records in the query method:

```php
    public function query(): iterable
    {
        return [
            'tests' => Test::ppp(),
        ];
    }
```

## Configuration
The configuration file contains two options:

```php
<?php

return [
    /**
     * Pagination Options
     *
     * Specifies the available items per page for pagination.
     * Example values:
     * - 10: 10 items per page
     * - 25: 25 items per page
     * - 50: 50 items per page
     */
    'options' => [10, 25, 50],

    /**
     * Pagination Label
     *
     * The label displayed next to the pagination control.
     * Example: "Items Per Page".
     */
    'label' => 'Per Page',
];
```

To modify these options, publish the configuration file using the command:

```bash
php artisan vendor:publish --provider="Baldcat\PlatformPerPage\PlatformPerPageServiceProvider" --tag="config"
```




