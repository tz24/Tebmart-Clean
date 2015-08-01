jQuery( function( $ )
{
	$( '#delivery_time' ).datetimepicker( $.extend(
		$.datepicker.regional[WDT.language],
		{
			dateFormat: WDT.dateFormat,
			timeFormat: WDT.timeFormat,
			beforeShowDay: checkDate,
			minDateTime: new Date( WDT.minDateTime ),
			hourMax: WDT.maxHour,
			showTimepicker : parseInt( WDT.showTimepicker )
		}
	) );

	/**
	 * Check if we need to disable a date
	 *
	 * @param  Date date
	 *
	 * @return array
	 */
	function checkDate( date )
	{
		// Restricted week days
		if ( $.inArray( date.getDay(), WDT.restrictedWeekDays ) > -1 )
			return [false];

		// Restricted dates
		var check, range, from, to,
			k = WDT.restrictedDates.length;
		while ( k-- )
		{
			check = WDT.restrictedDates[k];

			// Single date
			if ( check.indexOf( '-' ) == -1 )
			{
				if ( date.getTime() == convertStars( $.trim( check ), date ).getTime() )
					return [false];
				continue;
			}

			// Date range
			range = check.split( '-' ),
			from = convertStars( $.trim( range[0] ), date ),
			to = convertStars( $.trim( range[1] ), date );

			if ( from <= to )
			{
				if ( from <= date && date <= to )
					return [false];
			}

			// Compare only if at least one of from date and to date contains stars (*)
			else if ( range[0].indexOf( '*' ) != -1 || range[1].indexOf( '*' ) != -1 )
			{
				if ( from <= date || date <= to )
					return [false];
			}
		};

		// Date is not restricted
		return [true];
	}

	/**
	 * Convert a date string contains stars (*) into a Date object
	 *
	 * @param string s        Date string, in format mm/dd/yyyy
	 * @param Date   baseDate Date where we get day, month, year
	 * @return Date
	 */
	function convertStars( s, baseDate )
	{
		var parts = s.split( '/' );

		if ( '*' == parts[0] )
			parts[0] = baseDate.getMonth();
		else
			parts[0] = parseInt( parts[0] ) - 1; // Month in Javascript Date object is counted from 0 to 11

		if ( '*' == parts[1] )
			parts[1] = baseDate.getDate();
		if ( '*' == parts[2] )
			parts[2] = baseDate.getFullYear();

		return new Date( parts[2], parts[0], parts[1] );
	}
} );
