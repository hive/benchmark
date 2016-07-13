#!/usr/bin/env bash


# Gather php lines of code
phploc --log-xml ../Documents/xml/phploc.xml --progress ../Source/;

# Run phpunit
phpunit --configuration phpunit.xml --testsuite All;

# Run php mess detector
phpmd ../Source xml codesize,controversial,design,naming,unusedcode --reportfile ../Documents/xml/phpmd.xml --suffixes php;

# Run php Code Sniffer
phpcs --tab-width=auto  --standard=PSR1,PSR2  --report-info=../Documents/html/Sniffer/info.txt --report-full=../Documents/html/Sniffer/full.txt --report-source=../Documents/html/Sniffer/source.txt --report-summary=../Documents/html/Sniffer/summary.txt --report-xml=../Documents/xml/codesniffer.xml ../Source/;


# Output the rules of the CodeSniffer
#phpcs --generator=html > ../Documents/html/Sniffer/rules.html;


# Run it a second time gathering all the output into one file
phpcs --standard=PSR1,PSR2 --tab-width=auto --report-info --report-full --report-source --report-summary ../Source > ../Documents/html/sniffer/all.txt  > ../Documents/html/sniffer/all.txt;

# Create phpUnit html
xsltproc templates/phpunit.xls ../Documents/xml/phpunit.xml > ../Documents/html/phpunit/index.html;

# Create codeSniffer html
xsltproc templates/codesniffer.xsl ../Documents/xml/codesniffer.xml > ../Documents/html/codesniffer/index.html;


# Run phpDox
~/Sites/phpdox/phpdox -f phpdox.xml;

# Commit the changes
git add .;
git commit -am 'Update Documentation';