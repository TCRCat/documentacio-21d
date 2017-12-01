#!/bin/bash

pdftotext -fixed 3 pdf/escoles-barcelona-2017-11-02.pdf txt/escoles-barcelona-2017-11-02.txt
pdftotext -fixed 3 pdf/escoles-tarragona-2017-11-03.pdf txt/escoles-tarragona-2017-11-03.txt
pdftotext -fixed 2 pdf/escoles-lleida-2017-11-03.pdf txt/escoles-lleida-2017-11-03.txt
pdftotext -fixed 2 pdf/escoles-girona-2017-11-03.pdf txt/escoles-girona-2017-11-03.txt

pdftotext -fixed 3 pdf/escoles-barcelona-2017-11-23.pdf txt/escoles-barcelona-2017-11-23.txt
pdftotext -fixed 2 pdf/escoles-girona-2017-11-22.pdf txt/escoles-girona-2017-11-22.txt

php php/escoles-barcelona.php > csv/escoles-barcelona.csv
php php/escoles-tarragona.php > csv/escoles-tarragona.csv
php php/escoles-lleida.php > csv/escoles-lleida.csv
php php/escoles-girona.php > csv/escoles-girona.csv

cat csv/escoles-barcelona.csv | cut -d";" -f2,8,9 | uniq > csv/escoles-barcelona-petit.csv
cat csv/escoles-tarragona.csv | cut -d";" -f2,8,9 | uniq > csv/escoles-tarragona-petit.csv
cat csv/escoles-lleida.csv | cut -d";" -f2,8,9 | uniq > csv/escoles-lleida-petit.csv
cat csv/escoles-girona.csv | cut -d";" -f2,8,9 | uniq > csv/escoles-girona-petit.csv

pdftotext -layout pdf/candidatures.pdf txt/candidatures.txt
php php/candidatures.php > csv/candidatures.csv
