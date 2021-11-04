function reverse_binary( n_decimal ) {
    if ( typeof n_decimal !== "number" || isNaN( n_decimal ) || !Number.isInteger( n_decimal ) ) {
        throw new Error( "Sorry, this function needs an integer decimal number as input." );
    }
    else if ( n_decimal < 0 ) { //it still works because js strips the trailing "-" but we could raise an error here

    }

    /*
     all this could be a one-liner as follows:

     return parseInt( n_decimal.toString( 2 ).split( "" ).reverse().join( "" ), 2 );
     */

    var solution = toBin( n_decimal )
        .split( "" )
        .reverse()
        .join( "" );
    return toDec( solution );
}

function toBin( n ) {
    return n.toString( 2 );
}

function toDec( n ) {
    return parseInt( n, 2 );
}

//console.log( reverse_binary( 12 ) );
//console.log( reverse_binary( 0 ) );
//console.log( reverse_binary( -6 ) );
//console.log( reverse_binary( 0b11001 ) );
//console.log( reverse_binary( NaN ) );
//console.log( reverse_binary( "Hello Everli" ) );
console.log( reverse_binary( null ) );
