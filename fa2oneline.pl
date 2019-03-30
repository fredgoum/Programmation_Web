#!/usr/bin/perl
# perl fa2oneline.pl botrytis_cinerea__b05.10__1_contigs.fasta >> contigs_concatene.fasta
if ($#ARGV < 0) {
    print "$0 <fasta file>\n";
    print "Converts to 1 line fasta\n";
    exit;
}

if (!open(F, $ARGV[0])) {
    print "Can't open \"$ARGV[0]\"\n";
    exit;
}

$line = <F>;
while ($line) {
    if ($line =~ /^>/) {
	$name = $line;
	$seq = "";
	$totseq++;
	while (($line = <F>) && ($line !~ /^>/)) {
	    chop $line;
	    $line =~ tr/ //d;
	    $seq .=  $line;
	}

	print $name;
	print $seq, "\n";

    } else {
	$line = <F>;
    }
}
close F;

