<?php

/******************************************************

These functions can be used on WindowsNT to replace
their built-in counterparts that do not work as
expected.

checkdnsrr_winNT() works just the same, returning true
or false

getmxrr_winNT() returns true or false and provides a
list of MX hosts in order of preference.
testing - jbogard

*******************************************************/
function checkdnsrr_winNT( $host, $type = '' )
{

   if( !empty( $host ) )
   {

       # Set Default Type:
       if( $type == '' ) $type = "MX";

       @exec( "nslookup -type=$type $host", $output );

       if( !is_array( $output ) )
       {
          return false;
       }
       while( list( $k, $line ) = each( $output ) )
       {

           # Valid records begin with host name:
           if( eregi( "^$host", $line ) )
           {
               # record found:
               return true;
           }

       }

       return false;

   }

}

function getmxrr_winNT( $hostname, &$mxhosts )
{

   if( !is_array( $mxhosts ) ) $mxhosts = array();

   if( !empty( $hostname ) )
   {

       @exec( "nslookup -type=MX $hostname", $output, $ret );

       while( list( $k, $line ) = each( $output ) )
       {

           # Valid records begin with hostname:
           if( ereg( "^$hostname\tMX preference = ([0-9]+), mail exchanger = (.*)$", $line, $parts ) )
           {

               $mxhosts[ $parts[1] ] = $parts[2];

           }

       }

       if( count( $mxhosts ) )
       {

           reset( $mxhosts );

           ksort( $mxhosts );

           $i = 0;

           while( list( $pref, $host ) = each( $mxhosts ) )
           {
               $mxhosts2[$i] = $host;
               $i++;
           }

           $mxhosts = $mxhosts2;

           return true;

       }
       else
       {

           return false;

       }

   }

}

?>
