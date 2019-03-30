#!/usr/bin/perl -w

# Purpose: Count the number of lines of a file whose name (or path) is given as an argument
# Usage : ./Exo_1.pl coli.fa 

$counter=0;				# Initialize the counter

while (<>)				# Read input file line by line
{
	$counter++;			# For each new line, increment the counter value
}

print "\n$counter\n\n";			# Print the counter value


