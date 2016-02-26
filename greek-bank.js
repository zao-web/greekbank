( function( window, $ ) {
	var document = window.document;

	var greekBankJS = function() {

		var SELF = this, charts = {}, url = window.location.origin + window.location.pathname, memberId;

		if ( window.location.hash !== '' ) {
			window.history.replaceState({url : location.search + location.hash}, '', location.search + location.hash);
		}

		SELF.setPanel = function( url ) {
			var hash = window.location.hash;

			if ( hash == '#profile-panel-payment' ) {
				SELF.changeTabState( '#profile' );
				$( 'label#profile-tab' ).click();
				SELF.openPaymentModal();
			} else if ( hash !== ""  ) {
				var s = hash.replace( '-panel', '' );
				SELF.changeTabState( s );
				$( 'label' + s + '-tab' ).click();
			}
		};

		SELF.changeTabState = function( e ) {
			var $this = e.target ? $( this ) : $( e );

			$this.parent().find('.state').each(function () {
		        if ( this.checked ) {
		        	var new_url = url + '#' + $this.attr( 'aria-controls' );
		            $this.attr( 'aria-selected', 'true' );
    				history.pushState( { 'url' : new_url }, '', new_url );
		        } else {
		            $(this).removeAttr('aria-selected');
		        }
		    });
		};

		SELF.showMemberRoster = function( e ) {
			$( 'div.panel:visible' ).css( 'display', 'none' );
			$( 'div#roster-panel' ).css( 'display', 'block' );
		};

		SELF.showSettings = function( e ) {
			$( 'div.panel:visible' ).css( 'display', 'none' );
			$( 'div#settings-panel' ).css( 'display', 'block' );
		};

		SELF.showAnalytics = function( e ) {
			$( 'div.panel:visible' ).css( 'display', 'none' );
			$( 'div#analytics-panel' ).css( 'display', 'block' );
		};

		SELF.formatCurrency = function( value ) {
			return  '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}

		SELF.generateCharts = function() {
			if ( ! $( 'body' ).hasClass( 'treasurer-center' ) ) {
				return;
			}

			SELF.generateChart( {
				id     : 'revenue-chart',
				name   : 'revenueChart',
				type   : 'Bar',
				data   : {
				   		labels: [ "Amount Paid", "Amount Due", "Amount Past Due" ],
				    	datasets: [
					        {
					            fillColor: "rgba(151,187,205,0.5)",
					            strokeColor: "rgba(151,187,205,0.8)",
					            highlightFill: "rgba(151,187,205,0.75)",
					            highlightStroke: "rgba(151,187,205,1)",
					            data: [ greekChartVars.amount_paid, greekChartVars.amount_due, greekChartVars.amount_past_due ]
					        }
				    	]
				},
				options : {
					tooltipTemplate: "<%= greekBankJS.formatCurrency(value) %>",
					scaleLabel : function( label ) {
						return SELF.formatCurrency( label.value );
					},
				}
			} );

			SELF.generateChart( {
				id     : 'transaction-chart',
				name   : 'transactionChart',
				type   : 'Doughnut',
				data   :  [
							{
						        value: greekChartVars.amount_of_fees,
						        color:"#F7464A",
						        highlight: "#FF5A5E",
						        label: "Fees"
						    },
						    {
						        value: greekChartVars.amount_of_dues,
						        color: "#46BFBD",
						        highlight: "#5AD3D1",
						        label: "Dues"
						    }
    			],
				options : {
					tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= greekBankJS.formatCurrency(value) %>",
				}
			} );

			/* SELF.generateChart( {
				id     : 'membership-status',
				name   : 'membershipStatus',
				type   : 'Pie',
				data   :  [
						    {
						        value: greekChartVars.current_payments,
						        color: "#46BFBD",
						        highlight: "#5AD3D1",
						        label: "Current"
						    },
						    {
						        value: greekChartVars.thirty_days_late,
						        color: "#FDB45C",
						        highlight: "#FFC870",
						        label: " 0-30 Days Past Due"
						    },
						    {
						        value: greekChartVars.sixty_days_late,
						        color:"#F7464A",
						        highlight: "#FF5A5E",
						        label: "31-60 Days Past Due"
						    },
						    {
						        value: greekChartVars.more_than_sixty,
						        color:"#000000",
						        highlight: "#999999",
						        label: "60+ Days Past Due"
						    },
    			],
				options : {
					tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
				}
			} );*/
		}

		SELF.generateChart = function( options ) {
			var name = options.name;

			if ( charts[ name ] ) {
				return charts[ name ];
			}

			var id = options.id, _options = options.options, ctx = document.getElementById( id ).getContext( '2d' );

			_options = $.extend( {
				animationSteps : 100,
				animationEasing : 'easeOutBounce'
			}, _options );

			var chart = new Chart( ctx )[ options.type ]( options.data, _options );

			charts[ name ] = chart;
			return chart;
		};

		SELF.showCharts = function() {
			return charts;
		}

		SELF.showProfile = function( e ) {
			$( 'div.panel:visible' ).css( 'display', 'none' );
			$( 'div#profile-panel' ).css( 'display', 'block' );
		};

		SELF.submitDetails = function( e ) {
			e.preventDefault();

			data = {
				id       : memberId ,
				action   : 'update_member',
				first    : $( '#input_8_1_3' ).val(),
				last     : $( '#input_8_1_6' ).val(),
				email    : $( '#input_8_2' ).val(),
				term     : $( '#input_8_3' ).val(),
				plan     : $( '#input_8_4' ).val()
			},
			success = function( response ) {
				console.log(response);
				if ( response.success ) {

					$( 'tr#member-' + memberId + ' td:eq(1) span.display-name' ).text( data.first + ' ' + data.last );
					$( 'tr#member-' + memberId + ' td:eq(4)' ).text( $( '#input_8_3 option:selected' ).text() );
					$( 'tr#member-' + memberId + ' td.remaining-balance' ).text( response.data.balance_due );
					$( 'div.overlay' ).css( 'display', 'none' );
					$( 'div.details-modal' ).slideUp( 50 );
					$( '.gform_ajax_spinner' ).hide();
				} else {
					alert( 'Sorry, we could not update this member. Please contact us.' );
				}
			};

			$.post(
					greekChartVars.ajaxurl,
					data,
					success,
					'json'
			);

		}

		SELF.titleCase = function( string ) {
			return string.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});

		}

		SELF.openDetailsModal = function( e ) {
			if ( e ) {
				e.preventDefault();
			}

			var $this = $( this );
			memberId = $this.parents( 'tr' ).data( 'member-id' );

			$( '#gform_submit_button_8' )[0].onclick = null;

			$this.parents( 'td' ).prepend( $( '#loading-indicator' ) );

			$( '#loading-indicator', $this.parents( 'td' ) ).show();

			data = {
				id       : memberId ,
				action   : 'get_member'
			},
			success = function( response ) {
				console.log ( response );
				if ( response.success ) {
					var data = response.data;

					window.scrollTo( 0, 0 );
					$( 'div.overlay' ).css( 'display', 'block' );

					$( '#input_8_1_3' ).val( data.user.first );
					$( '#input_8_1_6' ).val( data.user.last );
					$( '#input_8_2' ).val( data.user.email );

					if ( data.categories.length > 0 ) {
						$( '#input_8_3' ).val( data.categories[0].term_id );
					}

					if ( data.payment_plan.length > 0 ) {
						$( '#input_8_4' ).val( SELF.titleCase( data.payment_plan ) );
					}

					if ( data.financial.payments.length > 0 ) {
						$( 'div.recent-payments' ).html( data.financial.recent_view );
						$( '.recent-history .table-container tbody' ).html( data.financial.summary );
					}

					$( 'div.details-modal' ).slideDown( 50 );
					$( '#loading-indicator', $this.parents( 'td' ) ).hide();
				} else {
					alert( 'Sorry, we could not load this member. Please contact us.' );
				}
			};

			$.post(
					greekChartVars.ajaxurl,
					data,
					success,
					'json'
			);

		};

		SELF.openCategoryModal = function( e ) {
			if ( e ) {
				e.preventDefault();
			}

			$( '#gform_fields_9 .gfield_list_1_cell2 input' ).attr( 'type', 'number' );
			$( '#gform_fields_9 .gfield_list_1_cell2 input' ).attr( 'step', '.01' );

			window.scrollTo( 0, 0 );
			$( 'div.overlay' ).css( 'display', 'block' );
			$( 'div.new-category-modal' ).css( 'display', 'block' );
		};

		SELF.openMemberModal = function( e ) {
			if ( e ) {
				e.preventDefault();
			}
			window.scrollTo( 0, 0 );
			$( 'div.overlay' ).css( 'display', 'block' );
			$( 'div.new-member-modal' ).css( 'display', 'block' );
		};

		SELF.openTransactionModal = function( e ) {
			if ( e ) {
				e.preventDefault();
			}
			window.scrollTo( 0, 0 );
			$( 'div.overlay' ).css( 'display', 'block' );
			$( 'div.add-transaction-modal' ).css( 'display', 'block' );

			var $this = $( this );
			memberId = $this.parents( 'tr' ).data( 'member-id' );

			if ( $( '#member_id' ).length == 0 ) {
				$( '#gform_10' ).prepend( '<input id="member_id" name="member_id" type="hidden" />' );
			}

			$( '#gform_10 input#member_id' ).val( memberId );

		};

		SELF.setPaymentAmount = function( e ) {
			var $this          = $( this ),
				amount         = $this.data( 'amount' ),
				$amount_input  = $( 'input[id="input_7_2"]' ),
				isCustomAmount = $this.parent().hasClass( 'custom-amount' ),
				$surcharge_container = $( '#surcharge' );

			$amount_input.toggle( isCustomAmount );

			if ( ! isCustomAmount ) {
				$amount_input.val( amount );
			}

			$surcharge_container.insertBefore( $( '#gform_submit_button_7' ) ).show();

			SELF.updateSurchargeAmount( $amount_input.val() );
		};

		SELF.roundUp = function ( num ) {
			return +(Math.round(num + "e+2")  + "e-2");
		}

		SELF.updateSurchargeAmount = function( amount ) {
			var $base_amount      = $( '.base-amount' ),
				$surcharge_amount = $( '.surcharge' ),
				$total            = $( '.total-charge' ),
				surcharge;

			$base_amount.text( SELF.formatCurrency( amount ) );

			surcharge = +( SELF.roundUp( Number( amount ) * 0.0149 ).toFixed( 2 ) );

			$surcharge_amount.text( SELF.formatCurrency( surcharge ) );

			$total.text( SELF.formatCurrency( +( ( Number( amount ) + surcharge ).toFixed( 2 ) ) ) );
		}

		SELF.updateSurchargeWithCustomAmount = function() {
			SELF.updateSurchargeAmount( $( this ).val() );
		}

		SELF.openPaymentModal = function( e ) {

			if ( e ) {
				e.preventDefault();
			}

			window.scrollTo( 0, 0 );

			$( '#payment-options' ).insertBefore( $( '#input_7_2' ) ).show();
			$( '#input_7_2' ).hide();
			history.pushState( { 'url' : url + '#profile-panel-payment' }, '',  url + '#profile-panel-payment' );
			$( 'div.overlay' ).css( 'display', 'block' );
			$( 'div.new-payment-modal' ).css( 'display', 'block' );
		};

		SELF.openLoginModal = function( e ) {
			if ( e ) {
				e.preventDefault();
			}
			window.scrollTo( 0, 0 );
			$( 'div.overlay' ).css( 'display', 'block' );
			$( 'div.login-form' ).css( 'display', 'block' );
		};

		SELF.closeModal = function( e ) {
			if ( e ) {
				e.preventDefault();
			}

			$( 'div.overlay' ).css( 'display', 'none' );
			$( 'div.details-modal' ).css( 'display', 'none' );
			$( 'div.new-member-modal' ).css( 'display', 'none' );
			$( 'div.new-category-modal' ).css( 'display', 'none' );
			$( 'div.add-transaction-modal' ).css( 'display', 'none' );
			$( 'div.login-form' ).css( 'display', 'none' );
			$( 'div.new-payment-modal' ).css( 'display', 'none' );
			$( 'div.bulk-category-edit' ).css( 'display', 'none' );
		};

		SELF.escapeKey = function( e ) {
			if ( e.keyCode == 27 ) {
				SELF.closeModal();
			}
		};

		SELF.toggleCheckboxes = function(e) {
			var $this = $( this ), $checked = $this.is( ':checked' ), $boxes = $( '.member-roster tbody input[type="checkbox"]' );

			$boxes.each( function() {
				$( this ).attr( 'checked', $checked );
			} );
		};

		SELF.event_popstate = function( e ) {
			SELF.setPanel();
		};

		SELF.deleteMember = function( id, bulk ) {
			if ( id.target ) {
				id.preventDefault();
			}

			var id = id.target ? $( this ).parents( 'tr' ).data( 'member-id' ) : id,

			data = {
				nonce  : $( this ).data( 'delete-nonce' ),
				id     : id,
				action : 'delete_members'
			};

			success = function( response ) {

				if ( response.success ) {
					if ( data.bulk ) {
						$( 'input[name="member[]"]:checked' ).each( function() {
							$( this ).parents( 'tr' ).hide( 'fast' );
						} );
					} else {
						$( 'tr#member-' + data.id ).hide( 'fast' );
					}
				} else {
					alert( 'We are sorry, you are not able to delete this member.' );
				}
			};

			if ( bulk ) {
				msg = 'Are you sure you want to delete these members?';
				data.bulk = 'true';
			} else {
				msg = 'Are you sure you want to delete this member?';
			}

			if ( confirm( msg ) ) {
				$.post(
					greekChartVars.ajaxurl,
					data,
					success,
					'json'
				);
			}
		};

		SELF.bulkEditCategories = function( ids ) {
			console.log( ids );
			window.scrollTo( 0, 0 );
			$( 'div.overlay' ).css( 'display', 'block' );
			$( 'div.bulk-category-edit' ).css( 'display', 'block' );
			$( '#gform_bulk_edit' ).submit( function( e ) {
				e.preventDefault();

				data = {
					ids      : ids,
					category : $( '.member_category_dropdown' ).val(),
					action   : 'bulk_edit_member_categories'
				},
				success = function( data ) {
					console.log ( data );
					if ( data.success ) {
						window.location.reload();
					}
				};

				$.post(
						greekChartVars.ajaxurl,
						data,
						success,
						'json'
					);
			} );
		};

		SELF.bulkAddTransactions = function( ids ) {
			// Decorate form with member_ids
			SELF.openTransactionModal();

			$( '#gform_10 input#member_id' ).val( ids );

		};

		SELF.bulkActionsHandler = function( e ) {
			if ( $( '.bulk-actions select' ).val() == '' ) {
				alert( 'You must select an action to complete.' );
				return;
			}

			if ( $( '.member-roster tr td input[type="checkbox"]:checked' ).length == 0 ) {
				alert( 'You must select at least one member.' );
				return;
			}

			var member_ids = $( 'input[name="member[]"]:checked' ).serialize(), action = $( '.bulk-actions select' ).val();

			if ( 'delete' == action ) {
				SELF.deleteMember( member_ids, true );
			} else if ( 'edit' == action ) {
				SELF.bulkEditCategories( member_ids )
			} else if ( 'add-transaction' == action ) {
				SELF.bulkAddTransactions( member_ids );
			}
		}

		SELF.newTerm = function( e ) {
			return confirm( 'Are you sure you want to create a new term? This will close out your current term and generate a new set of dues for all of your members.' );
		}

		SELF.logoutLink = function( e ) {
			e.preventDefault();

			window.location = greekBankGlobal.logout_url;
		}

		SELF.setDefaultPaymentDates = function () {
			var $this = $( this ),
			    map = {
			            '1 payment'  : [ '#input_6_18' ],
			            '2 payments' : [ '#input_6_19', '#input_6_17' ],
			            '3 payments' : [ '#input_6_16', '#input_6_15', '#input_6_24' ],
			            '4 payments' : [ '#input_6_23', '#input_6_22', '#input_6_21', '#input_6_20' ]
			          },
	            first_date = $( '#input_6_4' ),
	            last_date  = $( '#input_6_5' ),
	            first_date_obj = new Date( first_date.val() ),
	            last_date_obj  = new Date( last_date.val() ),
	            val = $this.val();

			if ( isNaN( first_date_obj.getTime() ) || isNaN( last_date_obj.getTime() ) ) {
				return;
			}

            if ( val == '1 payment' ) {
        		$( map[ val ][ 0 ] ).val( first_date.val() );
	        } else if ( val == '2 payments' ) {
        		$( map[ val ][ 0 ] ).val( first_date.val() );
        		$( map[ val ][ 1 ] ).val( last_date.val() );
            } else if ( val == '3 payments' ) {
        		var middle_date = new Date( ( first_date_obj.getTime() + last_date_obj.getTime() ) / 2 );

        		$( map[ val ][ 0 ] ).val( first_date.val() );
        		$( map[ val ][ 1 ] ).val( ( middle_date.getMonth() + 1 ) + '/' + middle_date.getDate() + '/' + middle_date.getFullYear() );
        		$( map[ val ][ 2 ] ).val( last_date.val() );

            } else if ( val == '4 payments' ) {
            	var date_diff = Math.round( ( last_date_obj - first_date_obj ) / ( 1000 * 60 * 60 * 24 ) ),
					interval  = Math.round( date_diff / 3 );

        		$( map[ val ][ 0 ] ).val( first_date.val() );

        		first_date_obj.setDate( first_date_obj.getDate() + interval );

        		$( map[ val ][ 1 ] ).val( ( first_date_obj.getMonth() + 1 ) + '/' + first_date_obj.getDate() + '/' + first_date_obj.getFullYear() );

        		first_date_obj.setDate( first_date_obj.getDate() + interval );

        		$( map[ val ][ 2 ] ).val( ( first_date_obj.getMonth() + 1 ) + '/' + first_date_obj.getDate() + '/' + first_date_obj.getFullYear() );


        		$( map[ val ][ 3 ] ).val( last_date.val() );
            }

		}

		$(document).ready(function( $ ) {

			SELF.generateCharts();

			$( '#settings-panel, #analytics-panel, #profile-panel', $( 'body.treasurer-center' ) ).hide();

			$( 'input#input_7_2' ).on(      'change keyup'       , SELF.updateSurchargeWithCustomAmount );
			$( '.payment-plan-option' ).on( 'click' , 'input'    , SELF.setPaymentAmount );
			$( '.radio-tabs' ).on(          'change', '.state'   , SELF.changeTabState );
			$( 'label#member-tab' ).on(     'click'              , SELF.showMemberRoster );
			$( 'label#settings-tab' ).on(   'click'              , SELF.showSettings );
			$( 'label#analytics-tab' ).on(  'click'              , SELF.showAnalytics );
			$( 'label#profile-tab' ).on(    'click'              , SELF.showProfile );
			$( 'span.details' ).on(         'click'     , 'a'    , SELF.openDetailsModal );
			$( 'li.sign-in' ).on(           'click'     , 'a'    , SELF.openLoginModal );
			$( 'div.new-category' ).on(     'click'     , 'a'    , SELF.openCategoryModal );
			$( 'div.new-member' ).on(       'click'     , 'a'    , SELF.openMemberModal );
			$( 'span.add-transaction' ).on( 'click'     , 'a'    , SELF.openTransactionModal );
			$( 'div.payment' ).on(          'click'     , 'a'    , SELF.openPaymentModal );
			$( 'span.delete' ).on(          'click'     , 'a'    , SELF.deleteMember );
			$( '.bulk-actions' ).on(        'click'     , 'input', SELF.bulkActionsHandler );
			$( '#select' ).on(              'click'              , SELF.toggleCheckboxes );
			$( document ).on(               'keyup'              , SELF.escapeKey );
			$( 'div.clicktoclose, div.overlay' ).on(     'click' , SELF.closeModal );
			$( 'div.new-term' ).on(                      'click' , SELF.newTerm );
			$( '#gform_8' ).on(                          'submit', SELF.submitDetails );
			$( '#menu-item-543' ).on(       'click'      ,'a'    , SELF.logoutLink    );
			$( '#input_6_12' ).on(          'click'      ,'input', SELF.setDefaultPaymentDates );
			SELF.setPanel();

			$( window ).on( 'popstate', SELF.event_popstate );

		});
	}

	window.greekBankJS = new greekBankJS();

} )( window, jQuery );
