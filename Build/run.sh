#!/usr/bin/env bash

phpcs ../Source/;


# Gather php lines of code
phploc --log-xml ../Documents/xml/phploc.xml --progress ../Source/;

# Run phpunit
phpunit --configuration phpunit.xml --testsuite All;




# Run php mess detector
phpmd ../Source xml codesize,controversial,design,naming,unusedcode --reportfile ../Documents/xml/phpmd.xml --suffixes php;

# Output the rules of the CodeSniffer
#phpcs --generator=html > ../Documents/html/Sniffer/rules.html;

# Run php Code Sniffer


# Run it a second time gathering all the output into one file
#phpcs --standard=PSR1,PSR2  --report-info --report-full --report-source --report-summary ../Source > ../Documents/html/sniffer/all.txt  > ../Documents/html/sniffer/all.txt;

#they need to all be ran at once
phpcs --generator=html > ../Documents/html/Sniffer/rules.html;phpcs --standard=PSR1,PSR2  --report-info --report-full --report-source --report-summary ../Source > ../Documents/html/sniffer/all.txt  > ../Documents/html/sniffer/all.txt;

# Create phpUnit html
xsltproc templates/phpunit.xls ../Documents/xml/phpunit.xml > ../Documents/html/phpunit/index.html;

# Create codeSniffer html
xsltproc templates/codesniffer.xsl ../Documents/xml/codesniffer.xml > ../Documents/html/codesniffer/index.html;


# Run phpDox
~/Sites/phpdox/phpdox -f phpdox.xml;

# Commit the changes
git add .;
git commit -am 'Update Documentation';