# Platform Per Page

## Installation

To install the package, run the following command:

```bash
composer require baldcat/platform-per-page
```

## Usage

Connecting the Functionality to the Table
To integrate the pagination functionality into your table, override the $template property as shown below:

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

To use pagination in your model, add the PaginateControl trait:

```php
<?php

namespace App\Models;

use Baldcat\PlatformPerPage\Traits\PaginateControl;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Test extends Model
{
    use AsSource, PaginateControl;
}

```
Now, you can call it in the query method like this:

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




