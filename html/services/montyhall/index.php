<!DOCTYPE html>
	<html>
<head>
	<meta charset="utf-8">
	<title>Monty Hall: Stay or Switch Your Pick?</title>
	<?php
	/***
	* php 5.x
	***/
	// <link href = "//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel = "stylesheet" />
	// <script src = "//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	// <script src = "//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
	?>
	<script>
		function fct_montyhall ( ) {
			<?php
			// get user data:
			$deck = isset ( $_GET [ 'deck' ] ) && is_string ( $_GET [ 'deck' ] ) && $_GET [ 'deck' ] > 2 && $_GET [ 'deck' ] < 10 ? $_GET [ 'deck' ] : 3; //// number of cards: string < integer
			$play = isset ( $_GET [ 'play' ] ) && is_string ( $_GET [ 'play' ] ) && $_GET [ 'play' ] > 0 && $_GET [ 'play' ] < 100 ? $_GET [ 'play' ] : 1; //// number of loops
			$match_stay = $match_switch = $match_draw = 0; //// $match_draw for $deck > 3
			// create deck of cards:
			for ( $i = 0; $i < $deck; $i++ ) {
				$arr_deck [ $i ] = $i + 1;
			}
			// copy deck:
			$arr_deck_start = $arr_deck; //// see references: =&
			// play:
			for ( $i2 = 0; $i2 < $play; $i2++ ) {
				// use the starting deck:
				$arr_deck = $arr_deck_start;
				// create random queen in the deck: limitation of mt_rand ( )
				$queen = mt_rand ( 1, count ( $arr_deck ) );
				// create random pick_stay in the deck:
				$pick_stay = mt_rand ( 1, count ( $arr_deck ) );
				// create random reveal in the deck:
					// delete queen from the deck:
					unset ( $arr_deck [ $queen - 1 ] ); //// use key, preserve index: see array_splice ( )
					// delete pick_stay from the deck:
					if ( $queen !== $pick_stay ) {
						unset ( $arr_deck [ $pick_stay - 1 ] );
					}
					// create random reveal: arr [ ] still has cards since $deck > 2
					$reveal_key = array_rand ( $arr_deck, 1 );
					$reveal = $arr_deck [ $reveal_key ];
				// create random pick_switch in the deck:
					// use the starting deck:
					$arr_deck = $arr_deck_start;
					// delete reveal from the deck:
					unset ( $arr_deck [ $reveal_key ] );
					// delete pick_stay from the deck: arr [ ] still has cards since $deck > 2
					unset ( $arr_deck [ $pick_stay - 1 ] );
					// create random pick_switch:
					$pick_switch_key = array_rand ( $arr_deck, 1 );
					$pick_switch = $arr_deck [ $pick_switch_key ];
				// test:
				if ( $pick_stay === $queen ) {
					$match_stay += 1;
					$result = 'won by <b>staying</b>';
				} else if ( $pick_switch === $queen ) {
					$match_switch += 1;
					$result = 'won by <b>switching</b>';
				} else {
					$match_draw += 1;
					$result = 'did not win';
				}
				/*
				invalid argument: ie
				var li_new = document . createElement ( 'li' );
				var li_txt = document . createTextNode ( '#<?php print $i2 + 1; ?>. For a deck of <?php print $deck; ?> cards and playing <?php print $play; ?> time(s), the queen was at position [ <?php print $queen; ?> ] and the first pick was at position [ <?php print $pick_stay; ?> ]. Then the card at position [ <?php print $reveal; ?> ] was revealed and a second pick was asked for. This second pick was given at position [ <?php print $pick_switch; ?> ]. As a result, the player <?php print $result; ?>. - <?php print date( 'h:i:s a' ); ?>' );
				li_new . appendChild ( li_txt );
				document . getElementById ( 'ul_log' ) . insertBefore ( li_new, document . getElementById ( 'ul_log' ) . childNodes [ 0 ] );
				*/
				?>
				document . getElementById ( 'ul_log' ) . innerHTML += '<li>#<?php print $i2 + 1; ?>. For a deck of <?php print $deck; ?> cards and playing <?php print $play; ?> time(s), the queen was at position [ <?php print $queen; ?> ] and the first pick was at position [ <?php print $pick_stay; ?> ]. Then the card at position [ <?php print $reveal; ?> ] was revealed and a second pick was asked for. This second pick was given at position [ <?php print $pick_switch; ?> ]. As a result, the player <?php print $result; ?>.<span style="font-size: small;"> - <?php print date( 'h:i:s a' ); ?></span></li><br />';
				<?php
			}
			?>
			document . getElementById ( 'spn_stay' ) . innerHTML = <?php print $match_stay; ?> + '/' + <?php print $play; ?> + ' (' + <?php print round ( 100 * $match_stay / $play, 2 ); ?> + '%)';
			document . getElementById ( 'spn_switch' ) . innerHTML = <?php print $match_switch; ?> + '/' + <?php print $play; ?> + ' (' + <?php print round ( 100 * $match_switch / $play, 2 ); ?> + '%)';
			document . getElementById ( 'spn_draw' ) . innerHTML = <?php print $match_draw; ?> + '/' + <?php print $play; ?> + ' (' + <?php print round ( 100 * $match_draw / $play, 2 ); ?> + '%)';
		}
	</script>
</head>
<body onload = "fct_montyhall()" style="font-family: consolas; font-size: 90%;">
	<span style="background-color: rgb(192, 192, 192);">[&nbsp;&spades;&nbsp;]</span>&nbsp;<span style="background-color: rgb(192, 192, 192);">[&nbsp;&hearts;&nbsp;]</span>&nbsp;<span style="background-color: rgb(192, 192, 192);">[&nbsp;&clubs;&nbsp;]</span><br />
	<?php // &diams; // window.location.href, submit ( ) ?>
	<form method = "get">
		* Number of cards in the deck (min. 3 - max. 9) = <input id = "deck" name = "deck" type = "number" min = "3" max = "9" maxlength = "1" required = "required" size = "1" /> (current <?php print $deck; ?>)<br />
		* Number of plays (min. 1 - max. 99) = <input id = "play" name = "play" type = "number" min = "1" max = "99" maxlength = "2" required = "required" size = "2" /> (current <?php print $play; ?>)<br />
		<input id = "submit" name = "submit" type = "submit" value = "go" />
		<input id = "reload" name = "reload" type = "button" value = "go again" onclick = "location . reload ( )" />
	</form>
	<br />
	Result:<br />
	* Number of wins from staying = <span id = "spn_stay" name = "spn_stay">?</span><br />
	* Number of wins from switching = <span id = "spn_switch" name = "spn_switch">?</span><br />
	* Number of draws = <span id = "spn_draw" name = "spn_draw">?</span><br />
	<br />
	Log:
	<ul id = "ul_log" name = "ul_log">
	</ul>
</body>
	</html>
