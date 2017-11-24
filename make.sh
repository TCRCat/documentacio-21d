#!/bin/bash

pdftotext -fixed 3 pdf/escoles-barcelona.pdf txt/escoles-barcelona.txt
pdftotext -fixed 2 pdf/escoles-girona.pdf txt/escoles-girona.txt
pdftotext -fixed 2 pdf/escoles-lleida.pdf txt/escoles-lleida.txt
pdftotext -fixed 3 pdf/escoles-tarragona.pdf txt/escoles-tarragona.txt

php php/escoles-barcelona.php > csv/escoles-barcelona.csv
php php/escoles-girona.php > csv/escoles-girona.csv
php php/escoles-lleida.php > csv/escoles-lleida.csv
php php/escoles-tarragona.php > csv/escoles-tarragona.csv

cat csv/escoles-barcelona.csv | cut -d";" -f2,8,9 | sort -u > csv/escoles-barcelona-petit.csv
cat csv/escoles-girona.csv | cut -d";" -f2,8,9 | sort -u > csv/escoles-girona-petit.csv
cat csv/escoles-lleida.csv | cut -d";" -f2,8,9 | sort -u > csv/escoles-lleida-petit.csv
cat csv/escoles-tarragona.csv | cut -d";" -f2,8,9 | sort -u > csv/escoles-tarragona-petit.csv
