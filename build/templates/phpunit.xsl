<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<!--
PHPUnit logfile XLST template

This fileset provides an easy way to view the PHPUnit XML (JUnit) logfiles in a human readable manner using a web browser.

Use this either in combination with the accompanying html file or add the following tag straight
after the xml opening tag of the logfile:
<?xml-stylesheet type="text/xsl" href="phpunit.xslt"?>

The thresholds used for the colour-coding can be changed by adjusting the variables at the top of this file.
Be careful when changing the values: the double quoting is intentional and needed. Don't remove.

Copyright ©2014 Juliette Reinders Folmer (Twitter: @jrf_nl / GitHub: @jrfnl)
License: DWTFYW
Updates will be published via: https://gist.github.com/jrfnl/3c28ea6d9b07fd48656d
Loosely inspired by: https://www.ruby-forum.com/topic/120869

NB: This was quickly thrown together. There are probably better ways to do bits of it.
Feel free to suggest them via the gist comment form ;-)
-->


<!--
The percentage of tests which need to have failed for the failures cell colour to go from orange to red.
Default value: 0.4 (=40%)
-->
<xsl:variable name="fail_bad" select="'0.4'" />

<!--
The thresholds used for the time colour coding in seconds.
-->
<xsl:variable name="very_bad_time" select="'10'" />
<xsl:variable name="bad_time" select="'3'" />
<xsl:variable name="not_so_good_time" select="'1'" />
<xsl:variable name="good_time" select="'0.4'" />


<!--
Whether to show the details of passed tests. Set to 1 to show.
Default value: 0 (no)
-->
<xsl:variable name="show_success_detail" select="'0'" />

<xsl:template match="/">
<xsl:text disable-output-escaping='yes'>&lt;!DOCTYPE html></xsl:text>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>

</head>
<body>

	<div class="container">
		<h3>PhpUnit</h3>
	</div>
	<xsl:apply-templates/>


</body>
</html>
</xsl:template>




<xsl:template match="/testsuites/testsuite" mode="high-level">
	<h5><xsl:value-of select="@name"/></h5>
        <table class="table" id="high-level">
            <tr>
                <td><b>Number of Tests:</b></td>
                <td><xsl:value-of select="@tests"/></td>
            </tr>
            <tr>
                <td><b>Number of Assertions:</b></td>
                <td><xsl:value-of select="@assertions"/></td>
            </tr>
            <tr>
                <td><b>Number of Failures:</b></td>
                <td><xsl:value-of select="@failures"/></td>
            </tr>
            <tr>
                <td><b>Number of Errors:</b></td>
                <td><xsl:value-of select="@errors"/></td>
            </tr>
            <tr>
                <td><b>Execution Time:</b></td>
                <td><xsl:value-of select="@time"/></td>
            </tr>
        </table>
</xsl:template>


<xsl:template match="testsuites">
<div class="container">
	<div>
    	<xsl:apply-templates select="/testsuites/testsuite" mode="high-level"/>
	</div>

	<h3>Summary</h3>
	<table class="table table-bordered" id="summary">
	    <thead>
            <tr>
                <th>Name</th>
                <th>Tests</th>
                <th>Assertions</th>
                <th>Failures</th>
                <th>Errors</th>
                <th>Execution Time</th>
            </tr>
		</thead>
		<tbody>
		    <xsl:apply-templates select="//testsuite"/>
		</tbody>
	</table>

	<xsl:apply-templates select="//testsuite[count(testsuite) = 0]" mode="details"/>
</div>
</xsl:template>


<xsl:template match="//testsuite">
	<xsl:variable name="hasfailures">
		<xsl:choose>
			<xsl:when test="(@failures div @tests ) > $fail_bad"> danger</xsl:when>
			<xsl:when test="@failures &gt; 0"> warning</xsl:when>
			<xsl:when test="@tests &gt; 0 and @failures = 0 and @errors = 0"> success</xsl:when>
			<xsl:otherwise></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<xsl:variable name="haserrors">
		<xsl:choose>
			<xsl:when test="@errors &gt; 0"> danger</xsl:when>
			<xsl:when test="@tests &gt; 0 and @failures = 0 and @errors = 0"> success</xsl:when>
			<xsl:otherwise></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<xsl:variable name="passes">
		<xsl:choose>
			<xsl:when test="@tests &gt; 0 and @failures = 0 and @errors = 0"> success</xsl:when>
			<xsl:otherwise></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<xsl:variable name="isslow">
		<xsl:choose>
			<xsl:when test="@time &gt; $very_bad_time"> danger</xsl:when>
			<xsl:when test="@time &gt; $bad_time"> warning</xsl:when>
			<xsl:when test="@time &gt; $not_so_good_time"> info</xsl:when>
			<xsl:when test="@tests &gt; 0 and @time &lt; $good_time"> success</xsl:when>
			<xsl:when test="@tests = 0"></xsl:when>
			<xsl:otherwise> primary</xsl:otherwise>
		</xsl:choose>
	</xsl:variable>
	<xsl:variable name="testname" select="@name" />

	<xsl:choose>
		<xsl:when test="count(testsuite) = 0">

		<tr class="single-test">
			<xsl:choose>
				<xsl:when test="count(testcase) &gt; 0">
			<th><a href="#{$testname}"><xsl:value-of select="@name"/></a></th>
				</xsl:when>
				<xsl:otherwise>
			<th><xsl:value-of select="@name"/></th>
				</xsl:otherwise>
			</xsl:choose>

			<td class="nr{$passes}"><xsl:value-of select="@tests"/></td>
			<td class="nr{$passes}"><xsl:value-of select="@assertions"/></td>
			<td class="nr{$hasfailures}"><xsl:value-of select="@failures"/></td>
			<td class="nr{$haserrors}"><xsl:value-of select="@errors"/></td>
			<td class="time{$isslow}"><xsl:value-of select="@time"/></td>
		</tr>

		</xsl:when>
		<xsl:when test="@name != ''">

		<tr class="test-file">
			<th><xsl:value-of select="@name"/></th>
			<td class="nr{$passes}"><xsl:value-of select="@tests"/></td>
			<td class="nr{$passes}"><xsl:value-of select="@assertions"/></td>
			<td class="nr{$hasfailures}"><xsl:value-of select="@failures"/></td>
			<td class="nr{$haserrors}"><xsl:value-of select="@errors"/></td>
			<td class="time{$isslow}"><xsl:value-of select="@time"/></td>
		</tr>
		</xsl:when>
		<xsl:otherwise></xsl:otherwise>
	</xsl:choose>
</xsl:template>


<xsl:template match="//testsuite[count(testsuite) = 0]" mode="details">
	<xsl:variable name="testname" select="@name" />

	<xsl:choose>
		<xsl:when test="count(testcase) &gt; 0 and ( $show_success_detail = 1 or ( $show_success_detail = 0 and ( @failures &gt; 0 or @errors &gt; 0 ) ) )">

	<h4 id="{$testname}"><xsl:value-of select="@name"/></h4>
	<table class="table table-bordered">
		<tr class="top">
			<th>Test name</th>
			<th>Assertions</th>
			<th>Time</th>
		</tr>
	    <xsl:apply-templates select="testcase"/>
	</table>
	<p class="backlink"><a href="#summary"><span>&#8613;</span> Back to summary</a></p>

		</xsl:when>

		<xsl:when test="count(testcase) = 0">
	<h4 id="{$testname}"><span class="no-tests"><xsl:value-of select="@name"/></span> (no tests found)</h4>
		</xsl:when>
		<xsl:otherwise></xsl:otherwise>

	</xsl:choose>
</xsl:template>

<xsl:template match="testcase">
	<xsl:variable name="isslow">
		<xsl:choose>
			<xsl:when test="@time &gt; $very_bad_time"> danger</xsl:when>
			<xsl:when test="@time &gt; $bad_time"> warning</xsl:when>
			<xsl:when test="@time &gt; $not_so_good_time"> info</xsl:when>
			<xsl:when test="@tests &gt; 0 and @time &lt; $good_time"> success</xsl:when>
			<xsl:when test="@tests = 0"></xsl:when>
			<xsl:otherwise> primary</xsl:otherwise>
		</xsl:choose>
	</xsl:variable>

	<xsl:variable name="class">
		<xsl:choose>
			<xsl:when test="count(failure) &gt; 0">failed</xsl:when>
			<xsl:when test="count(error) &gt; 0">errored</xsl:when>
			<xsl:otherwise>pass</xsl:otherwise>
		</xsl:choose>
	</xsl:variable>

		<tr class="{$class}">
			<th><xsl:value-of select="@name"/></th>
			<td><xsl:value-of select="@assertions"/></td>
			<td class="time{$isslow}"><xsl:value-of select="@time"/></td>
		</tr>

	<xsl:apply-templates select="error"/>
	<xsl:apply-templates select="failure"/>
</xsl:template>

<xsl:template match="error">
		<tr>
			<td class="error-detail-type" colspan="3"><xsl:value-of select="@type"/></td>
		</tr>
		<tr>
			<td class="error-detail-detail" colspan="3"><xsl:value-of select="."/></td>
		</tr>
</xsl:template>

<xsl:template match="failure">
		<tr>
			<td class="fail-detail-type" colspan="3"><xsl:value-of select="@type"/></td>
		</tr>
		<tr>
			<td class="fail-detail-detail" colspan="3"><xsl:value-of select="."/></td>
		</tr>
</xsl:template>

</xsl:stylesheet>
