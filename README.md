# php-mysql-interval

[![Latest Stable Version](https://img.shields.io/packagist/v/y0lk/php-mysql-interval.svg)](https://packagist.org/packages/y0lk/php-mysql-interval)
[![Build Status](https://img.shields.io/travis/Y0lk/php-mysql-interval.svg)](https://travis-ci.org/Y0lk/php-mysql-interval)
[![Code Coverage](https://scrutinizer-ci.com/g/Y0lk/php-mysql-interval/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Y0lk/php-mysql-interval/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Y0lk/php-mysql-interval/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Y0lk/php-mysql-interval/?branch=master)
[![License](https://img.shields.io/packagist/l/y0lk/php-mysql-interval.svg)](https://github.com/y0lk/php-mysql-interval/blob/master/LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/y0lk/php-mysql-interval.svg?maxAge=2592000)](https://packagist.org/packages/y0lk/php-mysql-interval)

Tiny PHP class to convert DateInterval objects to MySQL temporal interval expressions

## Installation

Via Composer

```shell
$ composer require y0lk/php-mysql-interval
```

## Usage

```php
use Y0lk\MySQLInterval\MySQLInterval;

//---Example with a DateInterval create from an interval specification
echo MySQLInterval::fromDateInterval(new DateInterval("P1D"), "DAY");
//Outputs "INTERVAL 1 DAY"


//---Example using diff between 2 dates
$date1 = new DateTime("2000-01-01 05:20:11.000000");
$date2 = new DateTime("2000-01-21 12:55:33.123456");
$interval = $date1->diff($date2);

$expr = MySQLInterval::fromDateInterval($interval, "DAY_MICROSECOND");
//Ouputs "INTERVAL '20 7:35:22.123456' DAY_MICROSECOND"


//---Example using a date string with fromDateString()
echo MySQLInterval::fromDateString("300 days + 7 hours", "DAY_HOUR");
//Outputs "INTERVAL '300 7' DAY_HOUR"
```

## License

The MIT License (MIT). Please see [License File](https://github.com/Y0lk/php-mysql-interval/blob/master/LICENSE) for more information.
