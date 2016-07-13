<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <xsl:text disable-output-escaping='yes'>&lt;!DOCTYPE html></xsl:text>
    <html>
      <head>
        <meta charset="UTF-8"/>
        <title>PHPMD</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
      </head>
      <body>


        <div class="container">
          <h3>PHPMD</h3>
        </div>

        <div class="container">
          <h4>Summary</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th><div align="left">File Name</div></th>
                <th><div align="right">Violations</div></th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="pmd/file">
                <tr>
                  <td><xsl:value-of select="@name"/></td>
                  <td><div class="text-right"><xsl:value-of select="count(violation)"/></div></td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
        </div>


        <div class="container">
          <h4>Details</h4>
          <table class="table">
              <xsl:apply-templates select="pmd/file"/>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>
  <xsl:template match="file">
    <thead>
      <tr>
        <th colspan="3"><xsl:value-of select="@name"/></th>
      </tr>
      <tr>
        <td><div align="center">Line</div></td>
        <td><div align="left">Violation</div></td>
        <td><div align="center">Priority</div></td>
      </tr>
    </thead>

    <xsl:for-each select="violation">
          <tr>
            <td><div class="text-center"><xsl:value-of select="@beginline"/>-<xsl:value-of select="@endline"/></div></td>
            <td><xsl:value-of select="."/></td>
            <td><div class="text-center"><xsl:value-of select="@priority"/></div></td>
          </tr>
    </xsl:for-each>
  </xsl:template>
</xsl:stylesheet>