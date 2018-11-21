<?php
declare(strict_types=1);
namespace Y0lk\MySQLInterval\Test;

use Y0lk\MySQLInterval\MySQLInterval;
use DateTime, DateInterval;

class MySQLIntervalTest extends \PHPUnit\Framework\TestCase
{
	public function testMicrosecond(): void
	{		
		$date1 = new DateTime("2000-01-01 00:00:00.000000");
		$date2 = new DateTime("2000-01-01 00:00:00.123456");
		$interval = $date1->diff($date2);

		$expr = MySQLInterval::fromDateInterval($interval, "MICROSECOND");
		$this->assertEquals($expr, "INTERVAL 123456 MICROSECOND");
	}

	public function testSecond(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("PT300S"), "SECOND");
		$this->assertEquals($expr, "INTERVAL 300 SECOND");
	}

	public function testMinute(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("PT300M"), "MINUTE");
		$this->assertEquals($expr, "INTERVAL 300 MINUTE");
	}

	public function testHour(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("PT300H"), "HOUR");
		$this->assertEquals($expr, "INTERVAL 300 HOUR");
	}

	public function testDay(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300D"), "DAY");
		$this->assertEquals($expr, "INTERVAL 300 DAY");
	}

	public function testWeek(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300W"), "WEEK");
		$this->assertEquals($expr, "INTERVAL 300 WEEK");
	}

	public function testMonth(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300M"), "MONTH");
		$this->assertEquals($expr, "INTERVAL 300 MONTH");
	}

	public function testQuarter(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P15M"), "QUARTER");
		$this->assertEquals($expr, "INTERVAL 5 QUARTER");
	}

	public function testYear(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300Y"), "YEAR");
		$this->assertEquals($expr, "INTERVAL 300 YEAR");
	}

	public function testSecondMicrosecond(): void
	{		
		$date1 = new DateTime("2000-01-01 00:00:11.000000");
		$date2 = new DateTime("2000-01-01 00:00:33.123456");
		$interval = $date1->diff($date2);

		$expr = MySQLInterval::fromDateInterval($interval, "SECOND_MICROSECOND");
		$this->assertEquals($expr, "INTERVAL '22.123456' SECOND_MICROSECOND");
	}

	public function testMinuteMicrosecond(): void
	{		
		$date1 = new DateTime("2000-01-01 00:20:11.000000");
		$date2 = new DateTime("2000-01-01 00:55:33.123456");
		$interval = $date1->diff($date2);

		$expr = MySQLInterval::fromDateInterval($interval, "MINUTE_MICROSECOND");
		$this->assertEquals($expr, "INTERVAL '35:22.123456' MINUTE_MICROSECOND");
	}

	public function testMinuteSecond(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("PT75M33S"), "MINUTE_SECOND");
		$this->assertEquals($expr, "INTERVAL '75:33' MINUTE_SECOND");
	}

	public function testHourMicrosecond(): void
	{		
		$date1 = new DateTime("2000-01-01 05:20:11.000000");
		$date2 = new DateTime("2000-01-01 12:55:33.123456");
		$interval = $date1->diff($date2);

		$expr = MySQLInterval::fromDateInterval($interval, "HOUR_MICROSECOND");
		$this->assertEquals($expr, "INTERVAL '7:35:22.123456' HOUR_MICROSECOND");
	}

	public function testHourSecond(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("PT7H75M33S"), "HOUR_SECOND");
		$this->assertEquals($expr, "INTERVAL '7:75:33' HOUR_SECOND");
	}

	public function testHourMinute(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("PT7H75M"), "HOUR_MINUTE");
		$this->assertEquals($expr, "INTERVAL '7:75' HOUR_MINUTE");
	}

	public function testDayMicrosecond(): void
	{		
		$date1 = new DateTime("2000-01-01 05:20:11.000000");
		$date2 = new DateTime("2000-01-21 12:55:33.123456");
		$interval = $date1->diff($date2);

		$expr = MySQLInterval::fromDateInterval($interval, "DAY_MICROSECOND");
		$this->assertEquals($expr, "INTERVAL '20 7:35:22.123456' DAY_MICROSECOND");
	}

	public function testDaySecond(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300DT7H75M33S"), "DAY_SECOND");
		$this->assertEquals($expr, "INTERVAL '300 7:75:33' DAY_SECOND");
	}

	public function testDayMinute(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300DT7H75M"), "DAY_MINUTE");
		$this->assertEquals($expr, "INTERVAL '300 7:75' DAY_MINUTE");
	}

	public function testDayHour(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300DT7H"), "DAY_HOUR");
		$this->assertEquals($expr, "INTERVAL '300 7' DAY_HOUR");
	}

	public function testYearMonth(): void
	{		
		$expr = MySQLInterval::fromDateInterval(new DateInterval("P300Y150M"), "YEAR_MONTH");
		$this->assertEquals($expr, "INTERVAL '300-150' YEAR_MONTH");
	}

	public function testInvalidUnit(): void
	{		
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage("Unit 'INVALID_UNIT' is not a valid MySQL interval unit");
		
		MySQLInterval::fromDateInterval(new DateInterval("P300D"), "INVALID_UNIT");
	}

	public function testFromDateString(): void
	{
		$expr = MySQLInterval::fromDateString("300 days + 7 hours", "DAY_HOUR");
		$this->assertEquals($expr, "INTERVAL '300 7' DAY_HOUR");
	}
}