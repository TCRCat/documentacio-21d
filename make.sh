#!/bin/bash

pdftotext -fixed 3 pdf/escoles-barcelona.pdf txt/escoles-barcelona.txt
pdftotext -fixed 3 pdf/escoles-tarragona.pdf txt/escoles-tarragona.txt
pdftotext -fixed 2 pdf/escoles-lleida.pdf txt/escoles-lleida.txt
pdftotext -fixed 2 pdf/escoles-girona.pdf txt/escoles-girona.txt

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

head -1 csv/candidatures.csv > csv/candidatures-barcelona.csv
cat csv/candidatures.csv | grep BARCELONA >> csv/candidatures-barcelona.csv

head -1 csv/candidatures.csv > csv/candidatures-tarragona.csv
cat csv/candidatures.csv | grep TARRAGONA >> csv/candidatures-tarragona.csv

head -1 csv/candidatures.csv > csv/candidatures-lleida.csv
cat csv/candidatures.csv | grep LLEIDA >> csv/candidatures-lleida.csv

head -1 csv/candidatures.csv > csv/candidatures-girona.csv
cat csv/candidatures.csv | grep GIRONA >> csv/candidatures-girona.csv
