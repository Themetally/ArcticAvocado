let $ = jQuery


const open = ( $el ) => {
    $el.addClass( 'is-open' )

    return true // true triggers e.preventDefault()
}

const close = ( $el ) => {
    $el.removeClass( 'is-open' )

    return true // true triggers e.preventDefault()
}

const toggle = ( $el ) => {
    let func = ( $el.hasClass( 'is-open' ) ) ? close : open
    return func( $el )
}

$( document ).on( 'click', '.menu-toggle', function ( e ) {

    let $el       = $( this )
    let $dropdown = $( '#primary-menu' )

    if ( toggle( $dropdown ) ) {
        e.preventDefault()
    }

} )

$( document ).on( 'click', '.menu-item-has-children > a', function ( e ) {
    let $el       = $( this )
    let $parent   = $el.parent()
    let $dropdown = $parent.find( '> .sub-menu' )

    if ( !$dropdown.length ) {
        return // no children, no dropdown action
    }

    if ( toggle( $parent ) ) {
        e.preventDefault()
    }


} )

/*
    Listen for the ESC Key and close the menu
 */
$( document ).on( 'keyup', function ( e ) {
    if ( e.key === 'Escape' && $( '#primary-menu.is-open' ).length > 0 ) {
        toggle( $( '#primary-menu' ) )
    }
} )