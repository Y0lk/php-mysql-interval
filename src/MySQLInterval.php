<?php
namespace Y0lk\MySQLInterval;

use DateInterval;

class MySQLInterval {
	/**
	 * Takes a DateInterval object and returns a MySQL temporal interval expression
	 * @param  DateInterval $dateInterval Interval object to convert
	 * @param  string       $unit         MySQL unit to output
	 * @return string                     Returns the MySQL interval as a string
	 */
	public static function fromDateInterval(DateInterval $dateInterval, string $unit):string
	{
		$isString = false;

		switch ($unit) {
			case "MICROSECOND": 
				$expression = $dateInterval->format("%f");
				break;

			case "SECOND":
				$expression = $dateInterval->format("%s");
				break;

			case "MINUTE":
				$expression = $dateInterval->format("%i");
				break;

			case "HOUR":
				$expression = $dateInterval->format("%h");
				break;

			case "DAY":
				$expression = $dateInterval->format("%d");
				break;

			case "WEEK":
				$expression = $dateInterval->format("%d") / 7;
				break;

			case "MONTH":
				$expression = $dateInterval->format("%m");
				break;

			case "QUARTER":
				$expression = $dateInterval->format("%m") / 3;
				break;

			case "YEAR":
				$expression = $dateInterval->format("%y");
				break;

			case "SECOND_MICROSECOND":
				$isString = true;
				$expression = $dateInterval->format("%s.%f");
				break;

			case "MINUTE_MICROSECOND":
				$isString = true;
				$expression = $dateInterval->format("%i:%s.%f");
				break;

			case "MINUTE_SECOND":
				$isString = true;
				$expression = $dateInterval->format("%i:%s");
				break;

			case "HOUR_MICROSECOND":
				$isString = true;
				$expression = $dateInterval->format("%h:%i:%s.%f");
				break;

			case "HOUR_SECOND":
				$isString = true;
				$expression = $dateInterval->format("%h:%i:%s");
				break;

			case "HOUR_MINUTE":
				$isString = true;
				$expression = $dateInterval->format("%h:%i");
				break;

			case "DAY_MICROSECOND":
				$isString = true;
				$expression = $dateInterval->format("%d %h:%i:%s.%f");
				break;

			case "DAY_SECOND":
				$isString = true;
				$expression = $dateInterval->format("%d %h:%i:%s");
				break;

			case "DAY_MINUTE":
				$isString = true;
				$expression = $dateInterval->format("%d %h:%i");
				break;

			case "DAY_HOUR":
				$isString = true;
				$expression = $dateInterval->format("%d %h");
				break;

			case "YEAR_MONTH":
				$isString = true;
				$expression = $dateInterval->format("%y-%m");
				break;
			
			default:
				throw new \InvalidArgumentException("Unit '".$unit."' is not a valid MySQL interval unit", 1);
		}

		return "INTERVAL ".($isString ? "'".$expression."'" : (int)$expression)." ".$unit;
	}

	public static function fromDateString(string $dateString, string $unit):string
	{
		return self::fromDateInterval(DateInterval::createFromDateString($dateString), $unit);
	}
}