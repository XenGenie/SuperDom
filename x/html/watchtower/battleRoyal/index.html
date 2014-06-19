<script type="text/javascript"> 
	var BattleRoyal = {
		symbols     : ['♠','♦','♥','♣'],
		suits       : ['&#spades;','&#diams;','&#hearts;','&#clubs;'],
		elements    : ['AIR','EARTH','WATER','FIRE'],
		deckModal   : {$deck|json_encode}, 
		cards       : {$cards|json_encode}, 
		cpu_cards   : {$cards|json_encode},
		shuffleDeck : function  (cards) { 
			return this.shuffle(cards);
		},
		shuffle :  function (array) {
			var currentIndex = array.length, temporaryValue, randomIndex;

			// While there remain elements to shuffle...
			while (0 !== currentIndex) {

			// Pick a remaining element...
			randomIndex  = Math.floor(Math.random() * currentIndex);
			currentIndex -= 1;

			// And swap it with the current element.
			temporaryValue      = array[currentIndex];
			array[currentIndex] = array[randomIndex];
			array[randomIndex]  = temporaryValue;
			}

			return this.cards = array;
		},
		drawDeck : function  () {
			$.each(this.cards, function  (i,obj) {
				var title = obj.title.replace(/ /g,'<br/>');

				var h1 = "";
				if(obj.value <= 10){
					h1 = $('<h1/>').html(obj.value);
				}else{
					h1 = $('<h1/>').html(obj.value[0]);
				}

				var suit = "";
				if( ((obj.value * 1) >= 2) && ((obj.value * 1) <= 10) ){
					for (var x = obj.value - 1; x >= 0; x--) {
						suit = suit + obj.suit;
					};
				}else{
					suit = obj.suit;
				}

				suit = $('<h1/>').html(suit);

				var card = $('<div/>').css({
					zIndex : i * 10
				}).attr({ id : 'card-'+i }).addClass('card front animated '+obj.element);

				h1.appendTo(card);
				suit.appendTo(card);

				card.appendTo('#deck'); 
			});
		},
		drawCards : function  (x) {
			// Move 7 cards from deck to hand.
			for (var i = x - 1; i >= 0; i--) {

				var y = $("#deck div").length - 1;

				$($("#deck div")[y]).css({
					position : 'relative',
					float : 'left'
				}).appendTo('#hand');
			};
		},
		initGame : function  () {
			this.reset();
			this.cards     = this.shuffleDeck(this.cards);
			this.cpu_cards = this.shuffleDeck(this.cpu_cards);

			this.drawDeck();
			this.drawCards(7);
			if(false === this.hasFamily()){
				if(confirm('This Hand Does Not Mark the Blood of the Royal Family, Draw Again?')){
					this.initGame();
				};
			}else{

			};
		},
		reset : function  () {
			$('#hand').html('');
			$('#graveyard').html('');
			$('#prision').html('');
		},
		hasFamily : function  () {
			var hand = $('#hand div');

			for (var i = hand.length - 1; i >= 0; i--) {
				id = $(hand[i]).attr('id').replace('card-');
				if(id <= 10){
					continue;
				}else{
					return true;
				}
			};
			return false;
		}
	}
</script>
<style type="text/css">

	.animated{
 		
 	}  

 	#graveyard, #hand, #battlefield, #camp, #deck {
		border        : 3px dashed rgba(255,255,255,0.75);
		border-radius : 10px;
		padding             : 0px;
 	}

	#playmat {
		position   : relative;
		width      : 100%;
		height     : 100%;
		background : rgb(107,186,112); /* Old browsers */
		/* IE9 SVG, needs conditional override of 'filter' to 'none' */
		background : url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjNmJiYTcwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzZiYmE3MCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
		background : -moz-linear-gradient(-45deg,  rgba(107,186,112,1) 0%, rgba(107,186,112,1) 100%); /* FF3.6+ */
		background : -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(107,186,112,1)), color-stop(100%,rgba(107,186,112,1))); /* Chrome,Safari4+ */
		background : -webkit-linear-gradient(-45deg,  rgba(107,186,112,1) 0%,rgba(107,186,112,1) 100%); /* Chrome10+,Safari5.1+ */
		background : -o-linear-gradient(-45deg,  rgba(107,186,112,1) 0%,rgba(107,186,112,1) 100%); /* Opera 11.10+ */
		background : -ms-linear-gradient(-45deg,  rgba(107,186,112,1) 0%,rgba(107,186,112,1) 100%); /* IE10+ */
		background : linear-gradient(135deg,  rgba(107,186,112,1) 0%,rgba(107,186,112,1) 100%); /* W3C */
		filter     : progid:DXImageTransform.Microsoft.gradient( startColorstr='#6bba70', endColorstr='#6bba70',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */

	}

	#deck {
		position : absolute;
		bottom   : 175px;
		right    : 0;
		width    : 125px ;
		height   : 180px ;
	}


	#graveyard {	
		position : absolute; 	
		bottom   : 0;
		right    : 0;
		width    : 125px ;
		height   : 175px ;	
	}

	#hand{
		position   : absolute;
		display    : block;
		background : rgba(0,0,0,0.25);
		width      : 60%;
		height     : 175px;
		bottom     : 0;
		left       : 20%;
	}


	.card { 
		width              : 125px ;
		height             : 175px ;
		background-color   : white;
		border-radius      : 5px;
		display            : table-cell;
		vertical-align     : middle;
		position           : absolute; 
		text-align         : center;
		
		-o-transition      : all .35s linear;
		-ms-transition     : all .35s linear;
		-moz-transition    : all .35s linear;
		-webkit-transition : all .35s linear;
		transition         : all .35s linear;
		
		font-size          : 15px;
		text-shadow        : 
		{for $i=5;$i>=0;$i--}
			{$i}px {$i}px 0px rgba({$i * 10},{$i * 10},{$i * 10},1),
		{/for}

		0px 0px 0px rgba(0,0,0,0.0);
		overflow: hidden;

		background: rgb(249,252,247); /* Old browsers */
		/* IE9 SVG, needs conditional override of 'filter' to 'none' */
		background : url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiNmOWZjZjciIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZjVmOWYwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
		background : -moz-radial-gradient(center, ellipse cover,  rgba(249,252,247,1) 0%, rgba(245,249,240,1) 100%); /* FF3.6+ */
		background : -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(249,252,247,1)), color-stop(100%,rgba(245,249,240,1))); /* Chrome,Safari4+ */
		background : -webkit-radial-gradient(center, ellipse cover,  rgba(249,252,247,1) 0%,rgba(245,249,240,1) 100%); /* Chrome10+,Safari5.1+ */
		background : -o-radial-gradient(center, ellipse cover,  rgba(249,252,247,1) 0%,rgba(245,249,240,1) 100%); /* Opera 12+ */
		background : -ms-radial-gradient(center, ellipse cover,  rgba(249,252,247,1) 0%,rgba(245,249,240,1) 100%); /* IE10+ */
		background : radial-gradient(ellipse at center,  rgba(249,252,247,1) 0%,rgba(245,249,240,1) 100%); /* W3C */
		filter     : progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9fcf7', endColorstr='#f5f9f0',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */

	}

	.card .back{

	}

	.card .front{

	}

	.FIRE{
		background: rgb(68,0,0); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjElIiBzdG9wLWNvbG9yPSIjNDQwMDAwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTAlIiBzdG9wLWNvbG9yPSIjZmY2ZTAwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTElIiBzdG9wLWNvbG9yPSIjZjYyOTBjIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNzElIiBzdG9wLWNvbG9yPSIjZjAyZjE3IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2U3MzgyNyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(-45deg,  rgba(68,0,0,1) 1%, rgba(255,110,0,1) 50%, rgba(246,41,12,1) 51%, rgba(240,47,23,1) 71%, rgba(231,56,39,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right bottom, color-stop(1%,rgba(68,0,0,1)), color-stop(50%,rgba(255,110,0,1)), color-stop(51%,rgba(246,41,12,1)), color-stop(71%,rgba(240,47,23,1)), color-stop(100%,rgba(231,56,39,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(-45deg,  rgba(68,0,0,1) 1%,rgba(255,110,0,1) 50%,rgba(246,41,12,1) 51%,rgba(240,47,23,1) 71%,rgba(231,56,39,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(-45deg,  rgba(68,0,0,1) 1%,rgba(255,110,0,1) 50%,rgba(246,41,12,1) 51%,rgba(240,47,23,1) 71%,rgba(231,56,39,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(-45deg,  rgba(68,0,0,1) 1%,rgba(255,110,0,1) 50%,rgba(246,41,12,1) 51%,rgba(240,47,23,1) 71%,rgba(231,56,39,1) 100%); /* IE10+ */
background: linear-gradient(135deg,  rgba(68,0,0,1) 1%,rgba(255,110,0,1) 50%,rgba(246,41,12,1) 51%,rgba(240,47,23,1) 71%,rgba(231,56,39,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#440000', endColorstr='#e73827',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */

	}

	.WATER {
		background: rgb(255,234,145); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjZmZlYTkxIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTclIiBzdG9wLWNvbG9yPSIjYWFjNWRlIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTAlIiBzdG9wLWNvbG9yPSIjMTE1YjkzIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTElIiBzdG9wLWNvbG9yPSIjMDA3NmFkIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTQlIiBzdG9wLWNvbG9yPSIjNGJiOGYwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTklIiBzdG9wLWNvbG9yPSIjNDE5YWQ2IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNjUlIiBzdG9wLWNvbG9yPSIjNGJiOGYwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNjklIiBzdG9wLWNvbG9yPSIjNDE5YWQ2IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNzMlIiBzdG9wLWNvbG9yPSIjM2E4YmMyIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNzglIiBzdG9wLWNvbG9yPSIjNGJiOGYwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iODAlIiBzdG9wLWNvbG9yPSIjM2E4YmMyIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iODklIiBzdG9wLWNvbG9yPSIjNGJiOGYwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iOTQlIiBzdG9wLWNvbG9yPSIjM2E4YmMyIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzI2NTU4YiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(-45deg,  rgba(255,234,145,1) 0%, rgba(170,197,222,1) 17%, rgba(17,91,147,1) 50%, rgba(0,118,173,1) 51%, rgba(75,184,240,1) 54%, rgba(65,154,214,1) 59%, rgba(75,184,240,1) 65%, rgba(65,154,214,1) 69%, rgba(58,139,194,1) 73%, rgba(75,184,240,1) 78%, rgba(58,139,194,1) 80%, rgba(75,184,240,1) 89%, rgba(58,139,194,1) 94%, rgba(38,85,139,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,234,145,1)), color-stop(17%,rgba(170,197,222,1)), color-stop(50%,rgba(17,91,147,1)), color-stop(51%,rgba(0,118,173,1)), color-stop(54%,rgba(75,184,240,1)), color-stop(59%,rgba(65,154,214,1)), color-stop(65%,rgba(75,184,240,1)), color-stop(69%,rgba(65,154,214,1)), color-stop(73%,rgba(58,139,194,1)), color-stop(78%,rgba(75,184,240,1)), color-stop(80%,rgba(58,139,194,1)), color-stop(89%,rgba(75,184,240,1)), color-stop(94%,rgba(58,139,194,1)), color-stop(100%,rgba(38,85,139,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(-45deg,  rgba(255,234,145,1) 0%,rgba(170,197,222,1) 17%,rgba(17,91,147,1) 50%,rgba(0,118,173,1) 51%,rgba(75,184,240,1) 54%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 65%,rgba(65,154,214,1) 69%,rgba(58,139,194,1) 73%,rgba(75,184,240,1) 78%,rgba(58,139,194,1) 80%,rgba(75,184,240,1) 89%,rgba(58,139,194,1) 94%,rgba(38,85,139,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(-45deg,  rgba(255,234,145,1) 0%,rgba(170,197,222,1) 17%,rgba(17,91,147,1) 50%,rgba(0,118,173,1) 51%,rgba(75,184,240,1) 54%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 65%,rgba(65,154,214,1) 69%,rgba(58,139,194,1) 73%,rgba(75,184,240,1) 78%,rgba(58,139,194,1) 80%,rgba(75,184,240,1) 89%,rgba(58,139,194,1) 94%,rgba(38,85,139,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(-45deg,  rgba(255,234,145,1) 0%,rgba(170,197,222,1) 17%,rgba(17,91,147,1) 50%,rgba(0,118,173,1) 51%,rgba(75,184,240,1) 54%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 65%,rgba(65,154,214,1) 69%,rgba(58,139,194,1) 73%,rgba(75,184,240,1) 78%,rgba(58,139,194,1) 80%,rgba(75,184,240,1) 89%,rgba(58,139,194,1) 94%,rgba(38,85,139,1) 100%); /* IE10+ */
background: linear-gradient(135deg,  rgba(255,234,145,1) 0%,rgba(170,197,222,1) 17%,rgba(17,91,147,1) 50%,rgba(0,118,173,1) 51%,rgba(75,184,240,1) 54%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 65%,rgba(65,154,214,1) 69%,rgba(58,139,194,1) 73%,rgba(75,184,240,1) 78%,rgba(58,139,194,1) 80%,rgba(75,184,240,1) 89%,rgba(58,139,194,1) 94%,rgba(38,85,139,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffea91', endColorstr='#26558b',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */
	color: red;
	}

	.EARTH {
		background: rgb(0,199,255); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjMDBjN2ZmIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTAlIiBzdG9wLWNvbG9yPSIjNzJmOWM4IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTElIiBzdG9wLWNvbG9yPSIjYTFjMTZlIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzdjYmMwYSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(-45deg,  rgba(0,199,255,1) 0%, rgba(114,249,200,1) 50%, rgba(161,193,110,1) 51%, rgba(124,188,10,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(0,199,255,1)), color-stop(50%,rgba(114,249,200,1)), color-stop(51%,rgba(161,193,110,1)), color-stop(100%,rgba(124,188,10,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(-45deg,  rgba(0,199,255,1) 0%,rgba(114,249,200,1) 50%,rgba(161,193,110,1) 51%,rgba(124,188,10,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(-45deg,  rgba(0,199,255,1) 0%,rgba(114,249,200,1) 50%,rgba(161,193,110,1) 51%,rgba(124,188,10,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(-45deg,  rgba(0,199,255,1) 0%,rgba(114,249,200,1) 50%,rgba(161,193,110,1) 51%,rgba(124,188,10,1) 100%); /* IE10+ */
background: linear-gradient(135deg,  rgba(0,199,255,1) 0%,rgba(114,249,200,1) 50%,rgba(161,193,110,1) 51%,rgba(124,188,10,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00c7ff', endColorstr='#7cbc0a',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */
	color: red;
	}

	.AIR{
		background: rgb(251,247,252); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjZmJmN2ZjIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAlIiBzdG9wLWNvbG9yPSIjZDdkZWUzIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMjAlIiBzdG9wLWNvbG9yPSIjZjZmOGY5IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMjIlIiBzdG9wLWNvbG9yPSIjZmZmZGY3IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMjUlIiBzdG9wLWNvbG9yPSIjZjZmOGY5IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMzclIiBzdG9wLWNvbG9yPSIjZDdkZWUzIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTAlIiBzdG9wLWNvbG9yPSIjZjZmOGY5IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTUlIiBzdG9wLWNvbG9yPSIjZmZmZGY3IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNjAlIiBzdG9wLWNvbG9yPSIjZTVlYmVlIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNzIlIiBzdG9wLWNvbG9yPSIjZjZmOGY5IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNzUlIiBzdG9wLWNvbG9yPSIjZmZmZGY3IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNzclIiBzdG9wLWNvbG9yPSIjZjZmOGY5IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iOTAlIiBzdG9wLWNvbG9yPSIjZTVlYmVlIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2RjZWVmNyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(-45deg,  rgba(251,247,252,1) 0%, rgba(215,222,227,1) 10%, rgba(246,248,249,1) 20%, rgba(255,253,247,1) 22%, rgba(246,248,249,1) 25%, rgba(215,222,227,1) 37%, rgba(246,248,249,1) 50%, rgba(255,253,247,1) 55%, rgba(229,235,238,1) 60%, rgba(246,248,249,1) 72%, rgba(255,253,247,1) 75%, rgba(246,248,249,1) 77%, rgba(229,235,238,1) 90%, rgba(220,238,247,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(251,247,252,1)), color-stop(10%,rgba(215,222,227,1)), color-stop(20%,rgba(246,248,249,1)), color-stop(22%,rgba(255,253,247,1)), color-stop(25%,rgba(246,248,249,1)), color-stop(37%,rgba(215,222,227,1)), color-stop(50%,rgba(246,248,249,1)), color-stop(55%,rgba(255,253,247,1)), color-stop(60%,rgba(229,235,238,1)), color-stop(72%,rgba(246,248,249,1)), color-stop(75%,rgba(255,253,247,1)), color-stop(77%,rgba(246,248,249,1)), color-stop(90%,rgba(229,235,238,1)), color-stop(100%,rgba(220,238,247,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(-45deg,  rgba(251,247,252,1) 0%,rgba(215,222,227,1) 10%,rgba(246,248,249,1) 20%,rgba(255,253,247,1) 22%,rgba(246,248,249,1) 25%,rgba(215,222,227,1) 37%,rgba(246,248,249,1) 50%,rgba(255,253,247,1) 55%,rgba(229,235,238,1) 60%,rgba(246,248,249,1) 72%,rgba(255,253,247,1) 75%,rgba(246,248,249,1) 77%,rgba(229,235,238,1) 90%,rgba(220,238,247,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(-45deg,  rgba(251,247,252,1) 0%,rgba(215,222,227,1) 10%,rgba(246,248,249,1) 20%,rgba(255,253,247,1) 22%,rgba(246,248,249,1) 25%,rgba(215,222,227,1) 37%,rgba(246,248,249,1) 50%,rgba(255,253,247,1) 55%,rgba(229,235,238,1) 60%,rgba(246,248,249,1) 72%,rgba(255,253,247,1) 75%,rgba(246,248,249,1) 77%,rgba(229,235,238,1) 90%,rgba(220,238,247,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(-45deg,  rgba(251,247,252,1) 0%,rgba(215,222,227,1) 10%,rgba(246,248,249,1) 20%,rgba(255,253,247,1) 22%,rgba(246,248,249,1) 25%,rgba(215,222,227,1) 37%,rgba(246,248,249,1) 50%,rgba(255,253,247,1) 55%,rgba(229,235,238,1) 60%,rgba(246,248,249,1) 72%,rgba(255,253,247,1) 75%,rgba(246,248,249,1) 77%,rgba(229,235,238,1) 90%,rgba(220,238,247,1) 100%); /* IE10+ */
background: linear-gradient(135deg,  rgba(251,247,252,1) 0%,rgba(215,222,227,1) 10%,rgba(246,248,249,1) 20%,rgba(255,253,247,1) 22%,rgba(246,248,249,1) 25%,rgba(215,222,227,1) 37%,rgba(246,248,249,1) 50%,rgba(255,253,247,1) 55%,rgba(229,235,238,1) 60%,rgba(246,248,249,1) 72%,rgba(255,253,247,1) 75%,rgba(246,248,249,1) 77%,rgba(229,235,238,1) 90%,rgba(220,238,247,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbf7fc', endColorstr='#dceef7',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */

	}



</style>
<div id="playmat">
	<div id="deck" onclick="BattleRoyal.drawCards(1)">
		<button class="card back" onclick="BattleRoyal.initGame();" >
			GAME OVER <hr> PLAY AGAIN <br/> ?
		</button>
	</div>
	<div id="graveyard">
		Graveyard
	</div>
	<div id="prision">
		Prision
	</div>
	<div id="hand">
		Hand
	</div>
	<div id="battlefield">
		Battle Field
	</div>
	<div id="camp">
		Camp
	</div>
	<div id="staq">
		StaQ
	</div>
</div>

