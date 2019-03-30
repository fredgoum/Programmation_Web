#!/usr/bin/perl -w

# Purpose : Make a BLAST database from a protein fasta input file and Blast the input file against the created database
# ou permet de comparer toutes les séquences protéiques contenues dans le fichier coli.fa à une base de données BLAST constituée par ce même fichier.
# Usage : ./blast_prot.pl botrytis_cinerea__b05.10__1_proteins.fasta
# version BLAST 2.6.0+ 

$infile=$ARGV[0];
$infile_query=$ARGV[1];

$file_name=$infile;
$file_name =~ s/\..+//;

system ("makeblastdb -in $infile -dbtype prot -max_file_sz '50GB' -out $file_name");	# On fixe la taille max du fichier a 20GB 
system ("blastp -query $infile_query -db $file_name -outfmt '7 qseqid sseqid qlen slen length pident evalue'");


